<div class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-[#553827]">Vendor Dashboard</h1>
            <div class="flex items-center space-x-4">
                <span>Hello,</span>
                <span class="text-[#A07658]">{{ Auth::user()->username }}</span>
                <a href="{{ route('logout') }}" class="bg-[#cfad7d] text-white px-4 py-2 rounded hover:bg-[#E5CBA6] transition">Logout</a>
            </div>
        </div>
    </div>
</div>