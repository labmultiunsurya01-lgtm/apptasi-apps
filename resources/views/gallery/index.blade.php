@extends('layouts.app')

@section('title', 'Galeri')

@section('content')
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Galeri Kegiatan</h1>
            <p class="text-gray-600">Dokumentasi berbagai kegiatan APPTASI</p>
        </div>

        @if ($galleries->count() > 0)
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($galleries as $gallery)
                    <a href="{{ route('gallery.show', $gallery) }}" class="bg-white rounded-xl overflow-hidden card-shadow hover:shadow-xl transition group h-full flex flex-col">
                        @if ($gallery->image)
                            <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}" class="h-48 w-full object-cover">
                        @else
                            <div class="h-48 bg-gradient-to-br from-teal-600 to-teal-800 flex items-center justify-center">
                                <i class="fas {{ $gallery->icon }} text-6xl text-white/40 group-hover:scale-110 transition"></i>
                            </div>
                        @endif
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="font-semibold text-lg text-gray-800 mb-2 group-hover:text-teal-600 transition line-clamp-2">{{ $gallery->title }}</h3>
                            <p class="text-sm text-gray-500 line-clamp-3 flex-grow">{{ strip_tags($gallery->description) }}</p>
                            <div class="mt-3 pt-3 border-t border-gray-200">
                                <span class="text-xs text-teal-600 font-semibold group-hover:underline">Baca Selengkapnya →</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            {{-- Pagination --}}
            <div class="flex justify-center">
                {{ $galleries->links() }}
            </div>
        @else
            <div class="text-center text-gray-500">
                <i class="fas fa-image text-6xl mb-4"></i>
                <p class="text-lg">Belum ada galeri. Silakan cek kembali nanti.</p>
            </div>
        @endif
    </div>
</section>
@endsection

