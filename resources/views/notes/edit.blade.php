@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        
        <div class="mb-5">
            <a href="{{ route('notes.index') }}" class="text-sm text-gray-500 hover:text-indigo-600 flex items-center gap-1 transition-colors">&larr; Back</a>
            <h1 class="text-3xl font-bold text-gray-900 mt-3">Edit Note</h1>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            
            <form action="{{ route('notes.update',$note->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf 
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Category -->
                    <div>
                        <label class="text-sm font-medium text-gray-700 mb-2">Category</label>
                        @error('category_id')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                        <select name="category_id" class="w-full border-2 border-gray-300 rounded-lg focus:outline-none px-2 py-2 text-xs transition-colors">
                            <option disabled selected>Select Note Category</option>
                            
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                @if( $note->category_id === $category->id )
                                    selected
                                @endif
                                >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label class="text-sm font-medium text-gray-700 mb-2">Note Title</label> 
                        @error('title')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                        <input type="text" name="title" class="w-full border-2 border-gray-300 rounded-lg focus:outline-none px-2 py-2 text-xs transition-colors" value="{{ old('title',$note->title) }}">
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="10" class="w-full rounded-lg border-2 border-gray-300 focus:outline-none px-2 py-1 text-xs" rows="10">{{ old('description',$note->description) }}</textarea>
                </div>

                <!-- Images -->
                <div>
                    <span class="block text-sm font-medium text-gray-700 mb-2">Screenshots</span>
                    <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors">
                        <label for="images" class="gallery">
                            @if(!empty($note) && $note->images->count() > 0)
                                @foreach($note->images as $image)
                                <img src="{{ asset($image->image) }}" alt="{{ $image->id }}">
                                @endforeach
                            @else
                            <div class="textdiv">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span class="text-xl font-bold">Upload files</span>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                            </div>
                            @endif
                        </label>
                        <input type="file" name="images[]" id="images" multiple hidden>
                    </div>
                </div>

                <div class="pt-5 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('notes.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700">Update Note</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('css')
<style>
    .gallery {
        width: 100%;
        background-color: #eeee;
        color: #aaa;

        text-align: center;
        padding: 10px;

        display: flex;
        flex-direction:row;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-evenly;

    }

    .gallery.removetext .textdiv{
        display: none;
    }

    .gallery img {
        width: 100px;
        height: 100px;
        border: 2px dashed #aaa;
        border-radius: 10px;
        object-fit: cover;

        padding: 5px;
        margin: 5px;
    }
</style>
@stop

@section('scripts')
    <script>

        $(document).ready(function(){

            //Summer note
            $('#description').summernote({
                placeholder: 'Say Something...',
                height: 120,
                toolbar:[
                    ['font',['light','underline','clear']],
                    ['color',['color']],
                    ['para',['ul','ol','paragraph']],
                    ['insert',['link']]
                ]
            });

            
            // Start Multi Profile Preview

            let previewimages = function(input, output) {
                console.log(input, output);

                if (input.files) {
                    let totalfiles = input.files.length;
                    // console.log(totalfiles);
                    if (totalfiles > 0) {
                        $(output).addClass('removetext');
                    } else {
                        $(output).removeClass('removetext');
                    }

                    $(output).find('img').remove();
                    
                    for (let x = 0; x < totalfiles; x++) {
                        // console.log(x);
                        let filereader = new FileReader();
                        filereader.readAsDataURL(input.files[x]);

                        filereader.onload = function(e) {
                            $($.parseHTML('<img>')).attr('src', e.target.result).appendTo(output);
                        }
                    }
                }
            }

            $('#images').change(function() {
                previewimages(this, 'label.gallery');
            });

            // End Multi Profile Preview

        });

    </script>
@stop