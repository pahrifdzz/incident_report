<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan - Incident Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header - Monochrome Design -->
        <nav class="bg-white border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-semibold text-gray-900">Detail Laporan Kejadian</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('profile.edit') }}"
                            class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="bg-gray-600 hover:bg-gray-500 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <!-- Report Details Card -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Laporan</h2>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Reporter Info -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Nama Pelapor</label>
                                <p class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    {{ $report->nama_pelapor }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Nomor WhatsApp</label>
                                <p class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    {{ $report->nomor_whatsapp }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Departemen</label>
                                <p class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    {{ $report->departemen }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">NIK</label>
                                <p class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $report->nik }}</p>
                            </div>
                        </div>

                        <!-- Report Details -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Status Saat Ini</label>
                                <span
                                    class="inline-block px-3 py-1 text-xs font-medium rounded-full
                                    @if ($report->status == 'baru') bg-gray-100 text-gray-800
                                    @elseif($report->status == 'proses') bg-gray-200 text-gray-800
                                    @elseif($report->status == 'selesai') bg-gray-800 text-white
                                    @else bg-gray-100 text-gray-600 @endif">
                                    {{ ucfirst($report->status ?? 'Belum ada status') }}
                                </span>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Laporan</label>
                                <p class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    {{ $report->created_at ? \Carbon\Carbon::parse($report->created_at)->translatedFormat('d M Y, H:i') : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-600 mb-2">Keterangan Kejadian</label>
                        <div class="bg-gray-50 px-4 py-3 rounded-md">
                            <p class="text-sm text-gray-900 leading-relaxed">{{ $report->keterangan }}</p>
                        </div>
                    </div>

                    <!-- Photo if exists -->
                    @if ($report->foto)
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-600 mb-2">Foto Pendukung</label>
                            <div class="bg-gray-50 p-4 rounded-md">
                                <img src="{{ asset('storage/' . $report->foto) }}" alt="Foto kejadian"
                                    class="max-w-full h-auto rounded-lg shadow-sm" style="max-width: 300px;">
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Status Update Card -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mt-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Update Status</h3>
                </div>

                <div class="p-6">
                    <form action="{{ route('admin.reports.status', $report->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Ubah Status</label>
                            <select name="status"
                                class="w-full md:w-64 border border-gray-300 rounded-md px-3 py-2 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                <option value="baru" {{ $report->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                <option value="proses" {{ $report->status == 'proses' ? 'selected' : '' }}>Proses
                                </option>
                                <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>Selesai
                                </option>
                            </select>
                        </div>

                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                            <button type="submit"
                                class="bg-gray-800 hover:bg-gray-700 text-white px-6 py-2 rounded-md font-medium transition-colors">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.dashboard') }}"
                                class="bg-gray-600 hover:bg-gray-500 text-white px-6 py-2 rounded-md font-medium transition-colors text-center">
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
