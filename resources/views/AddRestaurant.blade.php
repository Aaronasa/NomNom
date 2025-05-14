<x-layout>
    <div class="w-full min-h-screen bg-[#FFF8E6] font-[Instrument Sans]">
        <div class="container mx-auto px-4 h-screen">
            <div class="flex content-center items-center justify-center h-screen">
                <div class="w-full lg:w-4/12 px-4 pt-5">
                    {{-- Card untuk menambahkan restoran --}}
                    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow border border-[#E2CEB1] rounded-lg bg-white">
                        <div class="rounded-t mb-0 px-6 py-6">
                            <div class="text-center mb-3">
                                <h6 class="text-black text-xl font-bold">Add a Restaurant</h6>
                            </div>
                            <hr class="mt-6 border-b-1 border-[#E5CBA6]">
                        </div>
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            <form action="{{ route('vendor.restaurant.store') }}" method="POST">
                                @csrf
                                <!-- Restaurant Name -->
                                <div class="relative w-full mb-3">
                                    <label for="restaurantName" class="block uppercase text-[#553827] text-xs font-bold mb-2">
                                        Restaurant Name
                                    </label>
                                    <input type="text" name="restaurantName" id="restaurantName"
                                           placeholder="Restaurant Name" value="{{ old('restaurantName') }}"
                                           class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full">
                                    @error('restaurantName')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Restaurant Address -->
                                <div class="relative w-full mb-3">
                                    <label for="restaurantAddress" class="block uppercase text-[#553827] text-xs font-bold mb-2">
                                        Restaurant Address
                                    </label>
                                    <textarea name="restaurantAddress" id="restaurantAddress"
                                              placeholder="Restaurant Address"
                                              class="resize-none mt-1 block px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full">{{ old('restaurantAddress') }}</textarea>
                                    @error('restaurantAddress')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Restaurant Phone -->
                                <div class="relative w-full mb-3">
                                    <label for="restaurantPhone" class="block uppercase text-[#553827] text-xs font-bold mb-2">
                                        Restaurant Phone
                                    </label>
                                    <input type="tel" name="restaurantPhone" id="restaurantPhone"
                                           placeholder="Phone Number" value="{{ old('restaurantPhone') }}"
                                           class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full">
                                    @error('restaurantPhone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Submit Button -->
                                <div class="text-center mt-6">
                                    <button type="submit"
                                            class="bg-[#cfad7d] text-white active:bg-[#E5CBA6] text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full"
                                            style="transition: all 0.15s ease 0s;">
                                        Save Restaurant
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</x-layout>