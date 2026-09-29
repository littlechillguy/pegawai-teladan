<x-app-layout>
    <x-slot name="header">
        <div class="lg:ml-72">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Kriteria Penilaian</h2>
                    <p class="text-sm text-slate-500 mt-0.5">Kelola kriteria dan bobot penilaian Pegawai Teladan.</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="lg:ml-72 py-8 bg-slate-50/60 min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Informasi Bobot --}}
            <div class="mb-6 rounded-2xl border border-teal-100 bg-gradient-to-r from-teal-50 to-white shadow-sm overflow-hidden">
                <div class="p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="w-11 h-11 rounded-xl bg-teal-600 text-white flex items-center justify-center shrink-0 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-sm font-bold text-slate-800">Aturan Bobot Penilaian</h3>
                        <p class="text-sm text-slate-500 mt-1">
                            Total bobot seluruh kriteria harus tepat
                            <span class="font-bold text-teal-700">100%</span>
                            agar sistem dapat menghitung nilai akhir dengan benar.
                        </p>
                    </div>
                    <div class="hidden sm:flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-teal-100 shadow-sm shrink-0">
                        <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                        <span class="text-xs font-bold text-slate-600">Total harus 100%</span>
                    </div>
                </div>
            </div>

            {{-- Flash Success --}}
            @if (session('success'))
                <div class="mb-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 shadow-sm">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-emerald-800">Berhasil</p>
                        <p class="text-sm text-emerald-700 mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- Error Bobot --}}
            @error('weights')
                <div class="mb-6 flex items-start gap-3 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 shadow-sm">
                    <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 01-18 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-rose-800">Bobot Tidak Valid</p>
                        <p class="text-sm text-rose-700 mt-0.5">{{ $message }}</p>
                    </div>
                </div>
            @enderror

            {{-- Form --}}
            <form method="POST" action="{{ route('admin.criteria.update') }}">
                @csrf
                @method('PUT')

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                    {{-- Header Card --}}
                    <div class="px-5 sm:px-6 py-5 border-b border-slate-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="text-base font-bold text-slate-800">Daftar Kriteria</h3>
                                    <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-500 text-[11px] font-bold">
                                        {{ $criteria->count() }} Kriteria
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 mt-1">
                                    Atur bobot dan kelola pertanyaan untuk setiap kriteria.
                                </p>
                            </div>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-teal-600 text-white text-sm font-semibold hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 shadow-sm transition active:scale-[0.98]"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[900px] text-sm">
                            <thead>
                                <tr class="bg-slate-50/80 border-b border-slate-200">
                                    <th class="w-16 px-6 py-4 text-center text-[11px] font-bold text-slate-400 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-4 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Kriteria</th>
                                    <th class="px-6 py-4 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Bobot</th>
                                    <th class="px-6 py-4 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Pertanyaan</th>
                                    <th class="px-6 py-4 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Metode Penilaian</th>
                                    <th class="px-6 py-4 text-right text-[11px] font-bold text-slate-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                                @forelse ($criteria as $criterion)
                                    <tr class="group hover:bg-slate-50/70 transition-colors">

                                        {{-- Nomor --}}
                                        <td class="px-6 py-5 text-center">
                                            <span class="inline-flex w-7 h-7 items-center justify-center rounded-lg bg-slate-100 text-xs font-bold text-slate-500 group-hover:bg-teal-50 group-hover:text-teal-600 transition">
                                                {{ $loop->iteration }}
                                            </span>
                                        </td>

                                        {{-- Kriteria --}}
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
                                                    @if ($criterion->name === 'Kehadiran')
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"/>
                                                        </svg>
                                                    @else
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="font-bold text-slate-800">{{ $criterion->name }}</p>
                                                    @if ($criterion->name === 'Kehadiran')
                                                        <p class="text-xs text-slate-400 mt-0.5">Data administratif</p>
                                                    @else
                                                        <p class="text-xs text-slate-400 mt-0.5">Aspek penilaian</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Bobot --}}
                                        <td class="px-6 py-5">
                                            <div class="relative w-28">
                                                <input
                                                    type="number"
                                                    step="0.01"
                                                    min="0"
                                                    max="100"
                                                    name="weights[{{ $criterion->id }}]"
                                                    value="{{ old('weights.' . $criterion->id, $criterion->weight) }}"
                                                    class="weight-input w-full h-10 rounded-xl border-slate-300 bg-white pl-3 pr-8 text-sm font-bold text-slate-800 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition"
                                                >
                                                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400 pointer-events-none">%</span>
                                            </div>

                                            @error('weights.' . $criterion->id)
                                                <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                            @enderror
                                        </td>

                                        {{-- Jumlah Pertanyaan --}}
                                        <td class="px-6 py-5">
                                            <div class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-slate-50 border border-slate-200">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                                                </svg>
                                                <span class="text-xs font-semibold text-slate-600">
                                                    {{ $criterion->questions_count }} Pertanyaan
                                                </span>
                                            </div>
                                        </td>

                                        {{-- Keterangan --}}
                                        <td class="px-6 py-5">
                                            @if ($criterion->name === 'Kehadiran')
                                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-50 border border-amber-200 text-amber-700 text-xs font-semibold whitespace-nowrap">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                    Diinput Admin
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-teal-50 border border-teal-200 text-teal-700 text-xs font-semibold whitespace-nowrap">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                                    Melalui Pertanyaan
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Aksi --}}
                                        <td class="px-6 py-5 text-right">
                                            <a
                                                href="{{ route('admin.questions.index', $criterion) }}"
                                                class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl border border-slate-200 bg-white text-slate-600 text-xs font-bold shadow-sm hover:border-teal-200 hover:bg-teal-50 hover:text-teal-700 transition"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M10.5 6.75a1.5 1.5 0 013 0v.25a1.5 1.5 0 001 1.42l.2.08a1.5 1.5 0 001.73-.34l.18-.18a1.5 1.5 0 112.12 2.12l-.18.18a1.5 1.5 0 00-.34 1.73l.08.2a1.5 1.5 0 001.42 1h.25a1.5 1.5 0 010 3h-.25a1.5 1.5 0 00-1.42 1l-.08.2a1.5 1.5 0 00.34 1.73l.18.18a1.5 1.5 0 11-2.12 2.12l-.18-.18a1.5 1.5 0 00-1.73-.34l-.2.08a1.5 1.5 0 00-1 1.42v.25a1.5 1.5 0 01-3 0v-.25a1.5 1.5 0 00-1-1.42l-.2-.08a1.5 1.5 0 00-1.73.34l-.18.18a1.5 1.5 0 11-2.12-2.12l.18-.18a1.5 1.5 0 00.34-1.73l-.08-.2a1.5 1.5 0 00-1.42-1H3.5a1.5 1.5 0 010-3h.25a1.5 1.5 0 001.42-1l.08-.2a1.5 1.5 0 00-.34-1.73l-.18-.18a1.5 1.5 0 112.12-2.12l.18.18a1.5 1.5 0 001.73.34l.2-.08a1.5 1.5 0 001-1.42v-.25z"/>
                                                    <circle cx="12" cy="13.5" r="2.5"/>
                                                </svg>
                                                Kelola Pertanyaan
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-16 text-center">
                                            <div class="w-14 h-14 mx-auto rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
                                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                                </svg>
                                            </div>
                                            <h4 class="text-sm font-bold text-slate-700 mt-4">Belum Ada Kriteria</h4>
                                            <p class="text-xs text-slate-400 mt-1">Belum tersedia kriteria untuk proses penilaian.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                            {{-- Total --}}
                            <tfoot>
                                <tr class="border-t border-slate-200 bg-slate-50/80">
                                    <td colspan="2" class="px-6 py-5">
                                        <div class="flex items-center justify-end gap-3">
                                            <span class="text-sm font-bold text-slate-700">Total Bobot</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span
                                            id="total-weight-badge"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold border transition-all"
                                        >
                                            <span id="total-weight-value">0</span>%
                                        </span>
                                    </td>
                                    <td colspan="3" class="px-6 py-5">
                                        <span class="text-xs text-slate-400">
                                            Bobot harus tepat 100% sebelum disimpan.
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    {{-- Footer --}}
                    <div class="px-5 sm:px-6 py-4 border-t border-slate-200 bg-white flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="flex items-center gap-2 text-xs text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 9v4m0 4h.01M12 3a9 9 0 100 18 9 9 0 000-18z"/>
                            </svg>
                            Perubahan bobot akan memengaruhi perhitungan nilai akhir.
                        </div>
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-teal-600 text-white text-sm font-semibold hover:bg-teal-700 transition shadow-sm"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function updateTotalWeight() {
                const inputs = document.querySelectorAll('.weight-input');
                let total = 0;

                inputs.forEach(input => {
                    total += parseFloat(input.value) || 0;
                });

                total = Math.round(total * 100) / 100;

                const badge = document.getElementById('total-weight-badge');
                const valueEl = document.getElementById('total-weight-value');

                valueEl.textContent = total;

                badge.className = 'inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold border transition-all';

                if (total === 100) {
                    badge.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-200');
                } else if (total > 100) {
                    badge.classList.add('bg-rose-50', 'text-rose-700', 'border-rose-200');
                } else {
                    badge.classList.add('bg-amber-50', 'text-amber-700', 'border-amber-200');
                }
            }

            document.querySelectorAll('.weight-input').forEach(input => {
                input.addEventListener('input', updateTotalWeight);
            });

            document.querySelector('form').addEventListener('submit', function(event) {
                const inputs = document.querySelectorAll('.weight-input');
                let total = 0;

                inputs.forEach(input => {
                    total += parseFloat(input.value) || 0;
                });

                total = Math.round(total * 100) / 100;

                if (total > 100) {
                    event.preventDefault();
                    alert(
                        'Bobot penilaian tidak dapat disimpan.\n\n' +
                        'Total bobot saat ini: ' + total + '%\n' +
                        'Total bobot tidak boleh lebih dari 100%.\n\n' +
                        'Silakan kurangi bobot beberapa kriteria terlebih dahulu.'
                    );
                    return;
                }

                if (total < 100) {
                    event.preventDefault();
                    alert(
                        'Bobot penilaian belum lengkap.\n\n' +
                        'Total bobot saat ini: ' + total + '%\n' +
                        'Total bobot harus tepat 100%.\n\n' +
                        'Silakan tambahkan bobot kriteria terlebih dahulu.'
                    );
                    return;
                }

                if (total === 100) {
                    const confirmed = confirm(
                        'Total bobot sudah tepat 100%.\n\n' +
                        'Yakin ingin menyimpan perubahan bobot?'
                    );

                    if (!confirmed) {
                        event.preventDefault();
                    }
                }
            });

            document.addEventListener('DOMContentLoaded', updateTotalWeight);
        </script>
    @endpush
</x-app-layout>