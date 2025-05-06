<div class="flex min-h-screen">
    <!-- Fixed Sidebar -->
    <aside class="w-64 bg-white shadow-lg fixed inset-y-0 left-0 z-20 overflow-y-auto">
        <x-sidebar></x-sidebar>
    </aside>

    <!-- Main Content - With left margin to prevent overlap -->
    <div class="flex-1 flex flex-col ml-64">
        <!-- Sticky Header with Search and Create Button -->
        <header class="bg-white shadow-md sticky top-0 z-10 px-6 py-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">User Management</h1>

                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->
                    <div class="relative">
                        <input type="text" id="searchUser" placeholder="Search users..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-500 w-64">
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    <button onclick="alert('Create user functionality will be implemented soon')" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add New User
                    </button>
                    <!-- Export and Print Buttons -->
                   
                </div>
            </div>
        </header>

        <!-- User List Section -->
        <section class="p-6 md:p-10">
            <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-blue-50 px-6 py-4 border-b border-blue-100 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">All Users</h2>
                        <p class="text-sm text-gray-500">Manage user accounts and permissions</p>
                    </div>
                    <div class="flex space-x-2">
                        <button id="exportBtn"
                            class="bg-gray-100 text-gray-700 py-1 px-3 rounded-md hover:bg-gray-200 transition-colors flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Export
                        </button>
                        <button id="printBtn"
                            class="bg-gray-100 text-gray-700 py-1 px-3 rounded-md hover:bg-gray-200 transition-colors flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Print
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 uppercase text-xs border-b">
                                <th class="py-3 px-4 font-semibold text-left">ID</th>
                                <th class="py-3 px-4 font-semibold text-left">Username</th>
                                <th class="py-3 px-4 font-semibold text-left">Email</th>
                                <th class="py-3 px-4 font-semibold text-left">Phone</th>
                                <th class="py-3 px-4 font-semibold text-left">Address</th>
                                <th class="py-3 px-4 font-semibold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 px-4">{{ $user->id }}</td>
                                    <td class="py-3 px-4 font-medium">{{ $user->username }}</td>
                                    <td class="py-3 px-4">{{ $user->email }}</td>
                                    <td class="py-3 px-4">{{ $user->phone }}</td>
                                    <td class="py-3 px-4">{{ $user->address }}</td> 
                                    <td class="py-3 px-4">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('admin.edituser', $user->id) }}"
                                                class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600 transition flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.deleteuser', $user->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 transition flex items-center"
                                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <p class="text-lg font-medium">No users found</p>
                                            <p class="text-sm">Get started by creating a new user</p>
                                            <button onclick="alert('Create user functionality will be implemented soon')" class="mt-4 bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition">
                                                Create Your First User
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination section -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        Showing <span class="font-medium">{{ count($users) }}</span> users
                    </div>
                    <div>
                        <!-- Pagination placeholder -->
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    // Search functionality
    const searchInput = document.getElementById('searchUser');
    
    function filterUsers() {
        const searchTerm = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const username = row.cells[1]?.textContent.toLowerCase() || '';
            const email = row.cells[2]?.textContent.toLowerCase() || '';
            const phone = row.cells[3]?.textContent.toLowerCase() || '';
            const address = row.cells[4]?.textContent.toLowerCase() || '';
            
            const isVisible = (
                username.includes(searchTerm) || 
                email.includes(searchTerm) || 
                phone.includes(searchTerm) || 
                address.includes(searchTerm)
            );
            
            row.style.display = isVisible ? '' : 'none';
        });
    }
    
    searchInput.addEventListener('input', filterUsers);
    
    // Export functionality
    document.getElementById('exportBtn').addEventListener('click', function() {
        alert('Export functionality will be implemented here');
    });
    
    // Print functionality
    document.getElementById('printBtn').addEventListener('click', function() {
        window.print();
    });
</script>