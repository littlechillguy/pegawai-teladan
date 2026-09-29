<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="text-xl font-bold text-slate-800">Edit Kandidat</h2>
            <p class="text-sm text-slate-500 mt-1">Perbarui persentase kehadiran kandidat.</p>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50/50 min-h-[calc(100vh-4rem)]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M10.29 3.86l-8.2 14A2 2 0 003.82 21h16.36a2 2 0 001.73-3.14l-8.2-14a2 2 0 00-3.42 0z"/>
                        </svg>
                        <ul class="text-sm text-red-700 list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                {{-- Data Kandidat --}}
                <div class="px-6 py-5 border-b border-slate-200">
                    <div class="flex items-center gap-4">
                        @if ($candidate->employee->photo)
                            <img src="{{ asset('storage/' . $candidate->employee->photo) }}" alt="{{ $candidate->employee->name }}" class="w-14 h-14 rounded-2xl object-cover border border-slate-200">
                        @else
                            <div class="w-14 h-14 rounded-2xl bg-teal-50 border border-teal-100 flex items-center justify-center">
                                <span class="text-lg font-bold text-teal-600">{{ strtoupper(substr($candidate->employee->name, 0, 1)) }}</span>
                            </div>
                        @endif

                        <div>
                            <h3 class="font-bold text-slate-800">{{ $candidate->employee->name }}</h3>
                            <p class="text-sm text-slate-500 mt-0.5">{{ $candidate->employee->nip }} · {{ $candidate->employee->position ?? '-' }}</p>
                            <p class="text-xs text-slate-400 mt-1">{{ $candidate->period->name }}</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.candidates.update', $candidate) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Kehadiran --}}
                    <div>
                        <label for="attendance_percentage" class="block text-sm font-semibold text-slate-700 mb-2">Persentase Kehadiran</label>

                        <div class="relative">
                            <input
                                type="number"
                                name="attendance_percentage"
                                id="attendance_percentage"
                                value="{{ old('attendance_percentage', $candidate->attendance_percentage) }}"
                                min="0"
                                max="100"
                                step="0.01"
                                required
                                class="w-full pr-12 rounded-xl border-slate-300 bg-white text-slate-800 focus:border-teal-500 focus:ring-teal-500"
                            >
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-sm font-medium text-slate-400">%</span>
                        </div>

                        <p class="mt-2 text-xs text-slate-500">Masukkan nilai antara 0 sampai 100.</p>

                        @error('attendance_percentage')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bobot --}}
                    <div class="rounded-xl bg-slate-50 border border-slate-200 p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-700">Bobot Kehadiran</p>
                                <p class="text-sm text-slate-500 mt-1">Kehadiran memiliki bobot <strong class="text-slate-700">10%</strong> dari nilai akhir.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100">
                        <a
                            href="{{ route('admin.candidates.index') }}"
                            class="px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2.5 rounded-xl bg-teal-600 text-white text-sm font-semibold hover:bg-teal-700 shadow-sm transition active:scale-[0.98]"
                        >
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>