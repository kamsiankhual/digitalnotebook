@extends('layouts.auth.authindex')

@section('header','Register')

@section('title','Register')

@section('form')
    <form action="{{ route('register') }}" method="POST">
        @csrf 

        <div class="relative w-full mb-5">
            <input type="text" name="name" id="name" class="w-full border border-gray-300 px-4 py-2 rounded-full focus:outline-none focus:border-blue-500 placeholder-transparent peer text-gray-700" placeholder="Enter name*" value="{{ old('name') }}">
            <label for="name" class="text-gray-500 absolute bg-white px-1.5 transition-all duration-300 ease-in-out -top-3.5 left-4 text-sm peer-placeholder-shown:top-2 peer-placeholder-shown:left-4 peer-placeholder-shown:text-base peer-focus:-top-3.5 peer-focus:left-4 peer-focus:text-blue-500 peer-focus:text-sm">Name*</label>
        </div>

        <div class="relative w-full mb-5">
            <input type="text" name="email" id="email" class="w-full border border-gray-300 px-4 py-2 rounded-full focus:outline-none focus:border-blue-500 placeholder-transparent peer text-gray-700" placeholder="Enter email*" value="{{ old('email') }}">
            <label for="email" class="text-gray-500 absolute bg-white px-1.5 transition-all duration-300 ease-in-out -top-3.5 left-4 text-sm peer-placeholder-shown:top-2 peer-placeholder-shown:left-4 peer-placeholder-shown:text-base peer-focus:-top-3.5 peer-focus:left-4 peer-focus:text-blue-500 peer-focus:text-sm">Email*</label>
        </div>

        <div class="relative w-full mb-4">
            <input type="password" name="password" id="password" class="w-full border border-gray-300 px-4 py-2 rounded-full focus:outline-none focus:border-blue-500 placeholder-transparent peer text-gray-700" placeholder="Password*">
            <label for="password" class="text-gray-500 absolute bg-white px-1.5 transition-all duration-300 ease-in-out -top-3.5 left-4 text-sm peer-placeholder-shown:top-2 peer-placeholder-shown:left-4 peer-placeholder-shown:text-base peer-focus:-top-3.5 peer-focus:left-4 peer-focus:text-blue-500 peer-focus:text-sm">Password*</label>
        </div>

        <div class="relative w-full mb-4">
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border border-gray-300 px-4 py-2 rounded-full focus:outline-none focus:border-blue-500 placeholder-transparent peer text-gray-700" placeholder="Password*">
            <label for="password_confirmation" class="text-gray-500 absolute bg-white px-1.5 transition-all duration-300 ease-in-out -top-3.5 left-4 text-sm peer-placeholder-shown:top-2 peer-placeholder-shown:left-4 peer-placeholder-shown:text-base peer-focus:-top-3.5 peer-focus:left-4 peer-focus:text-blue-500 peer-focus:text-sm">Confirm Password*</label>
        </div>


        <div class="w-full mb-4">
            <button type="submit" class="w-full bg-blue-600 text-white font-bold rounded-full py-2.5 cursor-pointer hover:bg-blue-700 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">Register</button>
        </div>

        <div class="w-full flex flex-col items-center mb-5">
            <p class="text-gray-400 text-xs mb-4">Or Signup With</p>
            <div class="flex space-x-4">
                <a href="#" class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-full hover:bg-gray-50 hover:border-gray-400 transition-all text-gray-600"><i class="fa-brands fa-github text-lg"></i></a>
                <a href="#" class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-full hover:bg-gray-50 hover:border-gray-400 transition-all text-red-500"><i class="fa-brands fa-google text-lg"></i></a>
                <a href="#" class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-full hover:bg-gray-50 hover:border-gray-400 transition-all text-blue-600"><i class="fa-brands fa-facebook-f text-lg"></i></a>
            </div>
        </div>
    </form>
@stop

@section('welcome','Welcome Back!')

@section('letter','To keep connected with us please login with your personal info')

@section('button')
    <div class="mt-4">
        <a href="{{ route('login') }}" class="px-8 py-2 bg-transparent border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-blue-600 transition-all duration-300">Login</a>
    </div>
@endsection
