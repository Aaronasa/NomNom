<x-layout>
    <section class="bg-[#FFF8E6] font-[Instrument Sans]">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <img class="mx-auto h-18 w-auto" src="image/LogoDEI.png" alt="Logo">
            </div>
            <div class="w-full bg-white rounded-lg shadow border border-[#E2CEB1] md:mt-5 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-black md:text-2xl">
                        Login to Your Account
                    </h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email -->
                        <div class="relative w-full mb-3">
                            <label class="block uppercase text-[#553827] text-l font-bold mb-2" for="email">
                                Email
                            </label>
                            <input type="email" name="email" id="email" placeholder="Your Email"
                                class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full" 
                                value="{{ old('email') }}"
                                >
                        </div>

                        <!-- Password -->
                        <div class="relative w-full mb-3">
                            <label class="block uppercase text-[#553827] text-l font-bold mb-2" for="password">
                                Password
                            </label>
                            <input type="password" name="password" id="password" placeholder="Your Password"
                                class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full">
                        </div>

                        <div class="text-center mt-6">
                            <button type="submit"
                                class="bg-[#cfad7d] text-white active:bg-[#E5CBA6] text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full"
                                style="transition: all 0.15s ease 0s;">
                                Sign In
                            </button>
                        </div>
    
                        <p class="text-sm font-light text-gray-500">
                            Don't have an account?  <a href="/register" 
                                class="font-medium text-[#E2CEB1] hover:underline">Sign Up here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
