<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                    Kriteria Penilaian
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Kelola kriteria dan bobot penilaian Pegawai Teladan.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50/50 min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Informasi (Skema Teal) --}}
            <div class="bg-teal-50 border border-teal-200 rounded-2xl p-4 sm:p-5 mb-6 shadow-sm flex items-start gap-3.5 transition-all">
                <div class="p-2 bg-teal-600 text-white rounded-xl shadow-xs flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="pt-0.5">
                    <h3 class="text-sm font-semibold text-teal-950">
                        Bobot Penilaian
                    </h3>
                    <p class="text-sm text-teal-700 mt-0.5">
                        Total seluruh bobot kriteria harus berjumlah <span class="font-bold text-teal-900">100%</span> agar sistem penilaian berjalan seimbang.
                    </p>
                </div>
            </div>

            {{-- Pesan sukses (Emerald/Teal aksen) --}}
            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl p-4 mb-6 text-sm flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Pesan error total bobot / validasi --}}
            @error('weights')
                <div class="bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl p-4 mb-6 text-sm flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ $message }}</span>
                </div>
            @enderror

            {{-- Form + Tabel --}}
            <form method="POST" action="{{ route('admin.criteria.update') }}">
                @csrf
                @method('PUT')

                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white">
                        <div>
                            <h3 class="text-base font-bold text-slate-900">
                                Daftar Kriteria
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Kriteria yang digunakan dalam proses penilaian.
                            </p>
                        </div>

                        {{-- Tombol Utama: Slate Dark Neutral --}}
                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 text-white text-xs font-semibold hover:bg-slate-800 active:bg-slate-950 transition-all shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                <tr>
                                    <th class="px-6 py-3.5 w-12 text-center">#</th>
                                    <th class="px-6 py-3.5">Kriteria</th>
                                    <th class="px-6 py-3.5">Bobot</th>
                                    <th class="px-6 py-3.5">Jumlah Pertanyaan</th>
                                    <th class="px-6 py-3.5">Keterangan</th>
                                    <th class="px-6 py-3.5 text-right">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                                @forelse ($criteria as $criterion)
                                    <tr class="hover:bg-slate-50/60 transition-colors">
                                        <td class="px-6 py-4 text-slate-400 font-medium text-center">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <p class="font-semibold text-slate-800">
                                                {{ $criterion->name }}
                                            </p>
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-1.5">
                                                <div class="relative rounded-lg shadow-xs">
                                                    {{-- Input Focus Ring Teal --}}
                                                    <input type="number" step="0.01" min="0" max="100"
                                                        name="weights[{{ $criterion->id }}]"
                                                        value="{{ old('weights.' . $criterion->id, $criterion->weight) }}"
                                                        class="weight-input w-24 rounded-lg border-slate-300 pr-7 text-sm font-semibold text-slate-900 focus:ring-2 focus:ring-teal-500 focus:border-teal-600 transition-all">
                                                    <div class="absolute inset-y-0 right-0 pr-2.5 flex items-center pointer-events-none">
                                                        <span class="text-xs font-semibold text-slate-400">%</span>
                                                    </div>
                                                </div>
                                            </div>

                                            @error('weights.' . $criterion->id)
                                                <p class="text-xs text-rose-600 mt-1 font-medium">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </td>

                                        <td class="px-6 py-4 text-slate-600">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                                {{ $criterion->questions_count }} Pertanyaan
                                            </span>
                                        </td>

                                        <td class="px-6 py-4">
                                            @if ($criterion->name === 'Kehadiran')
                                                <span class="inline-flex items-center gap-1.5 text-xs text-amber-700 font-medium bg-amber-50 border border-amber-200 px-2.5 py-1 rounded-full">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                    Diinput oleh admin
                                                </span>
                                            @else
                                                {{-- Badge Kehadiran & Status (Skema Teal) --}}
                                                <span class="inline-flex items-center gap-1.5 text-xs text-teal-700 font-medium bg-teal-50/60 border border-teal-200 px-2.5 py-1 rounded-full">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                                    Dinilai melalui pertanyaan
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-right">
                                            {{-- Tombol Edit/Bantuan: Slate / Border Neutral --}}
                                            <a href="{{ route('admin.questions.index', $criterion) }}"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-300 bg-white text-slate-700 text-xs font-semibold hover:bg-slate-50 hover:text-slate-900 transition-all focus:ring-2 focus:ring-teal-500">
                                                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                Kelola Pertanyaan
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                            <div class="flex flex-col items-center justify-center gap-2">
                                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                </svg>
                                                <p class="text-sm font-medium">Belum ada kriteria penilaian.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                            <tfoot class="bg-slate-50 border-t border-slate-200">
                                <tr>
                                    <td colspan="2" class="px-6 py-4 text-right font-bold text-slate-700">
                                        Total Bobot
                                    </td>
                                    <td class="px-6 py-4">
                                        <span id="total-weight-badge"
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold transition-all shadow-xs">
                                            <span id="total-weight-value">0</span>%
                                        </span>
                                    </td>
                                    <td colspan="3"></td>
                                </tr>
                            </tfoot>
                        </table>
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

                badge.classList.remove(
                    'bg-teal-50',
                    'text-teal-700',
                    'border',
                    'border-teal-200',
                    'bg-emerald-100',
                    'text-emerald-700',
                    'border-emerald-200',
                    'bg-rose-100',
                    'text-rose-700',
                    'border-rose-200',
                    'bg-amber-100',
                    'text-amber-700',
                    'border-amber-200'
                );

                if (total === 100) {
                    badge.classList.add(
                        'bg-teal-50',
                        'text-teal-700',
                        'border',
                        'border-teal-200'
                    );
                } else if (total > 100) {
                    badge.classList.add(
                        'bg-rose-100',
                        'text-rose-700',
                        'border',
                        'border-rose-200'
                    );
                } else {
                    badge.classList.add(
                        'bg-amber-100',
                        'text-amber-700',
                        'border',
                        'border-amber-200'
                    );
                }
            }


            // Update total saat bobot diubah
            document.querySelectorAll('.weight-input').forEach(input => {
                input.addEventListener('input', updateTotalWeight);
            });


            // Cek total sebelum form disubmit
            document.querySelector('form').addEventListener('submit', function (event) {

                const inputs = document.querySelectorAll('.weight-input');
                let total = 0;

                inputs.forEach(input => {
                    total += parseFloat(input.value) || 0;
                });

                total = Math.round(total * 100) / 100;


                // Jika lebih dari 100%
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


                // Jika kurang dari 100%
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


                // Jika tepat 100%
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


            // Jalankan saat halaman pertama kali dibuka
            document.addEventListener('DOMContentLoaded', updateTotalWeight);
        </script>
    @endpush

</x-app-layout>