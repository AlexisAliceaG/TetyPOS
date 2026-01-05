<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex h-full items-center">

                    @can('crear ventas')
                    <x-nav-link :href="route('sales.create')" :active="request()->routeIs('sales.create')">
                        🛒 {{ __('Caja') }}
                    </x-nav-link>
                    @endcan

                    @hasrole('admin')
                    <div class="inline-flex items-center h-full pt-1">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out h-full">
                                    <span>⚙️ Gestión</span>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('products.index')">
                                    📦 {{ __('Inventario') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('categories.index')">
                                    📂 {{ __('Categorías') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('brands.index')">
                                    🏷️ {{ __('Marcas') }}
                                </x-dropdown-link>
                                <hr class="border-gray-100">
                                <x-dropdown-link :href="route('users.index')">
                                    👥 {{ __('Usuarios') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endhasrole

                    @can('ver reportes')
                    <div class="inline-flex items-center h-full pt-1">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out h-full">
                                    <span>📊 Reportes</span>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('reports.sales')">
                                    💵 Ventas Diarias
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('reports.products')">
                                    🏷️ Lo más Vendido
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endcan
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                            <div class="font-bold border-b border-indigo-200">{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                🚪 {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            
            <div class="-me-2 flex items-center sm:hidden relative" x-data="{ open: false }">
    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
        <div x-show="open" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.away="open = false"
            class="absolute right-0 top-full mt-2 w-48 origin-top-right rounded-md shadow-lg z-50 bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none" 
            style="display: none;">
            
            <div class="py-1">
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-200 shadow-lg">
    <div class="pt-2 pb-3 space-y-1">
        
        @can('crear ventas')
            <x-responsive-nav-link :href="route('sales.create')" :active="request()->routeIs('sales.create')">
                🛒 {{ __('Caja') }}
            </x-responsive-nav-link>
        @endcan

        @hasrole('admin')
            <div class="border-t border-gray-100 mt-2 pt-2">
                <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-widest">
                    ⚙️ {{ __('Gestión') }}
                </div>
                <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                    📦 {{ __('Inventario') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                    📂 {{ __('Categorías') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('brands.index')" :active="request()->routeIs('brands.*')">
                    🏷️ {{ __('Marcas') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                    👥 {{ __('Usuarios') }}
                </x-responsive-nav-link>
            </div>
        @endhasrole

        @can('ver reportes')
            <div class="border-t border-gray-100 mt-2 pt-2">
                <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-widest">
                    📊 {{ __('Reportes') }}
                </div>
                <x-responsive-nav-link :href="route('reports.sales')" :active="request()->routeIs('reports.sales')">
                    💵 {{ __('Ventas Diarias') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('reports.products')" :active="request()->routeIs('reports.products')">
                    🏷️ {{ __('Lo más Vendido') }}
                </x-responsive-nav-link>
            </div>
        @endcan

    </div>
</div>
            </div>
        </div>
    </div>
        </div>
    </div>
</nav>