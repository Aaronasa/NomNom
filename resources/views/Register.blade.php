<x-layout>
    {{-- <x-slot:layoutTitle>{{ $pagetitle }}</x-slot:layoutTitle> --}}
    <section class="bg-white">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <img class="mx-auto h-24 w-auto" src="images/logos.png" alt="Logo">
            </div>
            <!-- Tambahkan border dengan warna #E2CEB1 di sini -->
            <div class="w-full bg-white rounded-lg shadow border border-[#E2CEB1] md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Create an account
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('register') }}" method="POST" id="register-form">
                        @csrf
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                            <input type="text" name="username" id="username" value="{{ old('username') }}"
                                placeholder="username"
                                class="bg-gray-50 border border-[#E2CEB1] text-gray-900 text-sm rounded-lg focus:ring-[#E2CEB1] focus:border-[#E2CEB1] block w-full p-2.5"
                                required="">
                            @error('username')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <div>
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}"
                                placeholder="123 Main St, Springfield"
                                class="bg-gray-50 border border-[#E2CEB1] text-gray-900 text-sm rounded-lg focus:ring-[#E2CEB1] focus:border-[#E2CEB1] block w-full p-2.5"
                                required="">
                            @error('address')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <div>
                            <label for="number" class="block mb-2 text-sm font-medium text-gray-900">Phone Number</label>
                            <input type="text" name="number" id="number" value="{{ old('number') }}"
                                placeholder="1234567890"
                                class="bg-gray-50 border border-[#E2CEB1] text-gray-900 text-sm rounded-lg focus:ring-[#E2CEB1] focus:border-[#E2CEB1] block w-full p-2.5"
                                required="">
                            @error('number')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-[#E2CEB1] text-gray-900 text-sm rounded-lg focus:ring-[#E2CEB1] focus:border-[#E2CEB1] block w-full p-2.5"
                                required="">
                            @error('password')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                                class="bg-gray-50 border border-[#E2CEB1] text-gray-900 text-sm rounded-lg focus:ring-[#E2CEB1] focus:border-[#E2CEB1] block w-full p-2.5"
                                required="">
                            @error('password_confirmation')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <button type="submit"
                            class="w-full text-white bg-[#E2CEB1] hover:bg-[#A07658] focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Create an account
                        </button>
                    
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Already have an account? <a href="/signin"
                                class="font-medium text-[#E2CEB1] hover:underline ">Login here</a>
                        </p>
                    </form>
                    
                </div>
            </div>
        </div>
    </section>
    <x-footer />
</x-layout>
