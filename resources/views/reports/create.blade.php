<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pelaporan Kejadian - Incident Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header - Monochrome Design -->
        <nav class="bg-white border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-semibold text-gray-900">Form Pelaporan Kejadian</h1>
                    </div>
                    {{-- <div class="flex items-center space-x-4">
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
                    </div> --}}
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <!-- Form Card -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Form Pelaporan Kejadian Tidak Terduga</h2>
                    <p class="text-sm text-gray-600 mt-1">Silakan isi form di bawah ini dengan informasi yang akurat</p>
                </div>

                <div class="p-6">
                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-gray-100 border border-gray-200 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <span class="text-gray-500">✓</span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-800">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <!-- Personal Information Section -->
                        <div class="space-y-4">
                            <h3 class="text-md font-medium text-gray-900 border-b border-gray-200 pb-2">Informasi
                                Pelapor</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Nama Pelapor *</label>
                                    <input type="text" name="nama_pelapor"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500"
                                        required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Nomor WhatsApp *</label>
                                    <input type="text" name="nomor_whatsapp"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500"
                                        required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Departemen *</label>
                                    <input type="text" name="departemen"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500"
                                        required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">NIK *</label>
                                    <input type="text" name="nik"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500"
                                        required>
                                </div>
                            </div>
                        </div>

                        <!-- Incident Details Section -->
                        <div class="space-y-4">
                            <h3 class="text-md font-medium text-gray-900 border-b border-gray-200 pb-2">Detail Kejadian
                            </h3>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Keterangan Kejadian
                                    *</label>
                                <textarea name="keterangan" rows="4"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500"
                                    placeholder="Jelaskan kejadian yang terjadi secara detail..." required></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Foto Pendukung
                                    (Opsional)</label>
                                <input type="file" name="foto" accept="image/*"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500">
                                <p class="text-xs text-gray-500 mt-1">Format yang didukung: JPG, PNG, GIF. Maksimal 5MB
                                </p>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4 border-t border-gray-200">
                            <button type="submit"
                                class="w-full bg-gray-800 hover:bg-gray-700 text-white font-medium py-3 px-6 rounded-md transition-colors">
                                Kirim Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
