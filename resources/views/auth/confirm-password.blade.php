@extends('layouts.auth.authindex')

@section('content')
    <div class="h-screen flex items-center justify-center">
        <div class="w-1/4 bg-black rounded-xl flex flex-col space-y-16 overflow-hidden shadow-[5px_10px_3px_rgba(0,0,0,0.3)]">
            <div class="w-full flex items-center justify-center pt-16 px-3">
                <p class="text-sm text-white text-justify">This is a secure area of the application. Please confirm your password before continuing.</p>
            </div>

            <!-- form -->
            <div class="w-full border bg-white rounded-[100px_0px_0px_0px] px-10 py-10">
                <form action="{{ route('password.confirm') }}" method="POST">
                    @csrf 

                    <div class="mb-3 flex flex-col">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="w-full border border-black focus:border-none focus:outline-none focus:ring-1 focus:ring-blue-500 px-2 py-2 text-sm rounded-full transition-colors" />
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-blue-500 text-white font-semibold text-normal py-2 rounded-full hover:bg-blue-600 transition-all duration-300">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

