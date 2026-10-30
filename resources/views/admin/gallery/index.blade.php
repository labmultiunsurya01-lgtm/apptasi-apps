@extends('layouts.app')

@section('title', 'Manajemen Galeri')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Manajemen Galeri</h1>
            <a href="{{ route('admin.gallery.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-plus mr-2"></i>Tambah Galeri Baru
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($galleries->count() > 0)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left">No</th>
                            <th class="px-6 py-3 text-left">Gambar</th>
                            <th class="px-6 py-3 text-left">Judul</th>
                            <th class="px-6 py-3 text-left">Ikon</th>
                            <th class="px-6 py-3 text-left">Urutan</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galleries as $key => $gallery)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-4">{{ ($galleries->currentPage() - 1) * $galleries->perPage() + $loop->iteration }}</td>
                                <td class="px-6 py-4">
                                    @if ($gallery->image)
                                        <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}" class="w-12 h-12 object-cover rounded">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $gallery->title }}</p>
                                        <p class="text-sm text-gray-500">{{ Str::limit(strip_tags($gallery->description), 40) }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <i class="fas {{ $gallery->icon }} text-lg"></i>
                                </td>
                                <td class="px-6 py-4">{{ $gallery->order }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-sm {{ $gallery->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('admin.gallery.edit', $gallery) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $galleries->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <i class="fas fa-image text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500 mb-4">Belum ada galeri. Mulai dengan menambahkan galeri baru.</p>
                <a href="{{ route('admin.gallery.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg transition">
                    Tambah Galeri
                </a>
            </div>
        @endif

        <a href="{{ route('admin.index') }}" class="mt-6 inline-block text-teal-600 hover:text-teal-800">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Admin
        </a>
    </div>
</div>
@endsection
