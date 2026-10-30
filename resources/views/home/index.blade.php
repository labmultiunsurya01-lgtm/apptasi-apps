@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero -->
<section class="gradient-bg text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
            Asosiasi Profesi Pendidik dan<br>Praktisi Teknisi Akuntansi Indonesia
        </h1>
        <p class="text-xl text-teal-100 max-w-3xl mx-auto mb-10">
            Membangun profesionalisme, kompetensi, dan integritas para pendidik serta praktisi teknisi akuntansi di seluruh Indonesia.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('members.index') }}" class="bg-white text-teal-800 font-semibold px-8 py-3 rounded-lg hover:bg-teal-50 transition shadow-lg">
                <i class="fas fa-user-plus mr-2"></i> Daftar Anggota
            </a>
            <a href="{{ route('about') }}" class="border-2 border-white text-white font-semibold px-8 py-3 rounded-lg hover:bg-white hover:text-teal-800 transition">
                Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
</section>

<!-- Statistik -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold text-teal-700 mb-2">500+</div>
                <div class="text-gray-600">Anggota Aktif</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-teal-700 mb-2">34</div>
                <div class="text-gray-600">Provinsi</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-teal-700 mb-2">120+</div>
                <div class="text-gray-600">Institusi</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-teal-700 mb-2">50+</div>
                <div class="text-gray-600">Kegiatan/Tahun</div>
            </div>
        </div>
    </div>
</section>

<!-- Visi Misi singkat -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Mengapa Bergabung dengan APPTASI?</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Kami hadir untuk memperkuat peran teknisi akuntansi dalam dunia pendidikan dan praktik profesional.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-xl card-shadow text-center">
                <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-5">
                    <i class="fas fa-graduation-cap text-2xl text-teal-700"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Pengembangan Kompetensi</h3>
                <p class="text-gray-600 text-sm">Pelatihan sertifikasi dan workshop rutin untuk meningkatkan keterampilan teknis dan pedagogik.</p>
            </div>
            <div class="bg-white p-8 rounded-xl card-shadow text-center">
                <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-5">
                    <i class="fas fa-network-wired text-2xl text-teal-700"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Jaringan Profesional</h3>
                <p class="text-gray-600 text-sm">Terhubung dengan ribuan pendidik dan praktisi akuntansi dari seluruh Indonesia.</p>
            </div>
            <div class="bg-white p-8 rounded-xl card-shadow text-center">
                <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-5">
                    <i class="fas fa-certificate text-2xl text-teal-700"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Keanggotaan</h3>
                <p class="text-gray-600 text-sm">Dapatkan pengakuan profesional dan kartu anggota resmi yang diakui secara nasional.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 gradient-bg text-white">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Siap Menjadi Bagian dari APPTASI?</h2>
        <p class="text-teal-100 mb-8">Daftarkan diri Anda sekarang dan dapatkan akses ke komunitas profesional teknisi akuntansi terbesar di Indonesia.</p>
        <a href="{{ route('members.index') }}" class="inline-block bg-white text-teal-800 font-semibold px-10 py-3 rounded-lg hover:bg-teal-50 transition shadow-lg">
            Daftar Sekarang
        </a>
    </div>
</section>
@endsection
