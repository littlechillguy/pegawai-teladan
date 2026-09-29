<nav x-data="{ open: false }" class="relative">

    {{-- MOBILE HEADER --}}
    <div class="lg:hidden fixed top-0 inset-x-0 z-50 h-16 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-sm">
        <div class="h-full px-4 flex items-center justify-between">

            <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-lg bg-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                    </svg>
                </div>

                <div class="leading-tight">
                    <p class="text-sm font-extrabold text-slate-800">
                        Ruang Keteladanan
                    </p>
                    <p class="text-[9px] font-bold tracking-widest text-emerald-600">
                        PPSDM
                    </p>
                </div>
            </a>

            <button
                type="button"
                @click="open = !open"
                class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-500 hover:bg-emerald-50 hover:text-emerald-700 transition"
            >
                <svg x-show="!open" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                <svg x-show="open" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>
    </div>


    {{-- SIDEBAR --}}
    <aside
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 shadow-sm transform transition-transform duration-300 ease-in-out lg:translate-x-0"
        :class="open ? 'translate-x-0' : '-translate-x-full'"
    >

        <div class="flex flex-col h-full">

            {{-- BRAND --}}
            <div class="h-20 px-5 flex items-center border-b border-slate-100">
                <a
                    href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                    class="flex items-center gap-3 group"
                >
                    <div class="w-10 h-10 rounded-xl bg-emerald-600 flex items-center justify-center shadow-sm group-hover:bg-emerald-700 transition">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                        </svg>
                    </div>

                    <div class="leading-tight">
                        <p class="text-sm font-extrabold text-slate-800 group-hover:text-emerald-700 transition">
                            Ruang Keteladanan
                        </p>
                        <p class="mt-1 text-[10px] font-bold tracking-widest text-emerald-600">
                            PPSDM
                        </p>
                    </div>
                </a>
            </div>


            {{-- MENU --}}
            <div class="flex-1 overflow-y-auto px-3 py-5">

                @if(auth()->user()->role === 'admin')

                    {{-- UTAMA --}}
                    <div class="mb-6">
                        <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                            Utama
                        </p>

                        <a
                            href="{{ route('admin.dashboard') }}"
                            @click="open = false"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}"
                        >
                            <span class="w-9 h-9 shrink-0 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10v10h14V10"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 20v-6h6v6"/>
                                </svg>
                            </span>
                            Dashboard
                        </a>
                    </div>


                    {{-- DATA --}}
                    <div class="mb-6">
                        <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                            Data
                        </p>

                        <a
                            href="{{ route('admin.employees.index') }}"
                            @click="open = false"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.employees.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}"
                        >
                            <span class="w-9 h-9 shrink-0 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.employees.*') ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M9 11a4 4 0 100-8 4 4 0 000 8zm6-4a3 3 0 100-6 3 3 0 000 6z"/>
                                </svg>
                            </span>
                            Pegawai
                        </a>

                        <a
                            href="{{ route('admin.periods.index') }}"
                            @click="open = false"
                            class="mt-1 flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.periods.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}"
                        >
                            <span class="w-9 h-9 shrink-0 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.periods.*') ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 2v4m8-4v4M3 10h18"/>
                                    <rect x="3" y="4" width="18" height="17" rx="2"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 14h2m2 0h2m2 0h2M8 18h2m2 0h2"/>
                                </svg>
                            </span>
                            Periode
                        </a>

                        <a
                            href="{{ route('admin.candidates.index') }}"
                            @click="open = false"
                            class="mt-1 flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.candidates.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}"
                        >
                            <span class="w-9 h-9 shrink-0 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.candidates.*') ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l2.1 4.26 4.7.68-3.4 3.31.8 4.68L12 13.7l-4.2 2.23.8-4.68-3.4-3.31 4.7-.68L12 3z"/>
                                </svg>
                            </span>
                            Kandidat
                        </a>
                    </div>


                    {{-- PENILAIAN --}}
                    <div class="mb-6">
                        <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                            Penilaian
                        </p>

                        <a
                            href="{{ route('admin.assessment-results.index') }}"
                            @click="open = false"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.assessment-results.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}"
                        >
                            <span class="w-9 h-9 shrink-0 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.assessment-results.*') ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5m0 14h16"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 16v-4m4 4V8m4 8v-7m4 7V5"/>
                                </svg>
                            </span>
                            Hasil Penilaian
                        </a>

                        <a
                            href="{{ route('admin.criteria.index') }}"
                            @click="open = false"
                            class="mt-1 flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.criteria.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}"
                        >
                            <span class="w-9 h-9 shrink-0 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.criteria.*') ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6M9 9h6M9 13h4"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                                </svg>
                            </span>
                            Kriteria
                        </a>
                    </div>


                    {{-- REKAM JEJAK --}}
                    <div>
                        <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                            Rekam Jejak
                        </p>

                        <a
                            href="{{ route('hall-of-fame.index') }}"
                            @click="open = false"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold transition {{ request()->routeIs('hall-of-fame.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}"
                        >
                            <span class="w-9 h-9 shrink-0 rounded-lg flex items-center justify-center {{ request()->routeIs('hall-of-fame.*') ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l2.1 4.26 4.7.68-3.4 3.31.8 4.68L12 13.7l-4.2 2.23.8-4.68-3.4-3.31 4.7-.68L12 3z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 19h8M9 22h6"/>
                                </svg>
                            </span>
                            Hall of Fame
                        </a>
                    </div>


                @else

                    {{-- EMPLOYEE --}}
                    <div>
                        <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                            Menu
                        </p>

                        <a
                            href="{{ route('dashboard') }}"
                            @click="open = false"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold transition {{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}"
                        >
                            <span class="w-9 h-9 shrink-0 rounded-lg flex items-center justify-center {{ request()->routeIs('dashboard') ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10v10h14V10"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 20v-6h6v6"/>
                                </svg>
                            </span>
                            Dashboard
                        </a>

                        <a
                            href="{{ route('hall-of-fame.index') }}"
                            @click="open = false"
                            class="mt-1 flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold transition {{ request()->routeIs('hall-of-fame.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}"
                        >
                            <span class="w-9 h-9 shrink-0 rounded-lg flex items-center justify-center {{ request()->routeIs('hall-of-fame.*') ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l2.1 4.26 4.7.68-3.4 3.31.8 4.68L12 13.7l-4.2 2.23.8-4.68-3.4-3.31 4.7-.68L12 3z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 19h8M9 22h6"/>
                                </svg>
                            </span>
                            Hall of Fame
                        </a>
                    </div>

                @endif

            </div>


            {{-- USER AREA --}}
            <div class="border-t border-slate-100 p-3">

                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <div class="w-10 h-10 shrink-0 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-sm">
                        {{ strtoupper(substr(Auth::user()->employee->name, 0, 1)) }}
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-bold text-slate-800 truncate">
                            {{ Auth::user()->employee->name }}
                        </p>

                        <p class="text-[10px] text-slate-400 font-mono truncate">
                            {{ Auth::user()->employee->nip }}
                        </p>
                    </div>
                </div>

                <a
                    href="{{ route('password.edit') }}"
                    @click="open = false"
                    class="mt-1 flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold text-slate-500 hover:bg-emerald-50 hover:text-emerald-700 transition"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <rect x="4" y="10" width="16" height="11" rx="2"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10V7a4 4 0 018 0v3"/>
                    </svg>
                    Ubah Password
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="w-full mt-1 flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold text-slate-500 hover:bg-red-50 hover:text-red-600 transition"
                    >
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3m0 0l4-4m-4 4l4 4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5V4a2 2 0 012-2h7a2 2 0 012 2v16a2 2 0 01-2 2h-7a2 2 0 01-2-2v-1"/>
                        </svg>
                        Keluar
                    </button>
                </form>

            </div>

        </div>
    </aside>


    {{-- MOBILE OVERLAY --}}
    <div
        x-show="open"
        x-cloak
        @click="open = false"
        class="fixed inset-0 z-40 bg-slate-900/40 backdrop-blur-sm lg:hidden"
    ></div>


    {{-- DESKTOP SIDEBAR SPACE --}}
    <div class="hidden lg:block w-64"></div>

</nav>