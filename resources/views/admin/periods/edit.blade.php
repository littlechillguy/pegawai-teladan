<x-app-layout>

    <x-slot name="header">
        <div class="lg:ml-72">
            <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                Edit Periode
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Perbarui informasi periode pemilihan pegawai teladan.
            </p>
        </div>
    </x-slot>


    <div class="lg:ml-72 py-8 bg-slate-50/50 min-h-[calc(100vh-4rem)]">

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">

                {{-- ========================================================= --}}
                {{-- HEADER CARD --}}
                {{-- ========================================================= --}}
                <div class="px-6 py-5 border-b border-slate-100">

                    <h3 class="font-bold text-slate-800">
                        Informasi Periode
                    </h3>

                    <p class="text-xs text-slate-500 mt-1">
                        Ubah nama atau batas waktu periode.
                    </p>

                </div>


                {{-- ========================================================= --}}
                {{-- FORM --}}
                {{-- ========================================================= --}}
                <form
                    action="{{ route('admin.periods.update', $period) }}"
                    method="POST"
                    class="p-6 sm:p-8 space-y-6"
                >

                    @csrf
                    @method('PUT')


                    {{-- ===================================================== --}}
                    {{-- NAMA PERIODE --}}
                    {{-- ===================================================== --}}
                    <div>

                        <label
                            for="name"
                            class="block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Nama Periode
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $period->name) }}"
                            class="block w-full rounded-xl border-slate-200
                                   focus:border-teal-500
                                   focus:ring-teal-500/20
                                   text-sm text-slate-700
                                   shadow-sm"
                            required
                        >

                        @error('name')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- ===================================================== --}}
                    {{-- TANGGAL --}}
                    {{-- ===================================================== --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        {{-- TANGGAL MULAI --}}
                        <div>

                            <label
                                for="start_date"
                                class="block text-sm font-semibold text-slate-700 mb-2"
                            >
                                Tanggal Mulai
                            </label>

                            <input
                                type="date"
                                name="start_date"
                                id="start_date"
                                value="{{ old('start_date', $period->start_date->format('Y-m-d')) }}"
                                class="block w-full rounded-xl border-slate-200
                                       focus:border-teal-500
                                       focus:ring-teal-500/20
                                       text-sm text-slate-700
                                       shadow-sm"
                                required
                            >

                            @error('start_date')
                                <p class="mt-2 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                            <p class="mt-2 text-xs text-slate-400">
                                Tanggal mulai dibukanya pemilihan.
                            </p>

                        </div>


                        {{-- TANGGAL SELESAI --}}
                        <div>

                            <label
                                for="end_date"
                                class="block text-sm font-semibold text-slate-700 mb-2"
                            >
                                Tanggal Selesai
                            </label>

                            <input
                                type="date"
                                name="end_date"
                                id="end_date"
                                value="{{ old('end_date', $period->end_date->format('Y-m-d')) }}"
                                class="block w-full rounded-xl border-slate-200
                                       focus:border-teal-500
                                       focus:ring-teal-500/20
                                       text-sm text-slate-700
                                       shadow-sm"
                                required
                            >

                            @error('end_date')
                                <p class="mt-2 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                            <p class="mt-2 text-xs text-slate-400">
                                Batas terakhir proses penilaian.
                            </p>

                        </div>

                    </div>


                    {{-- ===================================================== --}}
                    {{-- INFORMASI STATUS --}}
                    {{-- ===================================================== --}}
                    <div class="rounded-2xl bg-slate-50 border border-slate-200 px-4 py-4">

                        <div class="flex items-start gap-3">

                            <div class="flex-shrink-0 mt-0.5 text-slate-400">

                                <svg
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"
                                    />
                                </svg>

                            </div>

                            <div>

                                <p class="text-sm font-semibold text-slate-700">
                                    Status periode tidak diubah melalui form ini
                                </p>

                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                    Status periode dikelola melalui tombol
                                    <strong class="text-slate-600">Aktifkan</strong>
                                    dan
                                    <strong class="text-slate-600">Selesaikan</strong>
                                    pada halaman Manajemen Periode.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- ===================================================== --}}
                    {{-- BUTTONS --}}
                    {{-- ===================================================== --}}
                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">

                        <a
                            href="{{ route('admin.periods.index') }}"
                            class="inline-flex items-center justify-center
                                   px-4 py-2.5
                                   rounded-xl
                                   bg-slate-100
                                   text-slate-600
                                   text-sm
                                   font-semibold
                                   hover:bg-slate-200
                                   transition-all
                                   active:scale-[0.98]"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2
                                   px-5 py-2.5
                                   rounded-xl
                                   bg-slate-900
                                   text-white
                                   text-sm
                                   font-semibold
                                   shadow-sm
                                   hover:bg-slate-800
                                   transition-all
                                   active:scale-[0.98]"
                        >

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>