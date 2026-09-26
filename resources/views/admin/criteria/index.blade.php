<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Kriteria Penilaian
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Kelola kriteria dan bobot penilaian Pegawai Teladan.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Informasi --}}
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mb-6">

                <div class="flex items-start gap-3">

                    <div class="text-blue-600 text-lg">
                        ℹ
                    </div>

                    <div>
                        <h3 class="font-semibold text-blue-800">
                            Bobot Penilaian
                        </h3>

                        <p class="text-sm text-blue-700 mt-1">
                            Total seluruh bobot kriteria harus berjumlah
                            <strong>100%</strong>.
                        </p>
                    </div>

                </div>

            </div>


            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl p-4 mb-6 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Pesan error total bobot / validasi --}}
            @error('weights')
                <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6 text-sm">
                    {{ $message }}
                </div>
            @enderror


            {{-- Form + Tabel --}}
            <form method="POST" action="{{ route('admin.criteria.update') }}">
                @csrf
                @method('PUT')

                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-gray-800">
                                Daftar Kriteria
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Kriteria yang digunakan dalam proses penilaian.
                            </p>
                        </div>

                        <button type="submit"
                            class="px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700">
                            Simpan Perubahan
                        </button>
                    </div>


                    <div class="overflow-x-auto">

                        <table class="w-full text-sm text-left">

                            <thead class="bg-gray-50 border-b border-gray-200">

                                <tr>

                                    <th class="px-6 py-4 font-semibold text-gray-600">
                                        #
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-gray-600">
                                        Kriteria
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-gray-600">
                                        Bobot
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-gray-600">
                                        Jumlah Pertanyaan
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-gray-600">
                                        Keterangan
                                    </th>

                                    <th class="px-6 py-4 font-semibold text-gray-600 text-right">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-100">

                                @forelse ($criteria as $criterion)

                                    <tr class="hover:bg-gray-50">

                                        <td class="px-6 py-4 text-gray-500">
                                            {{ $loop->iteration }}
                                        </td>


                                        <td class="px-6 py-4">

                                            <p class="font-medium text-gray-800">
                                                {{ $criterion->name }}
                                            </p>

                                        </td>


                                        <td class="px-6 py-4">

                                            <div class="flex items-center gap-1">

                                                <input type="number" step="0.01" min="0" max="100"
                                                    name="weights[{{ $criterion->id }}]"
                                                    value="{{ old('weights.' . $criterion->id, $criterion->weight) }}"
                                                    class="weight-input w-20 rounded-lg border-gray-300 text-sm font-semibold focus:ring-blue-500 focus:border-blue-500">

                                                <span class="text-gray-500">%</span>

                                            </div>

                                            @error('weights.' . $criterion->id)
                                                <p class="text-xs text-red-600 mt-1">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </td>


                                        <td class="px-6 py-4 text-gray-600">
                                            {{ $criterion->questions_count }}
                                            pertanyaan
                                        </td>


                                        <td class="px-6 py-4">

                                            @if ($criterion->name === 'Kehadiran')

                                                <span class="text-xs text-gray-500">
                                                    Diinput oleh admin
                                                </span>

                                            @else

                                                <span class="text-xs text-gray-500">
                                                    Dinilai melalui pertanyaan
                                                </span>

                                            @endif

                                        </td>


                                        <td class="px-6 py-4 text-right">

                                            <a href="{{ route('admin.questions.index', $criterion) }}"
                                                class="inline-flex items-center px-3 py-2 rounded-lg bg-gray-100 text-gray-700 text-xs font-semibold hover:bg-gray-200">
                                                Kelola Pertanyaan
                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                            Belum ada kriteria penilaian.

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>


                            <tfoot class="bg-gray-50 border-t border-gray-200">

                                <tr>

                                    <td colspan="2" class="px-6 py-4 text-right font-semibold text-gray-700">
                                        Total Bobot
                                    </td>

                                    <td class="px-6 py-4">

                                        <span id="total-weight-badge"
                                            class="inline-flex px-3 py-1 rounded-full text-sm font-bold">
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
                    'bg-green-100',
                    'text-green-700',
                    'bg-red-100',
                    'text-red-700',
                    'bg-yellow-100',
                    'text-yellow-700'
                );

                if (total === 100) {
                    badge.classList.add(
                        'bg-green-100',
                        'text-green-700'
                    );
                } else if (total > 100) {
                    badge.classList.add(
                        'bg-red-100',
                        'text-red-700'
                    );
                } else {
                    badge.classList.add(
                        'bg-yellow-100',
                        'text-yellow-700'
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