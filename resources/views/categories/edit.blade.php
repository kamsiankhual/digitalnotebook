@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto">
        
        <div class="mb-5">
            <a href="{{ route('categories.index') }}" class="text-sm text-gray-500 hover:text-indigo-600 flex items-center gap-1 transition-colors">&larr; Back</a>
            <h1 class="text-2xl font-bold text-gray-900 mt-2">Edit Category</h1>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <form action="{{ route('categories.update',$category->id) }}" method="POST">
                @csrf 
                @method('PUT')
                
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                        <input type="text" name="name" id="name" class="w-full border-2 border-gray-300 rounded-lg focus:outline-none px-2 py-2 text-xs transition-colors" value="{{ old('name',$category->name) }}" >
                    </div>

                <div class="pt-6 mt-6 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('categories.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm font-medium">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium shadow-sm">Update Category</button>
                </div>

            </form>
        </div>
    </div>
@endsection