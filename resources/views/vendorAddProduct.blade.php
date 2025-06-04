<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Makanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 flex items-center justify-center p-4">
    <div
        class="w-full max-w-md bg-white backdrop-blur-lg rounded-2xl shadow-2xl p-8 transform hover:scale-105 transition-all duration-300 border border-[#E2CEB1]">
        <!-- Header -->
        <div class="text-center mb-8">
           <img src="{{ asset('image/LogoDEI.png') }}" alt="logo">

            <h1 class="text-2xl font-bold bg-gradient-to-r from-[#553827] to-[#cfad7d] bg-clip-text text-transparent">
                Form Data Makanan
            </h1>
            <p class="text-[#553827] mt-2 opacity-80">Tambahkan makanan baru</p>
        </div>

        <!-- Form -->
        <form id="foodForm" class="space-y-6">
            <!-- Nama Makanan -->
            <div class="group">
                <label for="foodName"
                    class="block text-sm font-semibold text-[#553827] mb-2 group-focus-within:text-[#cfad7d] transition-colors">
                    Nama Makanan
                </label>
                <div class="relative">
                    <input type="text" id="foodName" name="foodName" required
                        class="w-full px-4 py-3 border-2 border-[#E2CEB1] rounded-xl focus:border-[#cfad7d] focus:ring-4 focus:ring-[#FFF8E6] outline-none transition-all duration-300 text-[#553827] placeholder-gray-400"
                        placeholder="Contoh: Nasi Goreng Spesial">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="w-5 h-5 text-[#cfad7d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Deskripsi Makanan -->
            <div class="group">
                <label for="foodDescription"
                    class="block text-sm font-semibold text-[#553827] mb-2 group-focus-within:text-[#cfad7d] transition-colors">
                    Deskripsi Makanan
                </label>
                <div class="relative">
                    <textarea id="foodDescription" name="foodDescription" required rows="3"
                        class="w-full px-4 py-3 border-2 border-[#E2CEB1] rounded-xl focus:border-[#cfad7d] focus:ring-4 focus:ring-[#FFF8E6] outline-none transition-all duration-300 text-[#553827] placeholder-gray-400 resize-none"
                        placeholder="Ceritakan tentang makanan ini... rasa, bahan, keunikan, dll."></textarea>
                    <div class="absolute top-3 right-3">
                        <svg class="w-5 h-5 text-[#cfad7d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Upload Foto -->
            <div class="group">
                <label for="foodImage"
                    class="block text-sm font-semibold text-[#553827] mb-2 group-focus-within:text-[#cfad7d] transition-colors">
                    Foto Makanan
                </label>
                <div class="relative">
                    <input type="file" id="foodImage" name="foodImage" accept="image/*" class="hidden">
                    <div id="imageUploadArea"
                        class="w-full h-32 border-2 border-dashed border-[#E2CEB1] rounded-xl flex flex-col items-center justify-center cursor-pointer hover:border-[#cfad7d] hover:bg-[#FFF8E6] transition-all duration-300">
                        <svg class="w-8 h-8 text-[#cfad7d] mb-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <p class="text-sm text-[#553827] text-center opacity-70">
                            <span class="font-medium text-[#cfad7d]">Klik untuk upload</span><br>
                            atau drag & drop foto di sini
                        </p>
                        <p class="text-xs text-[#553827] opacity-50 mt-1">PNG, JPG hingga 5MB</p>
                    </div>
                    <div id="imagePreview" class="hidden mt-3">
                        <img id="previewImg" src="" alt="Preview"
                            class="w-full h-32 object-cover rounded-xl shadow-sm border border-[#E2CEB1]">
                        <button type="button" id="removeImage"
                            class="mt-2 text-sm text-red-600 hover:text-red-800 flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                            <span>Hapus foto</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Harga -->
            <div class="group">
                <label for="price"
                    class="block text-sm font-semibold text-[#553827] mb-2 group-focus-within:text-[#cfad7d] transition-colors">
                    Harga (Rp)
                </label>
                <div class="relative">
                    <input type="number" id="price" name="price" required min="0" step="1000"
                        class="w-full px-4 py-3 border-2 border-[#E2CEB1] rounded-xl focus:border-[#cfad7d] focus:ring-4 focus:ring-[#FFF8E6] outline-none transition-all duration-300 text-[#553827] placeholder-gray-400 pl-12"
                        placeholder="25000">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <span class="text-[#cfad7d] font-medium">Rp</span>
                    </div>
                </div>
            </div>

            <!-- Tanggal Tersedia -->
            <div class="group">
                <label for="availableDate"
                    class="block text-sm font-semibold text-[#553827] mb-2 group-focus-within:text-[#cfad7d] transition-colors">
                    Tanggal Tersedia
                </label>
                <div class="relative">
                    <input type="date" id="availableDate" name="availableDate" required
                        class="w-full px-4 py-3 border-2 border-[#E2CEB1] rounded-xl focus:border-[#cfad7d] focus:ring-4 focus:ring-[#FFF8E6] outline-none transition-all duration-300 text-[#553827]">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-[#cfad7d]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-[#cfad7d] to-[#B8956A] text-white font-bold py-4 px-6 rounded-xl hover:from-[#B8956A] hover:to-[#A6875C] transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-[#FFF8E6]">
                <span class="flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Tambah Makanan</span>
                </span>
            </button>

            <!-- Back to Dashboard Button -->
            <div class="bg-white p-4 rounded-lg shadow border border-[#E2CEB1] hover:bg-[#FFF8E6] transition text-center cursor-pointer"
                onclick="window.history.back()">

                <span class="text-[#553827] font-medium">Back To Vendor Dashboard</span>
            </div>
        </form>

        <!-- Success Message (Hidden) -->
        <div id="successMessage"
            class="hidden mt-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="font-medium">Data makanan berhasil ditambahkan!</span>
            </div>
        </div>

        <!-- Data Display -->
        <div id="dataDisplay" class="hidden mt-8 p-6 bg-[#FFF8E6] rounded-xl border-2 border-[#E2CEB1]">
            <h3 class="font-bold text-[#553827] mb-4 flex items-center space-x-2">
                <svg class="w-5 h-5 text-[#cfad7d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <span>Data Makanan</span>
            </h3>
            <div id="displayContent" class="space-y-3 text-sm text-[#553827]"></div>
        </div>
    </div>

    <script>
        let uploadedImageData = null;

        // Set today's date as default
        document.getElementById('availableDate').valueAsDate = new Date();

        // Format currency
        const priceInput = document.getElementById('price');
        priceInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value;
        });

        // Image upload functionality
        const imageInput = document.getElementById('foodImage');
        const imageUploadArea = document.getElementById('imageUploadArea');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const removeImageBtn = document.getElementById('removeImage');

        // Click to upload
        imageUploadArea.addEventListener('click', () => {
            imageInput.click();
        });

        // Drag and drop functionality
        imageUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            imageUploadArea.classList.add('border-[#cfad7d]', 'bg-[#FFF8E6]');
        });

        imageUploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            imageUploadArea.classList.remove('border-[#cfad7d]', 'bg-[#FFF8E6]');
        });

        imageUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            imageUploadArea.classList.remove('border-[#cfad7d]', 'bg-[#FFF8E6]');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleImageFile(files[0]);
            }
        });

        // File input change
        imageInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleImageFile(e.target.files[0]);
            }
        });

        // Handle image file
        function handleImageFile(file) {
            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Mohon pilih file gambar yang valid (PNG, JPG, etc.)');
                return;
            }

            // Validate file size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 5MB.');
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                uploadedImageData = e.target.result;
                previewImg.src = uploadedImageData;
                imageUploadArea.classList.add('hidden');
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }

        // Remove image
        removeImageBtn.addEventListener('click', () => {
            uploadedImageData = null;
            imageInput.value = '';
            previewImg.src = '';
            imageUploadArea.classList.remove('hidden');
            imagePreview.classList.add('hidden');
        });

        // Handle form submission
        document.getElementById('foodForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(e.target);
            const data = {
                foodName: formData.get('foodName'),
                foodDescription: formData.get('foodDescription'),
                price: parseInt(formData.get('price')),
                availableDate: formData.get('availableDate')
            };

            // Format price to Indonesian Rupiah
            const formattedPrice = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(data.price);

            // Format date
            const dateObj = new Date(data.availableDate);
            const formattedDate = dateObj.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            // Display success message
            const successMsg = document.getElementById('successMessage');
            successMsg.classList.remove('hidden');

            // Display data
            const dataDisplay = document.getElementById('dataDisplay');
            const displayContent = document.getElementById('displayContent');

            displayContent.innerHTML = `
                <div class="flex justify-between items-center py-2 border-b border-[#E2CEB1]">
                    <span class="font-medium text-[#553827] opacity-70">Nama:</span>
                    <span class="font-semibold text-[#553827]">${data.foodName}</span>
                </div>
                <div class="py-2 border-b border-[#E2CEB1]">
                    <span class="font-medium text-[#553827] opacity-70 block mb-1">Deskripsi:</span>
                    <p class="text-[#553827] text-sm leading-relaxed">${data.foodDescription}</p>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-[#E2CEB1]">
                    <span class="font-medium text-[#553827] opacity-70">Harga:</span>
                    <span class="font-semibold text-green-600">${formattedPrice}</span>
                </div>
                <div class="flex justify-between items-center py-2 ${uploadedImageData ? 'border-b border-[#E2CEB1]' : ''}">
                    <span class="font-medium text-[#553827] opacity-70">Tersedia:</span>
                    <span class="font-semibold text-[#cfad7d]">${formattedDate}</span>
                </div>
                ${uploadedImageData ? `
                    <div class="py-2">
                        <span class="font-medium text-[#553827] opacity-70 block mb-2">Foto:</span>
                        <img src="${uploadedImageData}" alt="Foto ${data.foodName}" class="w-full h-40 object-cover rounded-lg shadow-sm border border-[#E2CEB1]">
                    </div>
                    ` : ''}
            `;

            dataDisplay.classList.remove('hidden');

            // Hide success message after 3 seconds
            setTimeout(() => {
                successMsg.classList.add('hidden');
            }, 3000);

            // Reset form and image
            e.target.reset();
            uploadedImageData = null;
            imageUploadArea.classList.remove('hidden');
            imagePreview.classList.add('hidden');
            document.getElementById('availableDate').valueAsDate = new Date();
        });
    </script>
</body>

</html>
