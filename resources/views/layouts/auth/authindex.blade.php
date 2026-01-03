@include('layouts.auth.authheader')

    <section class="w-full min-h-screen flex items-center justify-center p-4">

        <div class="w-full max-w-[400px] md:max-w-[750px] bg-white rounded-xl shadow-2xl overflow-hidden flex flex-col md:flex-row h-auto md:h-[500px]">
            
            <div class="w-full md:w-1/2 p-8 md:p-10 flex flex-col justify-center order-1">
                <h1 class="text-center font-bold text-3xl mb-5 text-gray-800">@yield('title')</h1>

                @yield('form')

            </div>

            <div class="w-full md:w-1/2 bg-blue-600 flex flex-col items-center justify-center text-white p-8 space-y-4 order-2 md:order-2 rounded-[50px_50px_0_0] md:rounded-[100px_0px_0px_100px]">
                
                <h1 class="font-bold text-3xl md:text-4xl text-center">@yield('welcome')</h1>

                <p class="text-blue-100 text-center text-sm md:text-base max-w-[200px]">@yield('letter')</p>
                
                @yield('button')

            </div>

        </div>

    </section>

@include('layouts.auth.authfooter')