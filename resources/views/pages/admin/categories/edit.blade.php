@extends('layouts.dashboard')

@section('title', 'Edit Program Paket')

@section('content')
    <div class="mb-6">
        <div class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400 mb-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Dashboard</a>
            <span>/</span>
            <a href="{{ route('admin.categories.index') }}" class="hover:text-blue-600">Program Paket</a>
            <span>/</span>
            <span>Edit Program</span>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Program Paket: {{ $category->name }}</h1>
        <p class="text-gray-600 dark:text-gray-400">Memperbarui informasi program paket umroh</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="p-6">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">
                    {{-- Nama Program Paket --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nama Program / Paket <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required
                               placeholder="Contoh: Umroh Syawal Premium"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-sm mt-1">Nama program harus unik dan mudah dikenali</p>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Deskripsi / Fasilitas
                        </label>
                        <textarea id="description" name="description" rows="4"
                                  placeholder="Jelaskan fasilitas paket (opsional)"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('description') border-red-500 @enderror">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-sm mt-1">Deskripsi membantu jamaah memahami isi paket</p>
                    </div>
                </div>

                {{-- Panduan --}}
                <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border-l-4 border-blue-500">
                    <h3 class="text-sm font-medium text-blue-800 dark:text-blue-300 mb-2">
                        <i class="fas fa-info-circle mr-2"></i>Panduan Program Paket:
                    </h3>
                    <ul class="text-sm text-blue-700 dark:text-blue-400 space-y-1">
                        <li>• Gunakan nama yang jelas (mis. Umroh Ramadhan, Paket VIP)</li>
                        <li>• Hindari karakter khusus yang tidak perlu</li>
                        <li>• Nama paket mencerminkan layanan yang ditawarkan</li>
                        <li>• Deskripsi berisi fasilitas dan rincian perjalanan</li>
                    </ul>
                </div>

                {{-- Preview --}}
                <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                        <i class="fas fa-eye mr-2"></i>Preview Program:
                    </h3>
                    <div class="flex items-center p-3 bg-white dark:bg-gray-800 rounded-lg border">
                        <div class="flex-shrink-0 h-10 w-10">
                            <div class="h-10 w-10 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                <i class="fas fa-kaaba text-blue-600 dark:text-blue-400"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900 dark:text-white" id="preview-name">
                                {{ $category->name }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400" id="preview-description">
                                {{ $category->description ?? '[Deskripsi paket akan muncul di sini]' }}
                            </div>
                        </div>
                        <div class="ml-auto">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 rounded-full">
                                {{ $category->products_count ?? $category->products()->count() }} Jamaah
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Submit Buttons --}}
                <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div>
                        <button type="button" onclick="confirmDelete()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                            <i class="fas fa-trash-alt mr-2"></i>Hapus Program Paket
                        </button>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>

            {{-- Delete Form --}}
            <form id="deleteForm" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        // Live preview for category name and description
        document.getElementById('name').addEventListener('input', function() {
            const previewName = document.getElementById('preview-name');
            if (this.value) {
                previewName.textContent = this.value;
                previewName.classList.remove('text-gray-400');
                previewName.classList.add('text-gray-900', 'dark:text-white');
            } else {
                previewName.textContent = '[Nama program paket]';
                previewName.classList.remove('text-gray-900', 'dark:text-white');
                previewName.classList.add('text-gray-400');
            }
        });

        document.getElementById('description').addEventListener('input', function() {
            const previewDesc = document.getElementById('preview-description');
            if (this.value) {
                previewDesc.textContent = this.value;
                previewDesc.classList.remove('text-gray-400');
                previewDesc.classList.add('text-gray-500', 'dark:text-gray-400');
            } else {
                previewDesc.textContent = '[Deskripsi paket]';
                previewDesc.classList.remove('text-gray-500', 'dark:text-gray-400');
                previewDesc.classList.add('text-gray-400');
            }
        });

        // Confirm delete function
        function confirmDelete() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Program paket yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm').submit();
                }
            });
        }
    </script>
    @endpush
@endsection
