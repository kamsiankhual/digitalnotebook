<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Models\Category;
use App\Models\Note;
use App\Models\NoteImage;

class NotesController extends Controller
{
    
    public function index(Request $request)
    {
        //this is not user isolation
        // $query = Note::with('images')->latest();

        $user = Auth::user();
        $query = Note::where('user_id',$user->id)->with('images')->latest();

        //or 

        // $query = Auth::user()->notes()->with('images')->latest();

        // 1. Search Logic (Works for both Global and Scoped)
        $search = $request->input('search');
        if($search){
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%');
            });
        }

        // 2. Category Logic
        // - If Global Search used: 'category_id' is missing, so this block is SKIPPED (Search All).
        // - If Scoped Search used: 'category_id' is sent, so this block RUNS (Search Scope).
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $notes = $query->paginate(6)->withQueryString();
        
        $categories = Category::all(); 

        return view('notes.index', compact('notes','categories')); 
    }

    
    public function create()
    {
        $categories = Category::all();
        return view("notes.create",compact('categories'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'nullable',
            'category_id'=>'required|exists:categories,id'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $note = new Note();
        $note->title = $request['title'];
        $note->description = $request['description'];
        $note->user_id = $user_id;
        $note->category_id = $request['category_id'];

        $note->save();

        if($request->hasFile('images')){

            foreach($request->file('images') as $image){
                $noteImage = new NoteImage();
                $noteImage->note_id = $note->id;

                $file = $image;
                $fname = $file->getClientOriginalName();
                $imagenewname = uniqid($user_id) . $note['id'] . $fname;
                //local file path
                $file->move(public_path('assets/img/note_images/'),$imagenewname);

                //db path
                $filepath = 'assets/img/note_images/' . $imagenewname;
                $noteImage->image = $filepath;

                $noteImage->save();
            }
        }

        session()->flash('success','New Note Created!');

        return redirect(route('notes.index'));
    }

    
    public function show(string $id)
    {
        $note = Note::with('images')->findOrFail($id);

        if($note->user_id !== Auth::id()){
            abort(403,'Unauthorized Access!');
        }
        
        $category = Category::where('id',$note->category_id)->first();
        return view('notes.show',compact('note','category'));
    }

    
    public function edit(string $id)
    {
        $note = Note::with('images')->findOrFail($id);

        if($note->user_id !== Auth::id()){
            abort(403,'Unauthorized Access');
        }

        $categories = Category::all();
        return view('notes.edit',compact('note','categories'));
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'nullable',
            'category_id'=>'required|exists:categories,id'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $note = Note::findOrFail($id);

        if($note->user_id !== Auth::id()){
            abort(403,'Unauthorized Access');
        }

        $note->title = $request['title'];
        $note->description = $request['description'];
        $note->user_id = $user_id;
        $note->category_id = $request['category_id'];

        $note->save();

        if($request->hasFile('images')){

            $noteImages = NoteImage::where('note_id',$note->id)->get(); // instead of $note->id , $id is also ok

            //remove old multi images in local
            foreach($noteImages as $noteImage){
                $path = $noteImage->image;

                if(File::exists(public_path($path))){
                    File::delete(public_path($path));
                }
            }

            //remove image in DB
            NoteImage::where('note_id',$id)->delete(); // instead of $id  = $note->id


            foreach($request->file('images') as $image){
                $noteImage = new NoteImage();
                $noteImage->note_id = $note->id; // $id is also ok

                $file = $image;
                $fname = $file->getClientOriginalName();
                $imagenewname = uniqid($user_id) . $note['id'] . $fname;
                //local file path
                $file->move(public_path('assets/img/note_images/'),$imagenewname);

                //db path
                $filepath = 'assets/img/note_images/' . $imagenewname;
                $noteImage->image = $filepath;

                $noteImage->save();
            }
        }

        session()->flash('success','New Note Created!');

        return redirect(route('notes.index'));
    }

    
    public function destroy(string $id)
    {
        $note = Note::findOrFail($id);

        if($note->user_id !== Auth::id()){
            abort(403,'Unauthorized Access');
        }
        
        $noteImages = NoteImage::where('note_id',$note->id)->get();

        //remove old multi images in local
        foreach($noteImages as $noteImage){
            $path = $noteImage->image;

            if(File::exists(public_path($path))){
                File::delete(public_path($path));
            }
        }

        NoteImage::where('note_id',$note->id)->delete();
        
        //remove the other columns
        $note->delete();

        session()->flash('info','Note Deleted Successfully!');

        return redirect(route('notes.index'));
    }
}
