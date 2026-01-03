@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full md:w-1/3 bg-black rounded-xl flex flex-col space-y-6 overflow-hidden shadow-[5px_10px_3px_rgba(0,0,0,0.3)]">
            
            <div class="w-full flex items-center justify-center pt-10 pb-2">
                <h1 class="text-white text-xl font-semibold">Edit Profile</h1>
            </div>

            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <div class="w-full border bg-white rounded-[60px_0px_0px_0px] px-8 py-10 space-y-12">

                <section>
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-gray-900">Profile Information</h2>
                        <p class="text-sm text-gray-500">Update your account's profile information and email address.</p>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                        @csrf 
                        @method('PATCH')

                        <div class="flex flex-col">
                            <label for="name" class="text-sm font-medium mb-1 text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="w-full border border-black focus:border-none focus:outline-none focus:ring-1 focus:ring-blue-500 px-3 py-2 text-sm rounded-full transition-colors" placeholder="Enter your name" value="{{ old('name', $user->name) }}">
                            @error('name') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="email" class="text-sm font-medium mb-1 text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="w-full border border-black focus:border-none focus:outline-none focus:ring-1 focus:ring-blue-500 px-3 py-2 text-sm rounded-full transition-colors" placeholder="Enter your email" value="{{ old('email', $user->email) }}">
                            @error('email') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="mt-2">
                                    <p class="text-sm text-gray-800">
                                        Your email address is unverified.
                                        <button form="send-verification" class="underline text-sm text-blue-600 hover:text-blue-900">Click here to re-send the verification email.</button>
                                    </p>
                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600">A new verification link has been sent to your email address.</p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="w-full bg-blue-500 text-white font-semibold text-sm py-2 rounded-full hover:bg-blue-600 transition-all duration-300">Save Information</button>
                    </form>
                </section>

                <hr class="border-gray-200">

                <section>
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-gray-900">Update Password</h2>
                        <p class="text-sm text-gray-500">Ensure your account is using a long, random password to stay secure.</p>
                    </div>

                    <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                        @csrf 
                        @method('put')

                        <div class="flex flex-col">
                            <label for="current_password" class="text-sm font-medium mb-1 text-gray-700">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="w-full border border-black focus:border-none focus:outline-none focus:ring-1 focus:ring-blue-500 px-3 py-2 text-sm rounded-full transition-colors" placeholder="Current Password">
                            @error('current_password') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="update_password" class="text-sm font-medium mb-1 text-gray-700">New Password</label>
                            <input type="password" name="password" id="update_password" class="w-full border border-black focus:border-none focus:outline-none focus:ring-1 focus:ring-blue-500 px-3 py-2 text-sm rounded-full transition-colors" placeholder="New Password">
                            @error('password') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="update_password_confirmation" class="text-sm font-medium mb-1 text-gray-700">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="update_password_confirmation" class="w-full border border-black focus:border-none focus:outline-none focus:ring-1 focus:ring-blue-500 px-3 py-2 text-sm rounded-full transition-colors" placeholder="Confirm New Password">
                        </div>

                        <button type="submit" class="w-full bg-black text-white font-semibold text-sm py-2 rounded-full hover:bg-gray-800 transition-all duration-300">Update Password</button>
                    </form>
                </section>

                <hr class="border-gray-200">

                <section>
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-red-600">Delete Account</h2>
                        <p class="text-sm text-gray-500">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                    </div>

                    <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                        @csrf
                        @method('delete')

                        <div class="flex flex-col">
                            <label for="delete_password" class="text-sm font-medium mb-1 text-gray-700">Password</label>
                            <input type="password" name="password" id="delete_password" class="w-full border border-red-300 focus:border-none focus:outline-none focus:ring-1 focus:ring-red-500 px-3 py-2 text-sm rounded-full transition-colors" placeholder="Enter password to confirm deletion">
                            @error('password', 'userDeletion') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="w-full bg-red-600 text-white font-semibold text-sm py-2 rounded-full hover:bg-red-700 transition-all duration-300">Delete Account</button>
                    </form>
                </section>

            </div>
        </div>
    </div>
@endsection