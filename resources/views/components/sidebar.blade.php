<style>
    @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

    .font-family-karla { font-family: karla; }
    .bg-sidebar { background: #E5CBA6; }
    .cta-btn { color: #3d68ff; }
    .upgrade-btn { background: #1947ee; }
    .upgrade-btn:hover { background: #0038fd; }
    .active-nav-link { background: #E5CBA6; }
    .nav-item:hover { background: #d9b88f; }
    .account-link:hover { background: #3d68ff; }

    .flex-container {
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        width: 250px;
        background-color: #E5CBA6; /* Updated background color */
        color: #E5CBA6; /* Adjusted text color for contrast */
        position: fixed;
        height: 100vh;
    }

    .main-content {
        margin-left: 250px;
        padding: 20px;
        width: calc(100% - 250px);
        background-color: white;
    }

    .rainbow-admin {
        font-size: 3rem;
        font-weight: 600;
        text-transform: uppercase;
        text-decoration: none;
        background: linear-gradient(90deg,orange, brown);
        background-size: 400% 100%;
        color: white;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: rainbow 3s infinite;
        transition: color 0.3s ease;
    }

    .rainbow-text:hover {
        color: gray;
        background: none;
        -webkit-text-fill-color: currentColor;
        -webkit-background-clip: unset;
    }

    @keyframes rainbow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
</style>

<div>
    <aside class="sidebar">
        <div class="p-6">
            <a href="{{ route('login') }}" class="rainbow-admin">Admin</a>
        </div>
    <nav class="text-[#E5CBA6] text-base font-semibold pt-3">
            <a href="{{ route('admin.users') }}" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-users mr-3"></i>
                All Users
            </a>
            <a href="{{ route('admin.restaurants') }}" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-utensils mr-3"></i>
                All Restaurants
            </a>
            <a href="{{ route('admin.foods') }}" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-hamburger mr-3"></i>
                All Foods
            </a>
            <a href="{{ route('admin.orderDetails') }}" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-shopping-cart mr-3"></i>
                All Orders
            </a>
        </nav>
    </aside>
</div>
