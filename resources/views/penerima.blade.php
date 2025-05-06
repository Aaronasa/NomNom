<x-layout>
    <section class="bg-[#FFF8E6] font-[Instrument Sans]">
       <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
           <div class="sm:mx-auto sm:w-full sm:max-w-sm">
               <img class="mx-auto h-18 w-auto" src="image/LogoDEI.png" alt="Logo">
           </div>
           <div class="w-full bg-white rounded-lg shadow border border-[#E2CEB1] md:mt-2 sm:max-w-md xl:p-0">
               <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                   <h1 class="text-xl font-bold leading-tight tracking-tight text-black md:text-2xl">
                       Informasi Penerima
                   </h1>
                   <form method="POST" action="{{ route('recipient.store') }}" enctype="multipart/form-data">
                       @csrf
                       <!-- Nama Penerima -->
                       <div class="relative w-full mb-3">
                           <label class="block uppercase text-[#553827] text-l font-bold mb-2" for="nama_penerima">
                               Nama Penerima
                           </label>
                           <input 
                               type="text" 
                               name="nama_penerima" 
                               id="nama_penerima" 
                               placeholder="Nama Lengkap Penerima"
                               class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                               value="{{ old('nama_penerima') }}"
                               required
                           >
                       </div>
                       
                       <!-- Image Upload -->
                       <div class="relative w-full mb-3">
                           <label class="block uppercase text-[#553827] text-l font-bold mb-2" for="image">
                               Upload Gambar
                           </label>
                           <div class="flex items-center justify-center w-full">
                               <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-[#E2CEB1] border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                   <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                       <svg class="w-8 h-8 mb-3 text-[#cfad7d]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                       </svg>
                                       <p class="mb-1 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span></p>
                                       <p class="text-xs text-gray-500">PNG, JPG atau JPEG (Max. 2MB)</p>
                                   </div>
                                   <input id="image" name="image" type="file" class="hidden" accept="image/png, image/jpeg, image/jpg" required />
                               </label>
                           </div>
                           <div id="image-preview" class="mt-2 flex items-center justify-center hidden">
                               <img id="preview-img" src="#" alt="Preview" class="max-h-32 rounded-lg" />
                           </div>
                       </div>
                       
                       <div class="text-center mt-6">
                           <button type="submit"
                               class="bg-[#cfad7d] text-white active:bg-[#E5CBA6] text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full"
                               style="transition: all 0.15s ease 0s;">
                               Simpan
                           </button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   
       <script>
           // Preview image before upload
           document.getElementById('image').addEventListener('change', function(e) {
               const preview = document.getElementById('preview-img');
               const previewContainer = document.getElementById('image-preview');
               
               if (e.target.files.length > 0) {
                   preview.src = URL.createObjectURL(e.target.files[0]);
                   previewContainer.classList.remove('hidden');
               } else {
                   previewContainer.classList.add('hidden');
               }
           });
       </script>
   </section>
   </x-layout>