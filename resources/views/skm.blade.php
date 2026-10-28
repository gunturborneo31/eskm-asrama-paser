<!doctype html>
<html class="scroll-smooth">

<head>
    <title>E-SKM - Unit Penghubung Kabupaten Paser Juanda, Samarinda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* di HP, 100vh lebih tinggi dari layar yang terlihat (tertutup address bar),
           sehingga bagian bawah tiap halaman (tombol LANJUT) bisa tersembunyi */
        body .h-screen {
            height: 100vh;
            height: 100dvh;
        }
    </style>
</head>

<?php
$error = 'empty:hidden inline-flex items-center gap-2 w-fit max-w-full mb-2 px-4 py-2 rounded-lg bg-red-600 text-white font-bold lg:text-lg text-sm md:text-4xl shadow-lg ring-2 ring-white before:content-[\'\26A0\'] scroll-mt-40';
?>

<body class="items-center relative" style="background-color: #06336b;">
    @include('partials.paser-bg')

    <div class="overflow-x-hidden">

        @php($pesanError = session('error') ?? (request('gagal') === 'foto-terlalu-besar' ? 'Ukuran foto KTP terlalu besar. Gunakan foto maksimal 2 MB atau kosongkan foto KTP, lalu isi ulang survei.' : null))
        @php($adaError = $pesanError || $errors->any())
        @if ($adaError)
            {{-- responden dikembalikan dari proses kirim: tampilkan alasannya --}}
            <div id="alert-error"
                class="fixed top-3 left-1/2 -translate-x-1/2 z-50 w-[calc(100%-1.5rem)] max-w-xl rounded-2xl bg-white shadow-2xl border-l-8 border-red-600 p-4">
                <div class="flex items-start gap-3">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-600 text-white font-black">!</span>
                    <div class="flex-1 text-sm sm:text-base text-slate-800">
                        <p class="font-bold text-red-700 mb-1">Survei belum terkirim</p>
                        @if ($pesanError)
                            <p>{{ $pesanError }}</p>
                        @endif
                        @if ($errors->any())
                            <ul class="list-disc pl-5 space-y-0.5">
                                @foreach ($errors->all() as $pesan)
                                    <li>{{ $pesan }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <button type="button" onclick="document.getElementById('alert-error').remove()"
                        class="text-slate-400 hover:text-slate-600 text-2xl leading-none" aria-label="Tutup">&times;</button>
                </div>
            </div>
        @endif

        <div id="popup" class="{{ $adaError ? 'hidden' : '' }} fixed inset-0 z-50 bg-slate-950/70 backdrop-blur-sm w-full h-full overflow-y-auto overscroll-contain">
            <div class="flex min-h-full items-center justify-center p-4 sm:p-6" id="modal">
                <div class="relative w-full max-w-2xl p-3 md:p-5 sm:p-8 lg:p-6 shadow-2xl rounded-3xl bg-white border-t-8 border-[#0a3d7a]">
                    <div class="mt-1 sm:mt-3 text-center">
                        <h3 class="text-xl sm:text-3xl lg:text-2xl leading-tight font-extrabold mb-4 sm:mb-6 text-[#0a3d7a]">
                            SELAMAT
                            DATANG DI
                            SURVEY KEPUASAN
                            MASYARAKAT
                        </h3>
                        <label class="inline-block px-4 sm:px-6 py-1.5 sm:py-2 rounded-full bg-amber-100 text-amber-800 font-black text-sm sm:text-lg">⚠ PERHATIAN</label>
                        <div class="px-0 sm:px-7 items-start mt-3 sm:mt-4 text-left justify-start">
                            <table class="border-separate border-spacing-y-3 sm:border-spacing-y-4 text-sm sm:text-lg text-slate-800 leading-snug">
                                <tr>
                                    <td class="items-start flex pr-3 font-bold text-[#0a3d7a]">1.</td>
                                    <td class="text-left">Tujuan survei ini adalah untuk memperoleh gambaran secara
                                        obyektif mengenai kepuasan
                                        masyarakat terhadap pelayanan publik</td>
                                </tr>
                                <tr>
                                    <td class="items-start flex pr-3 font-bold text-[#0a3d7a]">2.</td>
                                    <td class="text-left">Pilihan jawaban yang Anda berikan diharapkan sebagai
                                        pilihan
                                        yang dapat dipertanggungjawabkan</td>
                                </tr>
                                <tr>
                                    <td class="items-start flex pr-3 font-bold text-[#0a3d7a]">3.</td>
                                    <td class="text-left">Hasil survei ini akan digunakan untuk bahan penyusunan
                                        Laporan
                                        Survei Kepuasan
                                        Masyarakat terhadap pelayanan publik yang sangat bermanfaat bagi pemerintah
                                        maupun
                                        masyarakat</td>
                                </tr>
                                <tr>
                                    <td class="items-start flex pr-3 font-bold text-[#0a3d7a]">4.</td>
                                    <td class="text-left">Keterangan nilai survei bersifat terbuka dan tidak
                                        dirahasiakan
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="items-center px-0 sm:px-4 py-3">
                            <button onclick="closePopup()" id="ok-btn"
                                class="px-4 py-3 sm:py-4 lg:py-3 bg-[#0a3d7a] hover:bg-[#072c5a] text-white text-base sm:text-xl font-bold rounded-2xl w-full shadow-xl focus:outline-none focus:ring-4 focus:ring-sky-300">OK, SAYA MENGERTI</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <form action="{{ route('nilaiUnsur.store') }}" method="POST" enctype="multipart/form-data"
            class="h-screen flex">
            @csrf
            <div id=""
                class="hidden items-center relative isolate  min-w-full h-screen h-screen px-6 sm:px-16 lg:hidden lg:px-24">

                <div class=" hidden text-center   lg:py-10 lg:my-auto lg:text-left  w-full justify-between">
                    <h1
                        class=" max-w-md  font-bold tracking-tight mb-2 whitespace-nowrap mb-3 text-white lg:text-2xl  text-lg md:text-5xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                        Jenis pelayanan yang akan anda berikan penilaian
                    </h1>
                    <div class="lg:flex w-full justify-between gap-4">
                        <ul class="grid w-full gap-2 md:grid-cols-1">
                            <li>
                                <input type="radio" id="pajak_1" name="jenisPelayanan" value="Pajak 1 Tahunan"
                                    checked class="hidden scroll-btn peer">
                                <label for="pajak_1"
                                    class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Pajak 1
                                            Tahunan</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="pajak_5" name="jenisPelayanan" value="Pajak 5 Tahunan"
                                    class="hidden scroll-btn peer">
                                <label for="pajak_5"
                                    class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Pajak 5
                                            Tahunan</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="e_samsat" name="jenisPelayanan" value="E-SAMSAT"
                                    class="hidden scroll-btn peer">
                                <label for="e_samsat"
                                    class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">E-SAMSAT
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="bbnkb_1" name="jenisPelayanan"
                                    value="Proses BBNKB I (Daftar Kendaraan
                                            Pertama)"
                                    class="hidden scroll-btn peer">
                                <label for="bbnkb_1"
                                    class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Proses BBNKB
                                            I (Daftar
                                            Kendaraan
                                            Pertama)</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="bbnkb_2" name="jenisPelayanan"
                                    value="Proses BBNKB II (Balik Nama)" class="hidden scroll-btn peer">
                                <label for="bbnkb_2"
                                    class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Proses BBNKB
                                            II (Balik
                                            Nama)</div>
                                    </div>
                                </label>
                            </li>
                        </ul>
                        <ul class="grid w-full gap-2 md:grid-cols-1">
                            <li>
                                <input type="radio" id="hilang" name="jenisPelayanan"
                                    value="Proses STNK & SKPD Hilang/Rusak" class="hidden scroll-btn peer">
                                <label for="hilang"
                                    class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Proses STNK
                                            & SKPD
                                            Hilang/Rusak</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="rubah_bentuk" name="jenisPelayanan"
                                    value="Rubah Bentuk / Warna / Mesin / Ganti
                                            Nopol"
                                    class="hidden scroll-btn peer">
                                <label for="rubah_bentuk"
                                    class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Rubah
                                            Bentuk / Warna /
                                            Mesin / Ganti
                                            Nopol</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="mutasi_keluar" name="jenisPelayanan"
                                    value="Proses Mutasi Keluar" class="hidden scroll-btn peer">
                                <label for="mutasi_keluar"
                                    class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Proses
                                            Mutasi Keluar
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="mutasi_masuk" name="jenisPelayanan"
                                    value="Proses Mutasi Masuk" class="hidden scroll-btn peer">
                                <label for="mutasi_masuk"
                                    class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Proses
                                            Mutasi Masuk</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="loket_khusus" name="jenisPelayanan"
                                    value="Loket Khusus Disabilitas" class="hidden scroll-btn peer">
                                <label for="loket_khusus"
                                    class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Loket
                                            Khusus Disabilitas
                                        </div>
                                    </div>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <li class="flex gap-3 mt-8 w-full">
                        <a type="button" onclick="window.location='#pertama'"
                             class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-[#0a3d7a] hover:bg-[#072c5a] text-white border-white/80">
                            <label class="cursor-pointer">LANJUT</label>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                <path fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                </div>
            </div>
            <div id="pertama"
                class="lg:pt-0 pt-8 md:pt-16 relative isolate overflow-y-auto overflow-x-hidden overscroll-y-contain touch-pan-y min-w-full h-screen pb-16 lg:pb-0 px-6 sm:px-16 lg:flex lg:px-24"
                style="-webkit-overflow-scrolling: touch;">
                <div class=" text0-center  lg:flex lg:py-10 lg:my-auto lg:text-left  w-full justify-between">
                    <div class="gap-4 w-full">
                        <div class="flex justify-between">
                            <h1
                                class=" max-w-md  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-xl md:text-5xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                NIK <span class="font-semibold text-amber-200 text-base md:text-3xl lg:text-lg">(Opsional)</span>
                            </h1>
                            <h1 id="errornik" class="{{ $error }}"></h1>
                            @error('nik')
                                <div class="{{ $error }}">NIK Harus 16 Digit</div>
                            @enderror
                        </div>
                        <input type="text" id="nik" name="nik" onkeypress="return hanyaAngka(event)"
                            inputmode="numeric" maxlength="16" value="{{ old('nik') }}"
                            class="block w-full p-3 lg:text-xl text-lg md:text-5xl text-black border border-2 border-white rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500"></input>
                        <p class="mt-2 mb-4 md:mb-6 text-white/90 text-sm md:text-2xl lg:text-base drop-shadow-[0_2px_2px_rgba(0,0,0,0.6)]">
                            Boleh dikosongkan. Jika diisi, NIK harus 16 digit angka.
                        </p>
                        <div class="flex justify-between w-full ">
                            <h1
                                class=" max-w-md  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-xl md:text-5xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                Nama
                            </h1>
                            <h1 id="errornama" class="{{ $error }}"></h1>
                            @error('nama')
                                <div class="{{ $error }}">Harus Diisi</div>
                            @enderror
                        </div>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                            class="block w-full p-3 lg:text-xl text-lg md:text-5xl text-black border border-2 border-white rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 mb-4 md:mb-6"></input>
                        <div class="flex justify-between">
                            <h1
                                class=" max-w-md  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-xl md:text-5xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                Nomor Telpon HP
                            </h1>
                            <h1 id="errornohp" class="{{ $error }}"></h1>
                            @error('nohp')
                                <div class="{{ $error }}">Harus Diisi</div>
                            @enderror
                        </div>
                        <input type="text" id="nohp" name="nohp" onkeypress="return hanyaAngka(event)"
                            value="{{ old('nohp') }}"
                            class="block w-full p-3 lg:text-xl text-lg md:text-5xl text-black border border-2 border-white rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 mb-4 md:mb-6"></input>
                        <div class="flex justify-between">
                            <h1
                                class=" max-w-md  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-xl md:text-5xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                Jenis Kelamin <span class="normal-case font-semibold text-amber-200 text-base md:text-3xl lg:text-lg">(Pilih salah satu)</span>
                            </h1>
                            <h1 id="errorjenkel" class="{{ $error }}"></h1>
                            @error('jenkel')
                                <div class="{{ $error }}">Harus Diisi</div>
                            @enderror
                        </div>
                        <ul class="grid w-full gap-2 grid-cols-2 auto-rows-fr mb-4 md:mb-6">
                            <li>
                                <input type="radio" id="laki" name="jenkel[jenkel]" value="Laki - Laki"
                                    checked
                                    {{ old('jenkel.laki') == 'Laki - Laki' ? 'checked=' . '"' . 'checked' . '"' : '' }}
                                    class="hidden scroll-btn peer">
                                <label for="laki"
                                    class="inline-flex items-center justify-between gap-4 w-full h-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-base md:text-3xl  font-semibold">Laki - Laki
                                            ( L )</div>
                                    </div>
                                </label>
                                </input>
                            </li>
                            <li>
                                <input type="radio" id="perempuan" name="jenkel[jenkel]" value="Perempuan"
                                    {{ old('jenkel.perempuan') == 'Perempuan' ? 'checked=' . '"' . 'checked' . '"' : '' }}
                                    class="hidden scroll-btn peer">
                                <label for="perempuan"
                                    class="inline-flex items-center justify-between gap-4 w-full h-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-base md:text-3xl  font-semibold">Perempuan (
                                            P )</div>
                                    </div>
                                </label>
                                </input>

                            </li>
                        </ul>
                    </div>
                    <div class="w-1/6"></div>
                    <div class="gap-4 w-full">
                        <div class="flex justify-between">
                            <h1
                                class=" max-w-md  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-xl md:text-5xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                Alamat
                            </h1>
                            <h1 id="erroralamat" class="{{ $error }}"></h1>
                            @error('alamat')
                                <div class="{{ $error }}">Harus Diisi</div>
                            @enderror
                        </div>
                        <textarea type="text" id="alamat" name="alamat" rows="5"
                            class="block w-full p-4 lg:h-24 lg:p-3 lg:text-xl text-lg md:text-5xl text-black border border-2 border-white rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 mb-4 md:mb-6"></textarea>
                        <div class="flex justify-between">
                            <h1
                                class=" max-w-md  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-xl md:text-5xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                Keperluan
                            </h1>
                            <h1 id="errorkeperluan" class="{{ $error }}"></h1>
                            @error('keperluan')
                                <div class="{{ $error }}">Harus Diisi</div>
                            @enderror
                        </div>
                        <textarea id="keperluan" name="keperluan" rows="4"
                            class="block w-full p-4 lg:h-20 lg:p-3 lg:text-xl text-lg md:text-5xl text-black border border-2 border-white rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 mb-4 md:mb-6"></textarea>
                        <div class="flex justify-between">
                            <h1
                                class=" max-w-md  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-xl md:text-5xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                Upload File Foto KTP <span class="font-semibold text-amber-200 text-base md:text-3xl lg:text-lg">(Opsional)</span>
                            </h1>
                            <h1 id="errorktp" class="{{ $error }}"></h1>
                            @error('foto_ktp')
                                <div class="{{ $error }}">File harus gambar JPG/PNG, maks. 2 MB</div>
                            @enderror
                        </div>
                        <p class="mb-3 text-white/90 text-sm md:text-2xl lg:text-base drop-shadow-[0_2px_2px_rgba(0,0,0,0.6)]">
                            Boleh dikosongkan. Jika diupload, gunakan foto JPG/PNG dengan ukuran maksimal 2 MB.
                        </p>
                        <div class="mb-4 md:mb-6">
                            <div id="foto_ktp_preview_wrapper" class="hidden mb-4 rounded-xl border-2 border-dashed border-white bg-white/10 p-3">
                                <div class="flex flex-col gap-3">
                                    {{-- preview dibatasi tingginya dan bisa di-scroll supaya tombol LANJUT tetap terlihat --}}
                                    <div class="max-h-60 lg:max-h-48 overflow-y-auto overscroll-contain rounded-lg border border-white bg-white shadow-md">
                                        <img id="foto_ktp_preview" src="" alt="Preview KTP" class="block w-full h-auto">
                                    </div>
                                    <div class="flex items-center justify-between gap-3">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-lg font-semibold text-white truncate" id="foto_ktp_name">Nama file</p>
                                            <p class="text-sm text-white/80">Preview foto KTP</p>
                                        </div>
                                        <label for="foto_ktp" class="cursor-pointer rounded-lg bg-white px-4 py-2 text-sm font-semibold text-black shadow-sm">Ubah</label>
                                    </div>
                                </div>
                            </div>
                            <input type="file" id="foto_ktp" name="foto_ktp" accept="image/*"
                                class="block w-full p-3 lg:text-xl text-lg md:text-5xl text-white file:mr-4 file:py-3 file:px-4 file:rounded-lg file:border-0 file:bg-white file:text-black file:font-semibold border border-2 border-white rounded-lg bg-white/10 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <li class="flex gap-3 mt-8 w-full">
                            <a type="submit" id="btn1"  class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-[#0a3d7a] hover:bg-[#072c5a] text-white border-white/80">
                                <label class="cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </div>
                </div>
            </div>
            <div id="kedua"
                class="lg:pt-0 pt-8 md:pt-16 relative isolate overflow-y-auto overflow-x-hidden min-w-full h-screen pb-16 lg:pb-0
                px-6 sm:px-16 lg:flex lg:px-24">
                <div class=" text-center  lg:flex lg:py-10 lg:my-auto lg:text-left   w-full justify-between">
                    <div class="gap-4 w-full">
                        <div class="flex justify-between">
                            <h1
                                class=" max-w-md  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-xl md:text-5xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                Usia (Tahun) <span class="normal-case font-semibold text-amber-200 text-base md:text-3xl lg:text-lg">(Pilih salah satu)</span>
                            </h1>
                            <h1 id="errorusia" class="{{ $error }}"></h1>
                            @error('usia')
                                <div class="{{ $error }}">Harus Diisi</div>
                            @enderror
                        </div>
                        <ul class="grid w-full gap-2 grid-cols-2 auto-rows-fr">
                            <li>
                                <input type="radio" id="29" name="usia" value="29" checked
                                    class="hidden scroll-btn peer">
                                <label for="29"
                                    class="inline-flex items-center justify-between gap-4 w-full h-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Kurang dari
                                            30 Tahun
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="30" name="usia" value="30"
                                    class="hidden scroll-btn peer">
                                <label for="30"
                                    class="inline-flex items-center justify-between gap-4 w-full h-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">30 s/d 40
                                            Tahun</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="41" name="usia" value="41"
                                    class="hidden scroll-btn peer">
                                <label for="41"
                                    class="inline-flex items-center justify-between gap-4 w-full h-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">41 s/d 50
                                            Tahun</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="51" name="usia" value="51 "
                                    class="hidden scroll-btn peer">
                                <label for="51"
                                    class="inline-flex items-center justify-between gap-4 w-full h-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Lebih dari
                                            50 Tahun</div>
                                    </div>
                                </label>
                            </li>
                        </ul>
                        <div class="flex justify-between mt-6">
                            <h1
                                class=" max-w-md  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-xl md:text-5xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                Pendidikan <span class="normal-case font-semibold text-amber-200 text-base md:text-3xl lg:text-lg">(Pilih salah satu)</span>
                            </h1>
                            </h1>
                            @error('pendidikan')
                                <div class="{{ $error }}">Pendidikan</div>
                            @enderror
                        </div>
                        <ul class="grid w-full gap-2 grid-cols-2 auto-rows-fr">
                            <li>
                                <input type="radio" id="sd" name="pendidikan" value="SD"
                                    class="hidden scroll-btn peer">
                                <label for="sd"
                                    class="inline-flex items-center justify-between gap-4 w-full h-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">SD</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="smp" name="pendidikan" value="SMP"
                                    class="hidden scroll-btn peer">
                                <label for="smp"
                                    class="inline-flex items-center justify-between gap-4 w-full h-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">SMP</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="sma/smk" name="pendidikan" value="SMA / SMK" checked
                                    class="hidden scroll-btn peer">
                                <label for="sma/smk"
                                    class="inline-flex items-center justify-between gap-4 w-full h-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">SMA / SMK
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="d1/d3" name="pendidikan" value="D-I / D-III"
                                    class="hidden scroll-btn peer">
                                <label for="d1/d3"
                                    class="inline-flex items-center justify-between gap-4 w-full h-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">D-I / D-III
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="s1/setara" name="pendidikan" value="S1 / Setara"
                                    class="hidden scroll-btn peer">
                                <label for="s1/setara"
                                    class="inline-flex items-center justify-between gap-4 w-full h-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">S1 / Setara
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="s2/s3" name="pendidikan" value="S2 / S3"
                                    class="hidden scroll-btn peer">
                                <label for="s2/s3"
                                    class="inline-flex items-center justify-between gap-4 w-full h-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">S2 / S3
                                        </div>
                                    </div>
                                </label>
                            </li>
                        </ul>


                    </div>
                    <div class="w-1/6"></div>
                    <div class="gap-4 w-full lg:mt-0 mt-4">
                        <div class="flex justify-between">
                            <h1
                                class=" max-w-md capitalize  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-xl md:text-5xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                pekerjaan <span class="normal-case font-semibold text-amber-200 text-base md:text-3xl lg:text-lg">(Pilih salah satu)</span>
                            </h1>
                            </h1>
                            @error('pekerjaan')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        <ul class="grid w-full gap-2 md:grid-cols-1">
                            <li>
                                <input type="radio" id="asn" name="pekerjaan" value="ASN"
                                    class="hidden scroll-btn peer">
                                <label for="asn"
                                    class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">ASN</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="tni/polri" name="pekerjaan" value="TNI / POLRI"
                                    class="hidden scroll-btn peer">
                                <label for="tni/polri"
                                    class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">TNI / POLRI
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="swasta" name="pekerjaan" value="Swasta" checked
                                    class="hidden scroll-btn peer">
                                <label for="swasta"
                                    class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Swasta
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="pengusaha" name="pekerjaan" value="Pengusaha"
                                    class="hidden scroll-btn peer">
                                <label for="pengusaha"
                                    class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Pengusaha
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="pelajar" name="pekerjaan" value="Pelajar"
                                    class="hidden scroll-btn peer">
                                <label for="pelajar"
                                    class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Pelajar
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="lyn" name="pekerjaan" value="Lainnya"
                                    class="hidden scroll-btn peer">
                                <label for="lyn"
                                    class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                    <div class="block">
                                        <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Lainnya
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li class="flex gap-3 mt-8 w-full">
                                <a type="button" onclick="window.location='#pertama'"
                                     class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-white hover:bg-sky-100 text-[#0a3d7a] border-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <label class="cursor-pointer">KEMBALI</label>

                                </a>
                                <a type="button" onclick="window.location='#satu'"
                                     class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-[#0a3d7a] hover:bg-[#072c5a] text-white border-white/80">
                                    <label class="cursor-pointer">LANJUT</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="satu"
                class="lg:pt-0 pt-8 md:pt-16 relative isolate overflow-y-auto overflow-x-hidden min-w-full h-screen pb-16 lg:pb-0
                px-6 sm:px-16 lg:flex lg:px-24">
                <div class=" text-center  lg:flex lg:py-10 lg:my-auto lg:text-left items-center w-full justify-between">
                    <h2
                        class="text-left text-left lg:max-w-md  font-bold tracking-tight text-white mb-5 md:mb-10 text-2xl md:text-6xl lg:text-3xl drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                        1.
                        Bagaimana pendapat Saudara tentang Kesesuaian Persyaratan pelayanan dengan jenis pelayanannya ?
                    <span class="block mt-3 normal-case font-semibold text-amber-200 text-base md:text-3xl lg:text-lg">(Pilih salah satu)</span></h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1 scroll-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('persyaratan')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="hosting-small" name="u1" value="0"
                                class="hidden scroll-btn peer">
                            <label for="hosting-small"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Tidak Sesuai</div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="hosting-big" name="u1" value="1"
                                class="hidden scroll-btn peer">
                            <label for="hosting-big"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Tidak Sesuai
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="hosting-medium" name="u1" value="2"
                                class="hidden scroll-btn peer">
                            <label for="hosting-medium"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Kurang Sesuai
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="hosting-aja" name="u1" value="3"
                                class="hidden scroll-btn peer">
                            <label for="hosting-aja"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sesuai</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="hosting-ad" name="u1" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="hosting-ad"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Sesuai
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li class="flex gap-3 mt-8 w-full">

                            <a type="button" onclick="window.location='#kedua'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-white hover:bg-sky-100 text-[#0a3d7a] border-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label class="cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#dua'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-[#0a3d7a] hover:bg-[#072c5a] text-white border-white/80">
                                <label class="cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="dua"
                class="lg:pt-0 pt-8 md:pt-16 relative isolate overflow-y-auto overflow-x-hidden min-w-full h-screen pb-16 lg:pb-0
                px-6 sm:px-16 lg:flex lg:px-24"
                style="background-image:
                    radial-gradient(at -10% -10%, #008DD5, transparent 35%),
                    radial-gradient(at 110% 110%, #008DD5, transparent 35%);">
                <div class=" text-center  lg:flex lg:py-10 lg:my-auto lg:text-left items-center  w-full justify-between">
                    <h2
                        class=" text-left lg:max-w-md  font-bold tracking-tight text-white mb-5 md:mb-10 text-2xl md:text-6xl lg:text-3xl drop-shadow-[0_7px_7px_rgba(0,0,0,0.5)]">
                        2.
                        Bagaimana pemahaman Saudara tentang Kemudahan Prosedur Pelayanan di Unit Penghubung Kabupaten Paser Juanda, Samarinda ?<span class="block mt-3 normal-case font-semibold text-amber-200 text-base md:text-3xl lg:text-lg">(Pilih salah satu)</span></h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('kompetensi')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="hosting-a" name="u2" value="0"
                                class="hidden scroll-btn peer">
                            <label for="hosting-a"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Tidak Mudah</div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="hosting-b" name="u2" value="1"
                                class="hidden scroll-btn peer">
                            <label for="hosting-b"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Tidak Mudah
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="hosting-c" name="u2" value="2"
                                class="hidden scroll-btn peer">
                            <label for="hosting-c"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Kurang Mudah
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="hosting-d" name="u2" value="3"
                                class="hidden scroll-btn peer">
                            <label for="hosting-d"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Mudah</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="hosting-e" name="u2" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="hosting-e"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Mudah
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li class="flex gap-3 mt-8 w-full">
                            <a type="button" onclick="window.location='#satu'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-white hover:bg-sky-100 text-[#0a3d7a] border-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label class="cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#tiga'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-[#0a3d7a] hover:bg-[#072c5a] text-white border-white/80">
                                <label class="cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="tiga"
                class="lg:pt-0 pt-8 md:pt-16 relative isolate overflow-y-auto overflow-x-hidden min-w-full h-screen pb-16 lg:pb-0
                px-6 sm:px-16 lg:flex lg:px-24">
                <div class=" text-center  lg:flex lg:py-10 lg:my-auto lg:text-left items-center  w-full justify-between">
                    <h2
                        class=" text-left lg:max-w-md  font-bold tracking-tight text-white mb-5 md:mb-10 text-2xl md:text-6xl lg:text-3xl drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                        3.
                        Bagaimana pendapat Saudara tentang Kecepatan Waktu Pelayanan di Unit Penghubung Kabupaten Paser Juanda, Samarinda ?<span class="block mt-3 normal-case font-semibold text-amber-200 text-base md:text-3xl lg:text-lg">(Pilih salah satu)</span></h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('prosedur')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="prosedur-small" name="u3" value="0"
                                class="hidden scroll-btn peer">
                            <label for="prosedur-small"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Tidak Cepat</div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="prosedur-big" name="u3" value="1"
                                class="hidden scroll-btn peer">
                            <label for="prosedur-big"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Tidak Cepat
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="prosedur-medium" name="u3" value="2"
                                class="hidden scroll-btn peer">
                            <label for="prosedur-medium"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Kurang Cepat
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="prosedur-aja" name="u3" value="3"
                                class="hidden scroll-btn peer">
                            <label for="prosedur-aja"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Cepat</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="prosedur-ad" name="u3" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="prosedur-ad"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Cepat
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li class="flex gap-3 mt-8 w-full">
                            <a type="button" onclick="window.location='#dua'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-white hover:bg-sky-100 text-[#0a3d7a] border-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label class="cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#empat'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-[#0a3d7a] hover:bg-[#072c5a] text-white border-white/80">
                                <label class="cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="empat"
                class="lg:pt-0 pt-8 md:pt-16 relative isolate overflow-y-auto overflow-x-hidden min-w-full h-screen pb-16 lg:pb-0
                px-6 sm:px-16 lg:flex lg:px-24">
                <div class=" text-center  lg:flex lg:py-10 lg:my-auto lg:text-left items-center  w-full justify-between">
                    <h2
                        class=" text-left lg:max-w-md  font-bold tracking-tight text-white mb-5 md:mb-10 text-2xl md:text-6xl lg:text-3xl drop-shadow-[0_7px_7px_rgba(0,0,0,0.5)]">
                        4. Bagaimana pendapat Saudara tentang Kewajaran Biaya/Tarif untuk Mendapatkan Pelayanan ?<span class="block mt-3 normal-case font-semibold text-amber-200 text-base md:text-3xl lg:text-lg">(Pilih salah satu)</span></h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('perilaku')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="perilaku-a" name="u4" value="0"
                                class="hidden scroll-btn peer">
                            <label for="perilaku-a"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Tidak Wajar
                                    </div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="perilaku-b" name="u4" value="1"
                                class="hidden scroll-btn peer">
                            <label for="perilaku-b"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Tidak Wajar
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="perilaku-c" name="u4" value="2"
                                class="hidden scroll-btn peer">
                            <label for="perilaku-c"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Cukup Wajar
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="perilaku-d" name="u4" value="3"
                                class="hidden scroll-btn peer">
                            <label for="perilaku-d"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Wajar</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="perilaku-e" name="u4" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="perilaku-e"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Wajar
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li class="flex gap-3 mt-8 w-full">
                            <a type="button" onclick="window.location='#tiga'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-white hover:bg-sky-100 text-[#0a3d7a] border-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label class="cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#lima'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-[#0a3d7a] hover:bg-[#072c5a] text-white border-white/80">
                                <label class="cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="lima"
                class="lg:pt-0 pt-8 md:pt-16 relative isolate overflow-y-auto overflow-x-hidden min-w-full h-screen pb-16 lg:pb-0
                px-6 sm:px-16 lg:flex lg:px-24">
                <div class=" text-center  lg:flex lg:py-10 lg:my-auto lg:text-left items-center  w-full justify-between">
                    <h2
                        class=" text-left lg:max-w-md  font-bold tracking-tight text-white mb-5 md:mb-10 text-2xl md:text-6xl lg:text-3xl drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                        5.
                        Bagaimana pendapat Saudara tentang Kesesuaian Produk Pelayanan antara yang tercantum dalam
                        standar pelayanan dengan hasil yang diberikan ?<span class="block mt-3 normal-case font-semibold text-amber-200 text-base md:text-3xl lg:text-lg">(Pilih salah satu)</span></h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('kecepatan')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="kecepatan-small" name="u5" value="0"
                                class="hidden scroll-btn peer">
                            <label for="kecepatan-small"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Tidak Sesuai</div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="kecepatan-big" name="u5" value="1"
                                class="hidden scroll-btn peer">
                            <label for="kecepatan-big"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Tidak Sesuai
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="kecepatan-medium" name="u5" value="2"
                                class="hidden scroll-btn peer">
                            <label for="kecepatan-medium"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Kurang Sesuai
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="kecepatan-aja" name="u5" value="3"
                                class="hidden scroll-btn peer">
                            <label for="kecepatan-aja"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sesuai</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="kecepatan-ad" name="u5" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="kecepatan-ad"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Sesuai
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li class="flex gap-3 mt-8 w-full">
                            <a type="button" onclick="window.location='#empat'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-white hover:bg-sky-100 text-[#0a3d7a] border-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label class="cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#enam'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-[#0a3d7a] hover:bg-[#072c5a] text-white border-white/80">
                                <label class="cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="enam"
                class="lg:pt-0 pt-8 md:pt-16 relative isolate overflow-y-auto overflow-x-hidden min-w-full h-screen pb-16 lg:pb-0
                px-6 sm:px-16 lg:flex lg:px-24"
                style="background-image:
                    radial-gradient(at -10% -10%, #008DD5, transparent 35%),
                    radial-gradient(at 110% 110%, #008DD5, transparent 35%);">
                <div class=" text-center  lg:flex lg:py-10 lg:my-auto lg:text-left items-center  w-full justify-between">
                    <h2
                        class=" text-left lg:max-w-md  font-bold tracking-tight text-white mb-5 md:mb-10 text-2xl md:text-6xl lg:text-3xl drop-shadow-[0_7px_7px_rgba(0,0,0,0.5)]">
                        6. Bagaimana pendapat Saudara tentang Kompetensi/Kemampuan Petugas dalam pelayanan ?<span class="block mt-3 normal-case font-semibold text-amber-200 text-base md:text-3xl lg:text-lg">(Pilih salah satu)</span></h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('sarana')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="sarana-a" name="u6" value="0"
                                class="hidden scroll-btn peer">
                            <label for="sarana-a"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Tidak Kompeten</div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="sarana-b" name="u6" value="1"
                                class="hidden scroll-btn peer">
                            <label for="sarana-b"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Tidak Kompeten
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="sarana-c" name="u6" value="2"
                                class="hidden scroll-btn peer">
                            <label for="sarana-c"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Kurang Kompeten
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="sarana-d" name="u6" value="3"
                                class="hidden scroll-btn peer">
                            <label for="sarana-d"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Kompeten</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="sarana-e" name="u6" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="sarana-e"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Kompeten
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li class="flex gap-3 mt-8 w-full">
                            <a type="button" onclick="window.location='#lima'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-white hover:bg-sky-100 text-[#0a3d7a] border-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label class="cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#tujuh'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-[#0a3d7a] hover:bg-[#072c5a] text-white border-white/80">
                                <label class="cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="tujuh"
                class="lg:pt-0 pt-8 md:pt-16 relative isolate overflow-y-auto overflow-x-hidden min-w-full h-screen pb-16 lg:pb-0
                px-6 sm:px-16 lg:flex lg:px-24">
                <div class=" text-center  lg:flex lg:py-10 lg:my-auto lg:text-left items-center  w-full justify-between">
                    <h2
                        class=" text-left lg:max-w-md  font-bold tracking-tight text-white mb-5 md:mb-10 text-2xl md:text-6xl lg:text-3xl drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                        7.
                        Bagaimana pemahaman Saudara tentang Perilaku Petugas dalam pelayanan terkait kesopanan dan
                        keramahan ?<span class="block mt-3 normal-case font-semibold text-amber-200 text-base md:text-3xl lg:text-lg">(Pilih salah satu)</span></h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('biaya')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="biaya-aja" name="u7" value="0"
                                class="hidden scroll-btn peer">
                            <label for="biaya-aja"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Tidak Sopan dan Ramah</div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="biaya-medium" name="u7" value="1"
                                class="hidden scroll-btn peer">
                            <label for="biaya-medium"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Tidak Sopan dan
                                        Ramah</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="biaya-big" name="u7" value="2"
                                class="hidden scroll-btn peer">
                            <label for="biaya-big"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Cukup Sopan dan
                                        Ramah</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="biaya-cbig" name="u7" value="3"
                                class="hidden scroll-btn peer">
                            <label for="biaya-cbig"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sopan dan Ramah
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="biaya-small" name="u7" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="biaya-small"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Sopan
                                        dan Ramah</div>
                                </div>
                            </label>
                        </li>
                        <li class="flex gap-3 mt-8 w-full">
                            <a type="button" onclick="window.location='#enam'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-white hover:bg-sky-100 text-[#0a3d7a] border-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label class="cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#delapan'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-[#0a3d7a] hover:bg-[#072c5a] text-white border-white/80">
                                <label class="cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="delapan"
                class="lg:pt-0 pt-8 md:pt-16 relative isolate overflow-y-auto overflow-x-hidden min-w-full h-screen pb-16 lg:pb-0
                px-6 sm:px-16 lg:flex lg:px-24"
                style="background-image:
                    radial-gradient(at -10% -10%, #008DD5, transparent 35%),
                    radial-gradient(at 110% 110%, #008DD5, transparent 35%);">
                <div class=" text-center  lg:flex lg:py-10 lg:my-auto lg:text-left items-center  w-full justify-between">
                    <h2
                        class=" text-left lg:max-w-md  font-bold tracking-tight text-white mb-5 md:mb-10 text-2xl md:text-6xl lg:text-3xl drop-shadow-[0_7px_7px_rgba(0,0,0,0.5)]">
                        8. Bagaimana pendapat Saudara tentang Kualitas sarana dan prasarana
                        ?<span class="block mt-3 normal-case font-semibold text-amber-200 text-base md:text-3xl lg:text-lg">(Pilih salah satu)</span></h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('penanganan')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="penanganan-a" name="u8" value="0"
                                class="hidden scroll-btn peer">
                            <label for="penanganan-a"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Buruk</div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="penanganan-b" name="u8" value="1"
                                class="hidden scroll-btn peer">
                            <label for="penanganan-b"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Buruk</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="penanganan-c" name="u8" value="2"
                                class="hidden scroll-btn peer">
                            <label for="penanganan-c"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Cukup</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="penanganan-d" name="u8" value="3"
                                class="hidden scroll-btn peer">
                            <label for="penanganan-d"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Baik</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="penanganan-e" name="u8" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="penanganan-e"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Baik
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li class="flex gap-3 mt-8 w-full">
                            <a type="button" onclick="window.location='#tujuh'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-white hover:bg-sky-100 text-[#0a3d7a] border-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label class="cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#sembilan'"
                                 class="flex-1 w-full mt-6 flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-[#0a3d7a] hover:bg-[#072c5a] text-white border-white/80">
                                <label class="cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="sembilan"
                class="lg:pt-0 pt-8 md:pt-16 relative isolate overflow-y-auto overflow-x-hidden min-w-full h-screen pb-16 lg:pb-0
                px-6 sm:px-16 lg:flex lg:px-24">
                <div class=" text-center  lg:flex lg:py-10 lg:my-auto lg:text-left items-center  w-full justify-between">
                    <h2
                        class=" text-left lg:max-w-md  font-bold tracking-tight text-white mb-5 md:mb-10 text-2xl md:text-6xl lg:text-3xl drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                        9.
                        Bagaimana pendapat Saudara tentang Penanganan Pengaduan pengguna layanan ?<span class="block mt-3 normal-case font-semibold text-amber-200 text-base md:text-3xl lg:text-lg">(Pilih salah satu)</span></h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('kesesuaian')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="kesesuaian-small" name="u9" value="0"
                                class="hidden scroll-btn peer">
                            <label for="kesesuaian-small"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Tidak Ada</div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="kesesuaian-big" name="u9" value="1"
                                class="hidden scroll-btn peer">
                            <label for="kesesuaian-big"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Ada Tetapi
                                        Tidak Berfungsi
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="kesesuaian-medium" name="u9" value="2"
                                class="hidden scroll-btn peer">
                            <label for="kesesuaian-medium"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  text-left font-semibold">
                                        Berfungsi
                                        Kurang Maksimal,
                                        Lambat
                                        Ditindaklanjuti</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="kesesuaian-aja" name="u9" value="3"
                                class="hidden scroll-btn peer">
                            <label for="kesesuaian-aja"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Dikelola Dengan
                                        Baik</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="kesesuaian-ad" name="u9" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="kesesuaian-ad"
                                class="inline-flex items-center justify-between gap-4 w-full p-3 md:p-5 lg:p-4 bg-white text-slate-800 border-2 border-white rounded-xl cursor-pointer shadow-md transition-colors duration-150 hover:bg-sky-100 peer-checked:bg-[#0a3d7a] peer-checked:text-white peer-checked:ring-4 peer-checked:ring-white/70 peer-checked:shadow-xl after:font-black after:text-xl md:after:text-6xl lg:after:text-2xl peer-checked:after:content-['\2713']">
                                <div class="block">
                                    <div class="w-full lg:text-xl  text-lg md:text-5xl  font-semibold">Sangat Dikelola
                                        dan Cepat
                                        Ditindaklanjuti</div>
                                </div>
                            </label>
                        </li>
                        <li class="flex gap-3 mt-8 w-full">
                            <a type="button" onclick="window.location='#delapan'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-white hover:bg-sky-100 text-[#0a3d7a] border-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label class="cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#saran'"
                                 class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-[#0a3d7a] hover:bg-[#072c5a] text-white border-white/80">
                                <label class="cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="saran"
                class="lg:pt-0 pt-8 md:pt-16 relative isolate overflow-y-auto overflow-x-hidden min-w-full h-screen pb-16 lg:pb-0
                px-6 sm:px-16 lg:flex lg:px-24"
                style="background-image:
                    radial-gradient(at -10% -10%, #008DD5, transparent 35%),
                    radial-gradient(at 110% 110%, #008DD5, transparent 35%);">
                <div class=" text-left  lg:py-10 lg:my-auto lg:text-left items-center  w-full justify-between">
                    <h2 class=" font-bold tracking-tight text-white drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] text-2xl md:text-6xl lg:text-3xl mb-4 md:mb-6">Saran
                        perbaikan, masukan dan harapan :</h2>
                    <textarea type="text" id="saran" name="saran"
                        class="block w-full p-4 pl-10 text-lg md:text-5xl lg:text-xl text-black border border-2 border-white rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 mb-4 md:mb-6"></textarea>
                    <button for="kesesuaian-ad" type="submit"
                        class="w-full font-bold p-3 md:p-6 lg:p-4 text-lg md:text-5xl lg:text-2xl text-white bg-[#0a3d7a] hover:bg-[#072c5a] border-2 border-white/80 rounded-2xl shadow-xl cursor-pointer mb-4">
                        KIRIM
                    </button>
                    <a type="button" onclick="window.location='#sembilan'"
                         class="flex-1 w-full flex items-center justify-center gap-3 cursor-pointer select-none rounded-2xl border-2 py-3 md:py-6 lg:py-3 shadow-xl transition-colors duration-150 lg:text-xl text-lg md:text-5xl font-bold bg-white hover:bg-sky-100 text-[#0a3d7a] border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-6 md:w-14 h-6 md:h-14 lg:w-7 lg:h-7">
                            <path fill-rule="evenodd"
                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                clip-rule="evenodd" />
                        </svg>
                        <label class="cursor-pointer">KEMBALI</label>

                    </a>
                </div>

            </div>
        </form>
    </div>

    <script>
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))

                return false;
            return true;
        }
        let btnCheck = document.querySelector('button');
        let input = document.querySelector('input');
        let btn1 = document.getElementById('btn1');
        let error_nik = document.getElementById('errornik');
        let error_nama = document.getElementById('errornama');
        let error_nohp = document.getElementById('errornohp');
        let error_alamat = document.getElementById('erroralamat');
        let error_keperluan = document.getElementById('errorkeperluan');
        let error_ktp = document.getElementById('errorktp');
        let fotoKtpInput = document.getElementById('foto_ktp');
        let fotoKtpPreview = document.getElementById('foto_ktp_preview');
        let fotoKtpPreviewWrapper = document.getElementById('foto_ktp_preview_wrapper');
        let fotoKtpName = document.getElementById('foto_ktp_name');
        var bnr = 0;

        // Isi ulang jawaban jika responden dikembalikan ke form (mis. validasi gagal)
        (function () {
            const oldInput = @json(session()->getOldInput());
            const setField = function (name, value) {
                document.querySelectorAll('[name="' + name + '"]').forEach(function (el) {
                    if (el.type === 'radio' || el.type === 'checkbox') {
                        el.checked = String(el.value).trim() === String(value).trim();
                    } else if (el.type !== 'file') {
                        el.value = value;
                    }
                });
            };
            Object.keys(oldInput || {}).forEach(function (key) {
                const value = oldInput[key];
                if (value !== null && typeof value === 'object') {
                    Object.keys(value).forEach(function (sub) { setField(key + '[' + sub + ']', value[sub]); });
                } else if (value !== null) {
                    setField(key, value);
                }
            });
        })();

        // Foto dari kamera HP biasanya 3-10 MB. Perkecil di browser (maks. sisi 1600px, JPEG)
        // supaya di bawah batas 2 MB dan tidak ditolak server.
        const MAKS_UKURAN = 2 * 1024 * 1024;
        function kompresFoto(file) {
            return new Promise(function (resolve) {
                if (!file.type.startsWith('image/') || typeof DataTransfer === 'undefined') return resolve(file);
                const url = URL.createObjectURL(file);
                const img = new Image();
                img.onload = function () {
                    URL.revokeObjectURL(url);
                    const skala = Math.min(1, 1600 / Math.max(img.width, img.height));
                    const canvas = document.createElement('canvas');
                    canvas.width = Math.round(img.width * skala);
                    canvas.height = Math.round(img.height * skala);
                    canvas.getContext('2d').drawImage(img, 0, 0, canvas.width, canvas.height);
                    canvas.toBlob(function (blob) {
                        if (!blob || blob.size >= file.size) return resolve(file);
                        const nama = file.name.replace(/\.[^.]+$/, '') + '.jpg';
                        resolve(new File([blob], nama, { type: 'image/jpeg' }));
                    }, 'image/jpeg', 0.8);
                };
                img.onerror = function () { URL.revokeObjectURL(url); resolve(file); };
                img.src = url;
            });
        }

        fotoKtpInput.addEventListener('change', async function(event) {
            let file = event.target.files && event.target.files[0];
            if (file && file.size > 500 * 1024 && !file.__dikompres) {
                const hasil = await kompresFoto(file);
                if (hasil !== file) {
                    hasil.__dikompres = true;
                    const dt = new DataTransfer();
                    dt.items.add(hasil);
                    fotoKtpInput.files = dt.files;
                    file = hasil;
                }
            }
            error_ktp.innerText = file && file.size > MAKS_UKURAN ? 'Ukuran foto maksimal 2 MB' : '';
            if (!file) {
                fotoKtpPreviewWrapper.classList.add('hidden');
                fotoKtpPreview.src = '';
                fotoKtpName.textContent = 'Nama file';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                fotoKtpPreview.src = e.target.result;
                fotoKtpPreviewWrapper.classList.remove('hidden');
                fotoKtpName.textContent = file.name;
                // pastikan tombol LANJUT tetap terlihat setelah preview muncul
                btn1.scrollIntoView({ behavior: 'smooth', block: 'end' });
            };
            reader.readAsDataURL(file);
        });

        btn1.addEventListener('click', () => {
            var validate = 0;
            var nik = document.getElementById('nik').value;
            var nama = document.getElementById('nama').value;
            var nohp = document.getElementById('nohp').value;
            var keperluan = document.getElementById('keperluan').value;
            var alamat = document.getElementById('alamat').value;
            var fotoKtp = document.getElementById('foto_ktp').files.length;

            error_nik.innerText = '';
            error_nama.innerText = '';
            error_nohp.innerText = '';
            error_alamat.innerText = '';
            error_keperluan.innerText = '';
            error_ktp.innerText = '';

            // NIK opsional: hanya dicek jika diisi
            if (nik.length > 0 && nik.length != 16) {
                error_nik.innerText = 'NIK harus 16 digit';
            } else {
                validate += 1;
            }

            if (nama.length == 0) {
                error_nama.innerText = 'Nama tidak boleh kosong';
            } else {
                validate += 1;
            }

            if (nohp.length == 0) {
                error_nohp.innerText = 'No Hp tidak boleh kosong';
            } else {
                nohp.length <= 11 ? error_nohp.innerText = 'No Hp minimal 11 angka' : validate += 1;
            }

            if (keperluan.length == 0) {
                error_keperluan.innerText = 'Keperluan tidak boleh kosong';
            } else {
                validate += 1;
            }

            if (alamat.length == 0) {
                error_alamat.innerText = 'Alamat tidak boleh kosong';
            } else {
                validate += 1;
            }

            // Foto KTP opsional: hanya dicek ukurannya jika ada file
            if (fotoKtp > 0 && document.getElementById('foto_ktp').files[0].size > 2 * 1024 * 1024) {
                error_ktp.innerText = 'Ukuran foto maksimal 2 MB';
            } else {
                validate += 1;
            }

            if (validate == 6) {
                window.location = '#kedua'
            } else {
                // arahkan ke pesan error pertama agar langsung terlihat
                const firstError = [error_nik, error_nama, error_nohp, error_alamat, error_keperluan, error_ktp]
                    .find((el) => el.innerText.trim() !== '');
                if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    </script>

    <script>
        var popup = document.getElementById("popup");

        function closePopup() {
            popup.classList.add('hidden');
        }
    </script>
</body>

</html>
