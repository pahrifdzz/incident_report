<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan - Incident Report</title>
    <link rel="stylesheet" href="{{ asset('css/style_offline.css') }}">
</head>

<body class="bg-gray-50">
    <div class="min-h-screen">
        <nav class="bg-white border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-semibold text-gray-900">Detail Laporan Kejadian</h1>
                    </div>
                    <div class="flex items-center space-x-4">
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

        <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Laporan</h2>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Nama Pelapor</label>
                                <p class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    {{ $report->nama_pelapor }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Nomor WhatsApp</label>
                                <p class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    {{ $report->nomor_whatsapp }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Departemen</label>
                                <p class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    {{ $report->departemen }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">NIK</label>
                                <p class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $report->nik }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Status Kejadian</label>
                                <span class="inline-block px-3 py-1 text-xs font-medium rounded-full
                                    @if ($report->status_kejadian == 'hampir_celaka') bg-yellow-100 text-yellow-800
                                    @elseif($report->status_kejadian == 'kecelakaan') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-600 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $report->status_kejadian ?? 'Belum ada status')) }}
                                </span>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Status Saat Ini</label>
                                <span class="inline-block px-3 py-1 text-xs font-medium rounded-full
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

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-600 mb-2">Keterangan Kejadian</label>
                        <div class="bg-gray-50 px-4 py-3 rounded-md">
                            <p class="text-sm text-gray-900 leading-relaxed">{{ $report->keterangan }}</p>
                        </div>
                    </div>

                    @if ($report->foto || $report->foto_sebelum || $report->foto_sesudah)
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-600 mb-2">Foto Kejadian</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @if ($report->foto)
                                    <div class="bg-gray-50 p-4 rounded-md">
                                        <h5 class="text-xs font-medium text-gray-700 mb-2">Foto dari Pelapor</h5>
                                        <img src="{{ $report->foto }}" alt="Foto kejadian"
                                            class="max-w-full h-auto rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-pointer"
                                            style="max-width: 200px;" onclick="openImageModal('{{ $report->foto }}')"
                                            loading="lazy">
                                    </div>
                                @endif

                                @if ($report->foto_sebelum)
                                    <div class="bg-gray-50 p-4 rounded-md">
                                        <h5 class="text-xs font-medium text-gray-700 mb-2">Foto Investigasi HS</h5>
                                        <img src="{{ $report->foto_sebelum }}" alt="Foto sebelum kejadian"
                                            class="max-w-full h-auto rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-pointer"
                                            style="max-width: 200px;" onclick="openImageModal('{{ $report->foto_sebelum }}')"
                                            loading="lazy">
                                    </div>
                                @endif

                                @if ($report->foto_sesudah)
                                    <div class="bg-gray-50 p-4 rounded-md">
                                        <h5 class="text-xs font-medium text-gray-700 mb-2">Foto Setelah Penanganan</h5>
                                        <img src="{{ $report->foto_sesudah }}" alt="Foto sesudah kejadian"
                                            class="max-w-full h-auto rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-pointer"
                                            style="max-width: 200px;" onclick="openImageModal('{{ $report->foto_sesudah }}')"
                                            loading="lazy">
                                    </div>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Klik gambar untuk melihat ukuran penuh</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mt-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Update Status</h3>
                </div>

                <div class="p-6">
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-100 border border-green-200 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <span class="text-green-500">✓</span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-800">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($report->foto_sebelum || $report->foto_sesudah)
                        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-md">
                            <h4 class="text-sm font-medium text-blue-800 mb-3">Foto Penanganan yang Telah Diupload:</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if ($report->foto_sebelum)
                                    <div class="bg-white p-3 rounded-md border border-blue-200">
                                        <h5 class="text-xs font-medium text-blue-700 mb-2">Foto Investigasi HS</h5>
                                        <div class="relative">
                                            <img src="{{ $report->foto_sebelum }}" alt="Foto sebelum kejadian"
                                                class="max-w-full h-auto rounded-lg shadow-sm cursor-pointer hover:shadow-md transition-shadow"
                                                style="max-width: 200px;" onclick="openImageModal('{{ $report->foto_sebelum }}')">
                                            <div class="absolute top-2 right-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-full">
                                                Thumbnail
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">Klik untuk memperbesar</p>
                                    </div>
                                @endif

                                @if ($report->foto_sesudah)
                                    <div class="bg-white p-3 rounded-md border border-blue-200">
                                        <h5 class="text-xs font-medium text-blue-700 mb-2">Foto Setelah Penangaan</h5>
                                        <div class="relative">
                                            <img src="{{ $report->foto_sesudah }}" alt="Foto sesudah kejadian"
                                                class="max-w-full h-auto rounded-lg shadow-sm cursor-pointer hover:shadow-md transition-shadow"
                                                style="max-width: 200px;" onclick="openImageModal('{{ $report->foto_sesudah }}')">
                                            <div class="absolute top-2 right-2 bg-green-600 text-white text-xs px-2 py-1 rounded-full">
                                                Thumbnail
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">Klik untuk memperbesar</p>
                                    </div>
                                @endif
                            </div>
                            <p class="text-xs text-blue-600 mt-3 italic">* Thumbnail foto penanganan kejadian sebelum dan sesudah</p>
                        </div>
                    @endif

                    <form action="{{ route('admin.reports.status', $report->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Ubah Status</label>
                            <select name="status"
                                class="w-full md:w-64 border border-gray-300 rounded-md px-3 py-2 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                <option value="baru" {{ $report->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                <option value="proses" {{ $report->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-md font-medium text-gray-900">Upload Foto Penanganan</h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Foto Investigasi HS</label>
                                    <input type="file" name="foto_sebelum" accept="image/*" id="fotoSebelumInput"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500"
                                        onchange="previewImage(this, 'fotoSebelumPreview', 'fotoSebelumImg')">
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF, WEBP. Max 5MB</p>

                                    <div id="fotoSebelumPreview" class="mt-3 hidden">
                                        <label class="block text-sm font-medium text-gray-600 mb-2">Preview:</label>
                                        <div class="bg-gray-50 p-3 rounded-md">
                                            <img id="fotoSebelumImg" src="" alt="Preview sebelum"
                                                class="max-w-full h-auto rounded-lg shadow-sm" style="max-width: 150px;"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <p class="hidden text-red-500 text-xs">Gagal memuat preview gambar</p>
                                            <button type="button" onclick="removeImage('fotoSebelumInput', 'fotoSebelumPreview')"
                                                class="mt-2 text-xs text-red-600 hover:text-red-800">Hapus Preview</button>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Foto Setelah Penanganan</label>
                                    <input type="file" name="foto_sesudah" accept="image/*" id="fotoSesudahInput"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500"
                                        onchange="previewImage(this, 'fotoSesudahPreview', 'fotoSesudahImg')">
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF, WEBP. Max 5MB</p>

                                    <div id="fotoSesudahPreview" class="mt-3 hidden">
                                        <label class="block text-sm font-medium text-gray-600 mb-2">Preview:</label>
                                        <div class="bg-gray-50 p-3 rounded-md">
                                            <img id="fotoSesudahImg" src="" alt="Preview sesudah"
                                                class="max-w-full h-auto rounded-lg shadow-sm" style="max-width: 150px;"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <p class="hidden text-red-500 text-xs">Gagal memuat preview gambar</p>
                                            <button type="button" onclick="removeImage('fotoSesudahInput', 'fotoSesudahPreview')"
                                                class="mt-2 text-xs text-red-600 hover:text-red-800">Hapus Preview</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col sm:flex-row gap-4">
                            <button type="submit"
                                class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 text-white px-8 py-3 rounded-md font-medium transition-colors shadow-sm text-center">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.dashboard') }}"
                                class="w-full sm:w-auto bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-8 py-2.5 rounded-md font-medium transition-colors text-center shadow-sm">
                                Kembali ke Dashboard
                            </a>
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-4xl max-h-full overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Preview Foto</h3>
                <button onclick="closeImageModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-4 bg-gray-50 flex justify-center">
                <img id="modalImage" src="" alt="Preview" class="max-w-full h-auto max-h-[80vh] rounded-lg shadow-md"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                <p id="imageError" class="hidden text-red-500 text-center py-4">Gagal memuat gambar. URL mungkin tidak valid.</p>
            </div>
        </div>
    </div>

    <script>
        // Modal functions
        function openImageModal(imageUrl) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const errorMsg = document.getElementById('imageError');

            modalImage.src = imageUrl;
            modalImage.style.display = 'block';
            errorMsg.style.display = 'none';
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) closeImageModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeImageModal();
        });

        // Preview Image functions
        function previewImage(input, previewDivId, imgId) {
            const file = input.files[0];
            const previewDiv = document.getElementById(previewDivId);
            const img = document.getElementById(imgId);
            const errorMsg = img.nextElementSibling;

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    img.style.display = 'block';
                    errorMsg.style.display = 'none';
                    previewDiv.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewDiv.classList.add('hidden');
            }
        }

        function removeImage(inputId, previewDivId) {
            document.getElementById(inputId).value = '';
            const previewDiv = document.getElementById(previewDivId);
            previewDiv.classList.add('hidden');
        }
    </script>
</body>

</html>
