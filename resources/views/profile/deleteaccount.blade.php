@extends('layouts.auth.authindex')

@section('header','Delete Account')

@section('title','Delete Account')

@section('form')
            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('delete')

                <div class="relative w-full mb-5">
                    <input type="password" name="password" class="w-full border border-gray-300 px-4 py-2 rounded-full focus:outline-none focus:border-blue-500 placeholder-transparent peer text-gray-700" placeholder="Password*">
                    <label class="text-gray-500 absolute bg-white px-1.5 transition-all duration-300 ease-in-out -top-3.5 left-4 text-sm peer-placeholder-shown:top-2 peer-placeholder-shown:left-4 peer-placeholder-shown:text-base peer-focus:-top-3.5 peer-focus:left-4 peer-focus:text-blue-500 peer-focus:text-sm">Password*</label>
                </div>

                <div class="w-full mb-4">
                    <button type="submit" class="w-full bg-red-600 text-white font-bold rounded-full py-2.5 cursor-pointer hover:bg-red-700 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">Delete Account</button>
                </div>
            </form>
@stop

@section('welcome','Welcome Back!')

@section('letter','Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.')

@section('button')
    <div class="mt-4">
        <a href="{{ route('notes.index') }}" class="px-8 py-2 bg-transparent border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-blue-600 transition-all duration-300">Back</a>
    </div>
@endsection
