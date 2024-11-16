<div x-data="{ sidebar: false }">
    <button @click="sidebar = !sidebar" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': sidebar, 'inline-flex': ! sidebar }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': ! sidebar, 'inline-flex': sidebar }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <div class="fixed inset-0 flex justify-start bg-gray-500 bg-opacity-25" x-show="sidebar" x-transition:enter="transition ease-in-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="fixed inset-0" aria-hidden="true" x-show="sidebar" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
        <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white" x-show="sidebar" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
            <div class="absolute top-0 right-0 -mr-12 pt-2">
                <button class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" x-on:click="sidebar = false">
                    <span class="sr-only">Close sidebar</span>
                    <svg class="h-6 w-6 text-white" x-description="Heroicon name: outline/x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                <div class="flex-shrink-0 flex items-center justify-center">
                    <img class="h-20 w-auto" src="{{ asset('storage/LOGO.png') }}">
                </div>
                <hr class="border-t border-gray-200 my-4 w-full" />
                <nav class="mt-5 flex-1" aria-label="Sidebar">
                    <div class="px-2 space-y-1">
                        <a href="{{ route('dashboard') }}" @click="sidebar = true" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-green-500 to-green-700 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-6 w-6 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('data.customer') }}" @click="sidebar = true" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('data.customer') ? 'bg-gradient-to-r from-green-500 to-green-700 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
                            <svg class="text-gray-300 mr-3 h-6 w-6 {{ request()->routeIs('data.customer') ? 'text-white' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                            </svg>
                            Data customer
                        </a>
                        <a href="{{ route('data.produk') }}" @click="sidebar = true" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('data.produk') ? 'bg-gradient-to-r from-green-500 to-green-700 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
                            <svg class="text-gray-300 mr-3 h-6 w-6 {{ request()->routeIs('data.produk') ? 'text-white' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                            </svg>
                            Data Produk
                        </a>
                        <a href="{{ route('data.pemesanan') }}" @onclick="sidebar = true" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('data.pemesanan') ? 'bg-gradient-to-r from-green-500 to-green-700 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
                            <svg class="text-gray-300 mr-3 h-6 w-6 {{ request()->routeIs('data-pemesanan') ? 'text-white' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                            </svg>
                            Data Pemesanan
                        </a>
                    </div>
                </nav>
            </div>
            <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                <a href="#" class="group block flex-shrink-0">
                    <div class="flex items-center">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs font-medium text-gray-500 group-hover:text-gray-700">
                                Setting
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>