<x-layout>
    <div class="w-full min-h-screen bg-[#FFF8E6] font-[Instrument Sans]">
        <div class="container mx-auto px-4 h-screen">
            <div class="flex content-center items-center justify-center h-screen ">
                <div class="w-full lg:w-4/12 px-4 pt-5">
                    {{-- Card untuk registrasi --}}
                    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow border border-[#E2CEB1] rounded-lg bg-white">
                        <div class="rounded-t mb-0 px-6 py-6">
                            <div class="text-center mb-3">
                                <h6 class="text-black text-xl font-bold">Create an Account</h6>
                            </div>
                            <hr class="mt-6 border-b-1 border-[#E5CBA6]">
                        </div>

                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            <form action="{{ route('register') }}" method="POST">
                                @csrf

                                <!-- Username -->
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-[#553827]  text-xs font-bold mb-2" for="username">
                                        Username
                                    </label>
                                    <input type="text" name="username" id="username" 
                                           placeholder="Your Username" value="{{ old('username') }}"
                                           class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full">
                                    @error('username')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-[#553827] text-xs font-bold mb-2" for="email">
                                        Email
                                    </label>
                                    <input type="email" name="email" id="email" 
                                           placeholder="Your Email" value="{{ old('email') }}"
                                           class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full">
                                    @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-[#553827]  text-xs font-bold mb-2" for="password">
                                        Password
                                    </label>
                                    <input type="password" name="password" id="password" 
                                           placeholder="Your Password"
                                           class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full">
                                    @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone Number -->
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-[#553827] text-xs font-bold mb-2" for="phone">
                                        Phone Number
                                    </label>
                                    <input type="tel" name="phone" id="phone" 
                                           placeholder="Your Phone Number" value="{{ old('phone') }}"
                                           class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full">
                                    @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="relative w-full mb-3">
                                    <label for="address" class="block uppercase text-[#553827] text-xs font-bold mb-2">
                                        Address
                                    </label>
                                    <textarea name="address" id="address" 
                                              placeholder="Your Address" 
                                              class="resize-none mt-1 block px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full">{{ old('address') }}</textarea>
                                    @error('address')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center mt-6">
                                    <button type="submit" 
                                            class="bg-[#cfad7d] text-white active:bg-[#E5CBA6] text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full" 
                                            style="transition: all 0.15s ease 0s;">
                                        Register
                                    </button>
                                </div>
                            </form>

                            <div class=" mt-2">
                                <div class="text-sm text-gray-500">
                                    Already have an account? 
                                    <a href="{{ route('welcome') }}" class="text-[#E2CEB1] hover:underline">Sign In</a>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
