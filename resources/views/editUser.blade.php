<x-layout>
    <div class="w-full min-h-screen bg-gray-900">
        <div class="container mx-auto px-4 h-screen">
            <div class="flex content-center items-center justify-center h-screen">
                <div class="w-full lg:w-4/12 px-4 pt-5">
                    {{-- Card Wrapper --}}
                    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
                        <div class="rounded-t mb-0 px-6 py-6">
                            <div class="text-center mb-3">
                                <h6 class="text-black-600 text-sm font-bold">Edit User : {{ old('username', $user->username) }} </h6>
                            </div>
                            <hr class="mt-6 border-b-1 border-gray-400">
                        </div>
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            <form method="POST" action="{{ route('admin.updateuser', $user->id) }}">
                                @csrf
                                @method('PUT')
                                
                                <!-- Username -->
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="username">
                                        Username
                                    </label>
                                    <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" 
                                        placeholder="Enter Username"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full">
                                </div>

                                <!-- Email -->
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="email">
                                        Email
                                    </label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                        placeholder="Enter Email"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full">
                                </div>

                                <!-- Phone -->
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="phone">
                                        Phone
                                    </label>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" 
                                        placeholder="Enter Phone Number"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full">
                                </div>

                                <!-- Address -->
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="address">
                                        Address
                                    </label>
                                    <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" 
                                        placeholder="Enter Address"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full">
                                </div>

                                <!-- Save Button -->
                                <div class="text-center mt-6">
                                    <button type="submit"
                                        class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full"
                                        style="transition: all 0.15s ease 0s;">
                                        Save Changes
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
