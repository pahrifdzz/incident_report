<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Incident Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header - Monochrome Design -->
        <nav class="bg-white border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-semibold text-gray-900">Admin Dashboard</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.register.form') }}"
                            class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            Register Admin
                        </a>
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
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <!-- Statistics Cards - Monochrome Design -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Reports Card -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gray-800 rounded-lg flex items-center justify-center">
                                <span class="text-white text-lg font-bold">T</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Laporan</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $reports->total() ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- New Reports Card -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gray-600 rounded-lg flex items-center justify-center">
                                <span class="text-white text-lg font-bold">N</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Laporan Baru</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $reports->where('status', 'baru')->count() ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Processing Reports Card -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gray-700 rounded-lg flex items-center justify-center">
                                <span class="text-white text-lg font-bold">P</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Sedang Diproses</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $reports->where('status', 'proses')->count() ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Completed Reports Card -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gray-900 rounded-lg flex items-center justify-center">
                                <span class="text-white text-lg font-bold">S</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Selesai</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $reports->where('status', 'selesai')->count() ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reports Table - Monochrome Design -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Laporan</h3>
                        <a href="{{ route('admin.export') }}"
                            class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors flex items-center space-x-2">
                            <span>📊</span>
                            <span>Export Excel</span>
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    @if ($reports->isEmpty())
                        <div class="text-center py-12">
                            <div
                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-gray-400 text-2xl">📄</span>
                            </div>
                            <p class="text-lg text-gray-600 mb-4">Belum ada laporan yang masuk</p>
                            <a href="{{ route('report.create') }}"
                                class="inline-block bg-gray-800 hover:bg-gray-700 text-white font-medium py-2 px-6 rounded-md transition-colors">
                                Buat Laporan Pertama
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama Pelapor</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Departemen</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status Kejadian</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($reports as $index => $report)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $report->nama_pelapor }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $report->departemen }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-3 py-1 text-xs font-medium rounded-full
                                                    @if ($report->status_kejadian == 'hampir_celaka') bg-yellow-100 text-yellow-800
                                                    @elseif($report->status_kejadian == 'kecelakaan') bg-red-100 text-red-800
                                                    @else bg-gray-100 text-gray-600 @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $report->status_kejadian ?? 'Belum ada status')) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-3 py-1 text-xs font-medium rounded-full
                                                    @if ($report->status == 'baru') bg-gray-100 text-gray-800
                                                    @elseif($report->status == 'proses') bg-gray-200 text-gray-800
                                                    @elseif($report->status == 'selesai') bg-gray-800 text-white
                                                    @else bg-gray-100 text-gray-600 @endif">
                                                    {{ ucfirst($report->status ?? 'Belum ada status') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                {{ $report->created_at ? \Carbon\Carbon::parse($report->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d M Y, H:i:s') . ' WIB' : '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                <a href="{{ route('admin.reports.show', $report) }}"
                                                    class="bg-gray-800 hover:bg-gray-700 text-white text-xs font-medium py-1 px-3 rounded-md transition-colors">
                                                    Lihat
                                                </a>
                                                <form method="POST" action="{{ route('admin.reports.destroy', $report) }}"
                                                    class="inline-block"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini? Semua data dan gambar terkait akan dihapus permanen.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-600 hover:bg-red-700 text-white text-xs font-medium py-1 px-3 rounded-md transition-colors">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination - Monochrome Design -->
                        <div class="mt-6 flex justify-center">
                            <div class="bg-white border border-gray-200 rounded-lg p-4">
                                {{ $reports->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
