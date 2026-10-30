@extends('layouts.app')

@section('title', $gallery->title)

@section('content')
<section class="py-12">
    <div class="max-w-4xl mx-auto px-4">
        {{-- Back Button --}}
        <a href="{{ route('gallery') }}" class="inline-flex items-center text-teal-600 hover:text-teal-800 mb-6">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Galeri
        </a>

        {{-- Gallery Detail --}}
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            {{-- Image --}}
            @if ($gallery->image)
                <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}" class="w-full h-96 object-cover">
            @else
                <div class="w-full h-96 bg-gradient-to-br from-teal-600 to-teal-800 flex items-center justify-center">
                    <i class="fas {{ $gallery->icon }} text-8xl text-white/30"></i>
                </div>
            @endif

            {{-- Content --}}
            <div class="p-8">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $gallery->title }}</h1>
                        <p class="text-gray-500 text-sm">
                            <i class="fas {{ $gallery->icon }} mr-2"></i>
                            Dibuat pada {{ $gallery->created_at->translatedFormat('d F Y H:i') }}
                        </p>
                    </div>
                </div>

                {{-- Description --}}
                <div class="prose prose-lg max-w-none text-gray-700 mb-8 prose-p:text-base prose-p:leading-relaxed prose-p:my-4 prose-headings:font-bold prose-headings:text-gray-800 prose-ul:my-4 prose-li:my-1 prose-strong:font-semibold prose-strong:text-gray-900">
                    {!! $gallery->description !!}
                </div>

                {{-- Navigation --}}
                <div class="flex gap-4">
                    @php
                        $prevGallery = \App\Models\Gallery::where('is_active', true)
                            ->where('created_at', '>', $gallery->created_at)
                            ->orderBy('created_at')
                            ->first();
                        
                        $nextGallery = \App\Models\Gallery::where('is_active', true)
                            ->where('created_at', '<', $gallery->created_at)
                            ->orderBy('created_at', 'desc')
                            ->first();
                    @endphp

                    @if ($prevGallery)
                        <a href="{{ route('gallery.show', $prevGallery) }}" class="flex items-center text-teal-600 hover:text-teal-800 font-semibold">
                            <i class="fas fa-chevron-left mr-2"></i>Sebelumnya
                        </a>
                    @endif

                    <a href="{{ route('gallery') }}" class="flex-1 text-center bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition">
                        <i class="fas fa-th-large mr-2"></i>Lihat Semua Galeri
                    </a>

                    @if ($nextGallery)
                        <a href="{{ route('gallery.show', $nextGallery) }}" class="flex items-center text-teal-600 hover:text-teal-800 font-semibold">
                            Berikutnya<i class="fas fa-chevron-right ml-2"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
