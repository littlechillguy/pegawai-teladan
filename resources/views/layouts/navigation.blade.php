<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            {{-- Logo --}}
            <div class="flex">

                <div class="shrink-0 flex items-center">

                    <a href="{{ auth()->user()->role === 'admin'
    ? route('admin.dashboard')
    : route('dashboard') }}" class="flex flex-col">

                        <span class="text-lg font-bold text-gray-800">
                            Ruang Keteladanan
                        </span>

                        <span class="text-[10px] text-gray-500">
                            PPSDM
                        </span>

                    </a>

                </div>

                {{-- Desktop Navigation --}}
                <div class="hidden sm:flex sm:items-center sm:ms-8">

                    @if(auth()->user()->role === 'admin')

                        <div class="flex items-center gap-1">

                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>

                            <x-nav-link :href="route('admin.employees.index')"
                                :active="request()->routeIs('admin.employees.*')">
                                {{ __('Pegawai') }}
                            </x-nav-link>

                            <x-nav-link :href="route('admin.periods.index')"
                                :active="request()->routeIs('admin.periods.*')">
                                {{ __('Periode') }}
                            </x-nav-link>

                            <x-nav-link :href="route('admin.candidates.index')"
                                :active="request()->routeIs('admin.candidates.*')">
                                {{ __('Kandidat') }}
                            </x-nav-link>

                            <x-nav-link :href="route('admin.assessment-results.index')"
                                :active="request()->routeIs('admin.assessment-results.*')">
                                {{ __('Hasil Penilaian') }}
                            </x-nav-link>

                            <x-nav-link :href="route('admin.criteria.index')"
                                :active="request()->routeIs('admin.criteria.*')">
                                {{ __('Kriteria') }}
                            </x-nav-link>

                            <x-nav-link :href="route('admin.hall-of-fame.index')"
                                :active="request()->routeIs('admin.hall-of-fame.*')">
                                {{ __('Hall of Fame') }}
                            </x-nav-link>

                        </div>

                    @else

                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            Dashboard
                        </x-nav-link>

                    @endif

                </div>

            </div>


            {{-- User Dropdown --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 bg-white hover:text-gray-900 focus:outline-none transition">

                            <div class="text-right">

                                <div>
                                    {{ Auth::user()->employee->name }}
                                </div>

                                <div class="text-xs text-gray-400">
                                    {{ Auth::user()->employee->nip }}
                                </div>

                            </div>

                            <div class="ms-2">

                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">

                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />

                                </svg>

                            </div>

                        </button>

                    </x-slot>


                    <x-slot name="content">

                        <div class="px-4 py-3 border-b border-gray-100">

                            <p class="text-sm font-medium text-gray-800">
                                {{ Auth::user()->employee->name }}
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Pegawai' }}
                            </p>

                        </div>


                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                Keluar
                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>


            {{-- Mobile Hamburger --}}
            <div class="-me-2 flex items-center sm:hidden">

                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">

                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">

                        <path :class="{
                                'hidden': open,
                                'inline-flex': !open
                            }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{
                                'hidden': !open,
                                'inline-flex': open
                            }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>

    </div>


    {{-- Mobile Navigation --}}
    <div :class="{
            'block': open,
            'hidden': !open
        }" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">

            @if(auth()->user()->role === 'admin')

                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    Dashboard
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.employees.index')"
                    :active="request()->routeIs('admin.employees.*')">
                    Pegawai
                </x-responsive-nav-link>

            @else

                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    Dashboard
                </x-responsive-nav-link>

            @endif

        </div>


        {{-- Mobile User --}}
        <div class="pt-4 pb-1 border-t border-gray-200">

            <div class="px-4">

                <div class="font-medium text-base text-gray-800">
                    {{ Auth::user()->employee->name }}
                </div>

                <div class="font-medium text-sm text-gray-500">
                    {{ Auth::user()->employee->nip }}
                </div>

            </div>


            <div class="mt-3 space-y-1">

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                            this.closest('form').submit();">
                        Keluar
                    </x-responsive-nav-link>

                </form>

            </div>

        </div>

    </div>

</nav>