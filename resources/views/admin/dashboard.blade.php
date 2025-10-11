<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-6 border-b pb-2">📋 Daftar Laporan</h3>

                {{-- Debug tampilkan jumlah laporan --}}
                <div class="mb-4 text-sm text-gray-600">
                    Jumlah laporan: {{ $reports->count() }}
                </div>

                @if ($reports->isEmpty())
                    <div class="text-center py-10 text-gray-500">
                        <p class="text-lg">Belum ada laporan yang masuk.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="border px-4 py-2 text-left">No</th>
                                    <th class="border px-4 py-2 text-left">Nama Pelapor</th>
                                    <th class="border px-4 py-2 text-left">Departemen</th>
                                    <th class="border px-4 py-2 text-left">Status</th>
                                    <th class="border px-4 py-2 text-left">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $index => $report)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="border px-4 py-2">{{ $report->nama_pelapor }}</td>
                                        <td class="border px-4 py-2">{{ $report->departemen }}</td>
                                        <td class="border px-4 py-2">
                                            {{ $report->status ?? 'Belum ada status' }}
                                        </td>
                                        <td class="border px-4 py-2">
                                            {{ $report->created_at ? \Carbon\Carbon::parse($report->created_at)->translatedFormat('d M Y, H:i') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
