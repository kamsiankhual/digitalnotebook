@extends('layouts.auth.authindex')

@section('content')
    <div class="h-screen flex items-center justify-center">
        <div class="w-1/4 bg-black rounded-xl flex flex-col space-y-16 overflow-hidden shadow-[5px_10px_3px_rgba(0,0,0,0.3)]">
            <div class="w-full flex items-center justify-center pt-16 px-3">
                <p class="text-sm text-white text-justify">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</p>
                
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">A new verification link has been sent to the email address you provided during registration.</div>
                @endif

            </div>

            <!-- form -->
            <div class="w-full border bg-white rounded-[100px_0px_0px_0px] px-10 py-10">
                <form action="{{ route('verification.send') }}" method="POST">
                    @csrf 

                    <div class="mb-3 flex flex-col">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="w-full border border-black focus:border-none focus:outline-none focus:ring-1 focus:ring-blue-500 px-2 py-2 text-sm rounded-full transition-colors" />
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-blue-500 text-white font-semibold text-normal py-2 rounded-full hover:bg-blue-600 transition-all duration-300">Resend Verification Email</button>
                    </div>
                </form>
            </div>

            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Log Out
                    </button>
                </form>
            </div>
            
        </div>
    </div>
@stop

