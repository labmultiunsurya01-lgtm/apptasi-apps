@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4">

        {{-- Header + Logo --}}
        <div class="text-center mb-14">
            <div class="flex justify-center mb-6">
                {{-- Logo APPTASI (desain custom) --}}
                <div class="relative">
                    <div class="w-28 h-28 rounded-2xl bg-gradient-to-br from-teal-700 via-teal-600 to-cyan-700 shadow-xl flex items-center justify-center border-4 border-white ring-4 ring-teal-100">
                        <img src="{{ asset('images/pengayoman.png') }}" alt="Logo APPTASI" class="w-20 h-20 object-contain">
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-white rounded-full shadow flex items-center justify-center border-2 border-teal-100">
                        <i class="fas fa-calculator text-teal-700 text-sm"></i>
                    </div>
                </div>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
                Asosiasi Profesi Pendidik dan<br class="hidden sm:block"> Praktisi Teknisi Akuntansi
            </h1>
            <p class="text-teal-700 font-semibold text-lg tracking-wide">APPTASI</p>
            <p class="text-gray-500 text-sm mt-2 max-w-xl mx-auto">
                Perkumpulan berbadan hukum yang sah berdasarkan Keputusan Menteri Hukum Republik Indonesia
            </p>
        </div>

        {{-- Status Hukum / SK --}}
        <div class="bg-white rounded-2xl card-shadow overflow-hidden mb-12 border border-gray-100">
            <div class="bg-gradient-to-r from-teal-800 to-teal-600 px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="flex items-center gap-3 text-white">
                    <i class="fas fa-landmark text-2xl opacity-90"></i>
                    <div>
                        <div class="font-bold text-lg">Status Badan Hukum</div>
                        <div class="text-teal-100 text-sm">Pengesahan Pendirian Perkumpulan</div>
                    </div>
                </div>
                <img src="{{ asset('images/pengayoman.png') }}" alt="Pengayoman" class="h-12 w-auto rounded shadow-sm bg-white/10 p-1">
            </div>
            <div class="p-6 md:p-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-file-certificate text-teal-600"></i>
                            Keputusan Menteri Hukum RI
                        </h3>
                        <dl class="space-y-3 text-sm">
                            <div class="flex flex-col sm:flex-row sm:gap-3">
                                <dt class="text-gray-500 min-w-[140px]">Nomor SK</dt>
                                <dd class="font-semibold text-gray-800">AHU-0001964.AH.01.07.TAHUN 2025</dd>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:gap-3">
                                <dt class="text-gray-500 min-w-[140px]">Tanggal Penetapan</dt>
                                <dd class="font-semibold text-gray-800">19 Februari 2025</dd>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:gap-3">
                                <dt class="text-gray-500 min-w-[140px]">Nomor Pendaftaran</dt>
                                <dd class="font-semibold text-gray-800">6025021931100990</dd>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:gap-3">
                                <dt class="text-gray-500 min-w-[140px]">Akta Notaris</dt>
                                <dd class="font-semibold text-gray-800">No. 33 Tanggal 23 Januari 2025</dd>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:gap-3">
                                <dt class="text-gray-500 min-w-[140px]">Notaris</dt>
                                <dd class="font-semibold text-gray-800">DIAN FITRIANA, SH., M.KN<br><span class="font-normal text-gray-500">(Berkedudukan di Kota Bekasi)</span></dd>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:gap-3">
                                <dt class="text-gray-500 min-w-[140px]">Kedudukan</dt>
                                <dd class="font-semibold text-gray-800">Jakarta Barat</dd>
                            </div>
                        </dl>
                    </div>
                    <div class="flex flex-col items-center justify-center bg-gray-50 rounded-xl p-6 border border-dashed border-gray-200">
                        <p class="text-xs text-gray-500 mb-3 uppercase tracking-wider font-medium">Nomor Resmi</p>
                        <img src="{{ asset('images/ahu-number.jpeg') }}" alt="Nomor AHU-0001964.AH.01.07.TAHUN 2025" class="max-w-full h-auto rounded shadow-sm border border-gray-200">
                        <p class="text-xs text-gray-400 mt-3 text-center">
                            Ditetapkan di Jakarta, 19 Februari 2025<br>
                            a.n. Menteri Hukum RI<br>
                            Direktur Jenderal Administrasi Hukum Umum
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Siapa Kami --}}
        <div class="grid md:grid-cols-2 gap-10 items-center mb-14">
            <div>
                <h2 class="text-2xl font-bold text-teal-800 mb-4">Siapa Kami?</h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    <strong>Asosiasi Profesi Pendidik dan Praktisi Teknisi Akuntansi (APPTASI)</strong> adalah perkumpulan berbadan hukum
                    yang mewadahi para pendidik (dosen/guru) dan praktisi teknisi akuntansi di Indonesia.
                    APPTASI resmi disahkan berdasarkan Keputusan Menteri Hukum Republik Indonesia
                    Nomor <strong>AHU-0001964.AH.01.07.TAHUN 2025</strong> tanggal 19 Februari 2025.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Kami berkomitmen meningkatkan kualitas pendidikan dan praktik teknisi akuntansi melalui
                    pengembangan kompetensi, sertifikasi, jejaring profesional, serta advokasi kebijakan
                    yang mendukung kemajuan profesi di tingkat nasional.
                </p>
            </div>
            <div class="bg-gradient-to-br from-teal-50 to-cyan-50 rounded-2xl p-8 text-center border border-teal-100">
                <div class="w-16 h-16 bg-teal-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-balance-scale text-2xl text-white"></i>
                </div>
                <h3 class="text-xl font-semibold text-teal-800 mb-2">Badan Hukum Resmi</h3>
                <p class="text-gray-600 text-sm">
                    Perkumpulan sah dan diakui negara, berkedudukan di Jakarta Barat,
                    dengan susunan pengurus dan pengawas yang tercatat di Kementerian Hukum RI.
                </p>
            </div>
        </div>

        {{-- Visi Misi --}}
        <div class="grid md:grid-cols-2 gap-8 mb-14">
            <div class="bg-white p-8 rounded-xl card-shadow border-l-4 border-teal-600">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-eye text-teal-600 mr-3"></i> Visi
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    Menjadi asosiasi profesional terdepan yang menghasilkan pendidik dan praktisi teknisi akuntansi
                    berdaya saing global, berintegritas tinggi, dan berkontribusi nyata bagi pembangunan ekonomi nasional.
                </p>
            </div>
            <div class="bg-white p-8 rounded-xl card-shadow border-l-4 border-teal-600">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-bullseye text-teal-600 mr-3"></i> Misi
                </h3>
                <ul class="text-gray-600 space-y-2 list-disc list-inside text-sm leading-relaxed">
                    <li>Mengembangkan kompetensi profesional anggota melalui pelatihan dan sertifikasi</li>
                    <li>Membangun jejaring nasional dan internasional antar pendidik &amp; praktisi</li>
                    <li>Mendorong penelitian dan inovasi di bidang teknisi akuntansi</li>
                    <li>Menjadi mitra strategis pemerintah, institusi pendidikan, dan industri</li>
                </ul>
            </div>
        </div>

        {{-- Struktur Organisasi (dari SK) --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">Struktur Organisasi</h2>
            <p class="text-center text-gray-500 text-sm mb-8">
                Berdasarkan Lampiran Keputusan Menteri Hukum RI Nomor AHU-0001964.AH.01.07.TAHUN 2025
            </p>
        </div>

        {{-- PENGURUS --}}
        <div class="bg-white rounded-2xl card-shadow p-6 md:p-8 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-teal-600 text-white flex items-center justify-center">
                    <i class="fas fa-users-cog"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Pengurus</h3>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @php
                    $pengurus = [
                        ['nama' => 'ARPINUS', 'jabatan' => 'Ketua'],
                        ['nama' => 'HIDAYAT DARWIS', 'jabatan' => 'Wakil Ketua I'],
                        ['nama' => 'ABDULLAH MUKSIN', 'jabatan' => 'Wakil Ketua II'],
                        ['nama' => 'ETI RUSMIATI', 'jabatan' => 'Sekretaris'],
                        ['nama' => 'SAFRI', 'jabatan' => 'Wakil Sekretaris'],
                        ['nama' => 'GUNAWAN KERTASASMITA', 'jabatan' => 'Bendahara'],
                        ['nama' => 'DRS. SYAHRUL', 'jabatan' => 'Wakil Bendahara'],
                    ];
                @endphp
                @foreach($pengurus as $p)
                    <div class="border border-gray-100 rounded-xl p-4 hover:shadow-md transition bg-gray-50/50">
                        <div class="w-12 h-12 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center mb-3">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="text-xs font-semibold text-teal-700 uppercase tracking-wide mb-1">{{ $p['jabatan'] }}</div>
                        <div class="font-bold text-gray-800 text-sm leading-snug">{{ $p['nama'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- PENGAWAS --}}
        <div class="bg-white rounded-2xl card-shadow p-6 md:p-8 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-slate-700 text-white flex items-center justify-center">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Pengawas</h3>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @php
                    $pengawas = [
                        ['nama' => 'HERNY NURHAYATI, SE, MM', 'jabatan' => 'Ketua'],
                        ['nama' => 'RIZKY FADILLAH HIDAYAT', 'jabatan' => 'Anggota'],
                        ['nama' => 'ADINDA VERADINA PUTRI', 'jabatan' => 'Anggota'],
                    ];
                @endphp
                @foreach($pengawas as $p)
                    <div class="border border-gray-100 rounded-xl p-4 hover:shadow-md transition bg-gray-50/50">
                        <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center mb-3">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="text-xs font-semibold text-slate-600 uppercase tracking-wide mb-1">{{ $p['jabatan'] }}</div>
                        <div class="font-bold text-gray-800 text-sm leading-snug">{{ $p['nama'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Catatan legal --}}
        <div class="text-center text-xs text-gray-400 mt-4">
            Data susunan organ perkumpulan sesuai Lampiran SK Menteri Hukum RI Nomor AHU-0001964.AH.01.07.TAHUN 2025
            yang ditetapkan di Jakarta pada tanggal 19 Februari 2025.
        </div>
    </div>
</section>
@endsection
