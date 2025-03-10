<div x-data="{ open: true }" class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg flex flex-col transition-transform duration-300 ease-in-out transform translate-x-0">
        
        <div class="p-4 text-lg font-bold text-gray-800 border-b flex items-center">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-700 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h18M3 9h18M3 15h18M3 21h18" />
                </svg>
                Dashboard
            </div>
        </div>

        <nav class="flex-1 px-4 py-4">
            @if(Auth::user()->role == "Administrator")
                <a href="{{ route('main') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-200">
                    <svg class="w-5 h-5 text-gray-700 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7m-9 2v8a2 2 0 002 2h4a2 2 0 002-2v-8m-6 6h6" />
                    </svg>
                    <span class="text-gray-700">Dashboard</span>
                </a>
            @elseif(Auth::user()->role == "Petugas")
                <a href="{{ route('petugas.main') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-200">
                    <svg class="w-5 h-5 text-gray-700 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7m-9 2v8a2 2 0 002 2h4a2 2 0 002-2v-8m-6 6h6" />
                    </svg>
                    <span class="text-gray-700">Dashboard</span>
                </a>
            @endif

            @if(Auth::user()->role == "Administrator")
                <a href="{{ route('admin.pembelian') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-200">
                    <svg class="w-5 h-5 text-gray-700 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h18M3 9h18M3 15h18M3 21h18" />
                    </svg>
                    <span class="text-gray-700">Pembelian</span>
                </a>
            @elseif(Auth::user()->role == "Petugas")
                <a href="{{ route('petugas.pembelian') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-200">
                    <svg class="w-5 h-5 text-gray-700 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h18M3 9h18M3 15h18M3 21h18" />
                    </svg>
                    <span class="text-gray-700">Pembelian</span>
                </a>
            @endif

            <a href="{{ Auth::user()->role == 'Administrator' ? route('admin.product') : route('petugas.product') }}"
                class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-200">
                <svg class="w-5 h-5 text-gray-700 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h18M3 9h18M3 15h18M3 21h18" />
                </svg>
                <span class="text-gray-700">Produk</span>
            </a>

            @if(Auth::user()->role == "Administrator")
                <a href="{{ route('admin.user') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-200">
                    <svg class="w-5 h-5 text-gray-700 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h18M3 9h18M3 15h18M3 21h18" />
                    </svg>
                    <span class="text-gray-700">User</span>
                </a>
            @endif
        </nav>

        <div class="border-t p-4">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 mt-2 text-gray-700 hover:bg-gray-200 rounded-lg">
                Profile
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="block w-full px-4 py-2 mt-2 text-left text-gray-700 hover:bg-gray-200 rounded-lg">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col lg:ml-64 transition-all duration-300">
        <!-- Header -->
        <div class="flex justify-between items-center bg-white bg-opacity-70 shadow-md p-4">
            <div class="flex items-center">
                <svg class="w-8 h-8 text-gray-700 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A9 9 0 1119.804 5.121M12 7a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <div>
                    <div class="text-gray-800 font-medium">{{ Auth::user()->name }}</div>
                    <div class="text-gray-500 text-sm">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>
        <div class="p-6">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</div>
