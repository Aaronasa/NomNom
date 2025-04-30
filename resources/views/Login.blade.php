<x-layout>
    {{-- <x-slot:layoutTitle>{{ $pagetitle }}</x-slot:layoutTitle> --}}
    <section class="bg-white">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <img class="mx-auto h-24 w-auto" src="images/logos.png" alt="Logo">
            </div>
            <div class="w-full bg-white rounded-lg shadow border border-[#E2CEB1] md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Login to Your Account
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                            <input type="text" name="username" id="username" placeholder="Enter your username"
                                class="bg-gray-50 border border-[#E2CEB1] text-gray-900 text-sm rounded-lg focus:ring-[#E2CEB1] focus:border-[#E2CEB1] block w-full p-2.5"
                                value="{{ old('username') }}" required>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter your password"
                                class="bg-gray-50 border border-[#E2CEB1] text-gray-900 text-sm rounded-lg focus:ring-[#E2CEB1] focus:border-[#E2CEB1] block w-full p-2.5"
                                required>
                        </div>
                        @if ($errors->any())
                            <div class="bg-red-100 text-red-800 border border-red-400 p-2 rounded-md mb-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <button type="submit"
                            class="w-full text-white bg-[#E2CEB1] hover:bg-[#A07658] focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Log In
                        </button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don't have an account? <a href="/signup"
                                class="font-medium text-[#E2CEB1] hover:underline">Sign Up here</a>
                        </p>
                    </form>
                    
                </div>
            </div>
        </div>
    </section>
</x-layout>
