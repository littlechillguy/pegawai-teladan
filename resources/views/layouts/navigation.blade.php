<nav x-data="{ open: false }" class="bg-white/90 backdrop-blur-md border-b border-emerald-100/80 sticky top-0 z-30">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            {{-- =========================
                LOGO / BRAND
            ========================== --}}
            <div class="flex">

                <div class="shrink-0 flex items-center">

                    <a
                        href="{{ auth()->user()->role === 'admin'
                            ? route('admin.dashboard')
                            : route('dashboard') }}"
                        class="flex flex-col leading-tight group"
                    >
                        <span class="text-lg font-extrabold text-slate-800 group-hover:text-emerald-700 transition">
                            Ruang Keteladanan
                        </span>

                        <span class="text-[10px] font-semibold text-emerald-600 tracking-wider">
                            PPSDM
                        </span>
                    </a>

                </div>

                {{-- =========================
                    DESKTOP NAVIGATION
                ========================== --}}
                <div class="hidden sm:flex sm:items-center sm:ms-8">

                    @if(auth()->user()->role === 'admin')

                        <div class="flex items-center gap-1">

                            {{-- Dashboard --}}
                            <x-nav-link
                                :href="route('admin.dashboard')"
                                :active="request()->routeIs('admin.dashboard')"
                            >
                                Dashboard
                            </x-nav-link>

                            {{-- Pegawai --}}
                            <x-nav-link
                                :href="route('admin.employees.index')"
                                :active="request()->routeIs('admin.employees.*')"
                            >
                                Pegawai
                            </x-nav-link>

                            {{-- Periode --}}
                            <x-nav-link
                                :href="route('admin.periods.index')"
                                :active="request()->routeIs('admin.periods.*')"
                            >
                                Periode
                            </x-nav-link>

                            {{-- Kandidat --}}
                            <x-nav-link
                                :href="route('admin.candidates.index')"
                                :active="request()->routeIs('admin.candidates.*')"
                            >
                                Kandidat
                            </x-nav-link>

                            {{-- Hasil Penilaian --}}
                            <x-nav-link
                                :href="route('admin.assessment-results.index')"
                                :active="request()->routeIs('admin.assessment-results.*')"
                            >
                                Hasil Penilaian
                            </x-nav-link>

                            {{-- Kriteria --}}
                            <x-nav-link
                                :href="route('admin.criteria.index')"
                                :active="request()->routeIs('admin.criteria.*')"
                            >
                                Kriteria
                            </x-nav-link>

                            {{-- Hall of Fame --}}
                            <x-nav-link
                                :href="route('admin.hall-of-fame.index')"
                                :active="request()->routeIs('admin.hall-of-fame.*')"
                            >
                                Hall of Fame
                            </x-nav-link>

                        </div>

                    @else

                        {{-- Employee --}}
                        <x-nav-link
                            :href="route('dashboard')"
                            :active="request()->routeIs('dashboard')"
                        >
                            Dashboard
                        </x-nav-link>

                    @endif

                </div>

            </div>


            {{-- =========================
                DESKTOP USER DROPDOWN
            ========================== --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">

                    {{-- Trigger --}}
                    <x-slot name="trigger">

                        <button
                            type="button"
                            class="inline-flex items-center px-3 py-1.5 border border-slate-200/80 text-sm leading-4 font-medium rounded-xl text-slate-700 bg-slate-50/50 hover:bg-emerald-50 hover:border-emerald-200 hover:text-emerald-800 focus:outline-none transition-all duration-200"
                        >

                            <div class="text-right">

                                <div class="font-bold text-xs text-slate-800">
                                    {{ Auth::user()->employee->name }}
                                </div>

                                <div class="text-[10px] text-slate-400 font-mono">
                                    {{ Auth::user()->employee->nip }}
                                </div>

                            </div>

                            <div class="ms-2">

                                <svg
                                    class="fill-current h-4 w-4 text-slate-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>

                            </div>

                        </button>

                    </x-slot>


                    {{-- Dropdown Content --}}
                    <x-slot name="content">

                        {{-- User Information --}}
                        <div class="px-4 py-3 border-b border-gray-100 bg-slate-50/50">

                            <p class="text-sm font-bold text-slate-800">
                                {{ Auth::user()->employee->name }}
                            </p>

                            <p class="text-xs text-emerald-700 font-semibold mt-0.5">
                                {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Pegawai' }}
                            </p>

                            <p class="text-xs text-slate-400 font-mono mt-0.5">
                                NIP: {{ Auth::user()->employee->nip }}
                            </p>

                        </div>


                        {{-- Ubah Password --}}
                        <x-dropdown-link
                            :href="route('password.edit')"
                        >
                            Ubah Password
                        </x-dropdown-link>


                        {{-- Logout --}}
                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-red-600 hover:bg-red-50"
                            >
                                Keluar
                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>


            {{-- =========================
                MOBILE HAMBURGER
            ========================== --}}
            <div class="-me-2 flex items-center sm:hidden">

                <button
                    @click="open = ! open"
                    type="button"
                    class="inline-flex items-center justify-center p-2 rounded-lg text-slate-500 hover:text-emerald-700 hover:bg-emerald-50 focus:outline-none transition"
                >

                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >

                        {{-- Hamburger --}}
                        <path
                            :class="{
                                'hidden': open,
                                'inline-flex': !open
                            }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                        {{-- Close --}}
                        <path
                            :class="{
                                'hidden': !open,
                                'inline-flex': open
                            }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />

                    </svg>

                </button>

            </div>

        </div>

    </div>


    {{-- =========================
        MOBILE NAVIGATION
    ========================== --}}
    <div
        :class="{
            'block': open,
            'hidden': !open
        }"
        class="hidden sm:hidden bg-white border-b border-slate-200"
    >

        {{-- Navigation Menu --}}
        <div class="pt-2 pb-3 space-y-1">

            @if(auth()->user()->role === 'admin')

                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    Dashboard
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.employees.index')" :active="request()->routeIs('admin.employees.*')">
                    Pegawai
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.periods.index')" :active="request()->routeIs('admin.periods.*')">
                    Periode
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.candidates.index')" :active="request()->routeIs('admin.candidates.*')">
                    Kandidat
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.assessment-results.index')" :active="request()->routeIs('admin.assessment-results.*')">
                    Hasil Penilaian
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.criteria.index')" :active="request()->routeIs('admin.criteria.*')">
                    Kriteria
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.hall-of-fame.index')" :active="request()->routeIs('admin.hall-of-fame.*')">
                    Hall of Fame
                </x-responsive-nav-link>

            @else

                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    Dashboard
                </x-responsive-nav-link>

            @endif

        </div>


        {{-- MOBILE USER --}}
        <div class="pt-4 pb-1 border-t border-slate-200 bg-slate-50/50">

            <div class="px-4">
                <div class="font-bold text-base text-slate-800">
                    {{ Auth::user()->employee->name }}
                </div>
                <div class="font-mono text-xs text-slate-500">
                    {{ Auth::user()->employee->nip }}
                </div>
                <div class="text-xs font-semibold text-emerald-700 mt-0.5">
                    {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Pegawai' }}
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('password.edit')" :active="request()->routeIs('password.edit')">
                    Ubah Password
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        Keluar
                    </x-responsive-nav-link>
                </form>
            </div>

        </div>

    </div>

</nav>