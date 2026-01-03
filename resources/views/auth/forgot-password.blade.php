@extends('layouts.auth.authindex')

@section('header','Forgot Password')

@section('title','Forgot Password?')

@section('form')
    <form action="{{ route('password.email') }}" method="POST">
        @csrf 

        <div class="relative w-full mb-6">
            <input type="text" name="email" id="email" class="w-full border border-gray-300 px-4 py-2 rounded-full focus:outline-none focus:border-blue-500 placeholder-transparent peer text-gray-700" placeholder="Enter email*" value="{{ old('email') }}" autofocus>
            <label for="email" class="text-gray-500 absolute bg-white px-1.5 transition-all duration-300 ease-in-out -top-3.5 left-4 text-sm peer-placeholder-shown:top-2 peer-placeholder-shown:left-4 peer-placeholder-shown:text-base peer-focus:-top-3.5 peer-focus:left-4 peer-focus:text-blue-500 peer-focus:text-sm">Email*</label>
        </div>

        <div class="w-full mb-6">
            <button type="submit" class="w-full bg-blue-600 text-white font-bold rounded-full py-2.5 cursor-pointer hover:bg-blue-700 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">Email Password Reset Link</button>
        </div>
    </form>
@endsection

@section('welcome',"Forgot password?")

@section('letter','No problem. Just let us know your email address to create a new one.')

@section('button')
    <div class="mt-4">
        <a href="{{ route('login') }}" class="px-8 py-2 bg-transparent border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-blue-600 transition-all duration-300">Login</a>
    </div>
@endsection
