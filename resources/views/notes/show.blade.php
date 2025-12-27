@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto">
        
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('notes.index') }}" class="text-gray-500 hover:text-indigo-600 flex items-center gap-1 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back
            </a>

            <div class="flex gap-3">
                <a href="{{ route('notes.edit',$note) }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium text-sm shadow-sm transition">Edit Note</a>
                
                <form action="{{ route('notes.destroy',$note) }}" method="POST" onsubmit="return confirm('Delete this {{ $note->title }} note?');">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-50 border border-red-200 rounded-lg text-red-600 hover:bg-red-100 font-medium text-sm shadow-sm transition">Delete</button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            
            <!-- category, title , Date  -->
            <div class="px-8 py-8 border-b border-gray-100 bg-gray-50/30">
                <div class="flex items-center justify-between gap-3 mb-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">{{ $category->name }}</span>
                    <span class="text-sm text-gray-400">Created {{ $note->created_at->format('Y-m-d') }}</span>
                </div>
                
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight text-center">{{ $note->title }}</h1>
            </div>

            <!-- Description -->
            <div class="px-10 mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <div class="w-full h-20 rounded-lg border-2 border-gray-300 focus:outline-none px-2 py-1 text-base">{!! $note->description !!}</div>
            </div>

            <!-- Images -->
            <div class="px-10 pb-10">
                <span class="block text-sm font-medium text-gray-700 mb-2">Screenshots</span>
                <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors">
                    <label for="images" class="gallery flex space-x-5">
                        @if(!empty($note) && $note->images->count() > 0)
                            @foreach($note->images as $image)
                            <a href="{{ asset($image->image) }}" data-lightbox="{{ $note->title }}" data-title="{{ $note->title }}" class="w-60 h-60">
                                <img src="{{ asset($image->image) }}" alt="{{ $image->id }}" class="w-60 h-60">
                            </a>
                            @endforeach
                        @else
                            <span>No Image to Show</span>
                        @endif
                    </label>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('css')
    <link href="{{ asset('assets/libs/lightbox2-dev/lightbox2-dev/dist/css/lightbox.min.css') }}" rel="stylesheet" />
@endsection

@section('scripts')
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <script src="{{ asset('assets/libs/lightbox2-dev/lightbox2-dev/dist/js/lightbox.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            });
        });
    </script>
@endsection
