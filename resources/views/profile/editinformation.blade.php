@extends('layouts.auth.authindex')

@section('header','Login')

@section('title','Profile Information')

@section('form')
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
        @csrf 
        @method('PATCH')

        <div class="relative w-full mb-6">
            <input type="text" name="name" id="name" class="w-full border border-gray-300 px-4 py-2 rounded-full focus:outline-none focus:border-blue-500 placeholder-transparent peer text-gray-700" placeholder="Name*"  value="{{ old('name',$user->name) }}">
            <label for="name" class="text-gray-500 absolute bg-white px-1.5 transition-all duration-300 ease-in-out -top-3.5 left-4 text-sm peer-placeholder-shown:top-2 peer-placeholder-shown:left-4 peer-placeholder-shown:text-base peer-focus:-top-3.5 peer-focus:left-4 peer-focus:text-blue-500 peer-focus:text-sm">Name*</label>
        </div>

        <div class="relative w-full mb-6">
            <input type="text" name="email" id="email" class="w-full border border-gray-300 px-4 py-2 rounded-full focus:outline-none focus:border-blue-500 placeholder-transparent peer text-gray-700" placeholder="Email*" value="{{ old('email',$user->email) }}">
            <label for="email" class="text-gray-500 absolute bg-white px-1.5 transition-all duration-300 ease-in-out -top-3.5 left-4 text-sm peer-placeholder-shown:top-2 peer-placeholder-shown:left-4 peer-placeholder-shown:text-base peer-focus:-top-3.5 peer-focus:left-4 peer-focus:text-blue-500 peer-focus:text-sm">Email*</label>
        </div>

        <div class="w-full mb-6">
            <button type="submit" class="w-full bg-blue-600 text-white font-bold rounded-full py-2.5 cursor-pointer hover:bg-blue-700 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">Save Update</button>
        </div>
    </form>
@endsection

@section('welcome','Welcome Back!')

@section('letter','To keep connected with us please login with your personal info')

@section('button')
    <div class="mt-4">
        <a href="{{ route('notes.index') }}" class="px-8 py-2 bg-transparent border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-blue-600 transition-all duration-300">Back</a>
    </div>
@stop


