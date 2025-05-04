<x-layout>
<body class="bg-gray-100 font-family-karla flex-container">

<x-sidebar></x-sidebar>

    <!-- Main Content -->
    <main class="main-content">
        <x-user-table :users="$users" />
    </main>

</body>
</x-layout>
