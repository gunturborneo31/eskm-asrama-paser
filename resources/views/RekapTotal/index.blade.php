<?php

error_reporting(0);

$startDate = '2024-01-01';

$endDate = '2024-10-03';

$table = ($tahun == 2023) ? '2023' : '2024';

if ($_GET['tw'] == null) {
    $today = date('Y-m-d', strtotime('+1 days'));
    $endDate = $today;
} elseif ($_GET['tw'] == 1) {
    $startDate = $_GET['Tahun'] . '-01-01';
    $endDate = $_GET['Tahun'] . '-03-31';
} elseif ($_GET['tw'] == 2) {
    $startDate = $_GET['Tahun'] . '-04-01';
    $endDate = $_GET['Tahun'] . '-06-31';
} elseif ($_GET['tw'] == 3) {
    $startDate = $_GET['Tahun'] . '-01-01';
    $endDate = $_GET['Tahun'] . '-06-31';
} elseif ($_GET['tw'] == 4) {
    $startDate = $_GET['Tahun'] . '-07-01';
    $endDate = $_GET['Tahun'] . '-09-31';
} elseif ($_GET['tw'] == 5) {
    $startDate = $_GET['Tahun'] . '-01-01';
    $endDate = $_GET['Tahun'] . '-09-31';
} elseif ($_GET['tw'] == 6) {
    $startDate = $_GET['Tahun'] . '-10-01';
    $endDate = $_GET['Tahun'] . '-12-31';
} elseif ($_GET['tw'] == 7) {
    $startDate = $_GET['Tahun'] . '-01-01';
    $endDate = $_GET['Tahun'] . '-12-31';
}

$tu1 = DB::table($table)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u1');

$tu2 = DB::table($table)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u2');

$tu3 = DB::table($table)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u3');

$tu4 = DB::table($table)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u4');

$tu5 = DB::table($table)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u5');

$tu6 = DB::table($table)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u6');

$tu7 = DB::table($table)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u7');

$tu8 = DB::table($table)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u8');

$tu9 = DB::table($table)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u9');

$Ttl_Nilai_Unsur = $tu1 + $tu2 + $tu3 + $tu4 + $tu5 + $tu6 + $tu7 + $tu8 + $tu9;

$n = DB::table($table)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

if ($n == 0) {
    $nrr1 = 0;
    $nrr2 = 0;
    $nrr3 = 0;
    $nrr4 = 0;
    $nrr5 = 0;
    $nrr6 = 0;
    $nrr7 = 0;
    $nrr8 = 0;
    $nrr9 = 0;

    $nrr = 0;
    $nrr = 0;

    $nrrt1 = 0;
    $nrrt2 = 0;
    $nrrt3 = 0;
    $nrrt4 = 0;
    $nrrt5 = 0;
    $nrrt6 = 0;
    $nrrt7 = 0;
    $nrrt8 = 0;
    $nrrt9 = 0;

    $nrrT = 0;
    $nrrT = 0;

    $nilaiSKM = $nrrT * 25;
} else {
    $nrr1 = sprintf('%0.2f', $tu1 / $n);
    $nrr2 = sprintf('%0.2f', $tu2 / $n);
    $nrr3 = sprintf('%0.2f', $tu3 / $n);
    $nrr4 = sprintf('%0.2f', $tu4 / $n);
    $nrr5 = sprintf('%0.2f', $tu5 / $n);
    $nrr6 = sprintf('%0.2f', $tu6 / $n);
    $nrr7 = sprintf('%0.2f', $tu7 / $n);
    $nrr8 = sprintf('%0.2f', $tu8 / $n);
    $nrr9 = sprintf('%0.2f', $tu9 / $n);

    $nrr = $nrr1 + $nrr2 + $nrr3 + $nrr4 + $nrr5 + $nrr6 + $nrr7 + $nrr8 + $nrr9;
    $nrr = sprintf('%0.2f', $nrr);

    $nrrt1 = sprintf('%0.2f', $nrr1 * (1/9));
    $nrrt2 = sprintf('%0.2f', $nrr2 * (1/9));
    $nrrt3 = sprintf('%0.2f', $nrr3 * (1/9));
    $nrrt4 = sprintf('%0.2f', $nrr4 * (1/9));
    $nrrt5 = sprintf('%0.2f', $nrr5 * (1/9));
    $nrrt6 = sprintf('%0.2f', $nrr6 * (1/9));
    $nrrt7 = sprintf('%0.2f', $nrr7 * (1/9));
    $nrrt8 = sprintf('%0.2f', $nrr8 * (1/9));
    $nrrt9 = sprintf('%0.2f', $nrr9 * (1/9));

    $nrrT = $nrrt1 + $nrrt2 + $nrrt3 + $nrrt4 + $nrrt5 + $nrrt6 + $nrrt7 + $nrrt8 + $nrrt9;
    $nrrT = sprintf('%0.2f', $nrrT);

    $nilaiSKM = $nrrT * 25;
}

?>

@extends('layouts.index', ['title' => 'Dashboard'])

@section('content')
    <div class="absolute top-0 left-[215px] h-screen w-10/12 p-2">
        <div class="bg-white h-full w-full rounded-xl p-3  mb-2">
            <div class="flex w-full justify-between items-center -mt-3">
                <p class="text-[25px] font-black text-[#008DD5]">RESUME </p>
                <div class="flex w-full flex-wrap items-center justify-between gap-3 py-4">
                    <div class="flex items-center gap-3 flex-wrap">
                        <label class="text-[#008DD5] font-bold text-sm">Cari</label>
                        <form method="GET" action="{{ url('/rekapTotal') }}" class="flex items-center gap-2 flex-wrap">
                            <input type="hidden" name="jenkel" value="{{ $_GET['jenkel'] ?? 1 }}">
                            <input type="hidden" name="usia" value="{{ $_GET['usia'] ?? 1 }}">
                            <input type="hidden" name="pekerjaan" value="{{ $_GET['pekerjaan'] ?? 1 }}">
                            <input type="hidden" name="pendidikan" value="{{ $_GET['pendidikan'] ?? 1 }}">
                            <input type="hidden" name="tw" value="{{ $_GET['tw'] ?? '' }}">
                            <input type="hidden" name="Tahun" value="{{ $_GET['Tahun'] ?? date('Y') }}">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama / NIK"
                                class="rounded-full border border-gray-300 bg-white px-3 py-1.5 text-sm text-slate-700 focus:border-[#008DD5] focus:outline-none">
                            <button type="submit" class="rounded-full bg-[#008DD5] px-3 py-1.5 text-xs font-bold text-white">
                                Cari
                            </button>
                        </form>
                    </div>

                        {{-- Filter Status Badge --}}
                        <div class="flex items-center gap-2 flex-wrap bg-gray-50 px-3 py-2 rounded-lg border border-gray-200">
                            @if(isset($_GET['jenkel']) && $_GET['jenkel'] == 0)
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">Jenis Kelamin: Filter Aktif</span>
                            @endif
                            @if(isset($_GET['usia']) && $_GET['usia'] == 0)
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Usia: Filter Aktif</span>
                            @endif
                            @if(isset($_GET['pekerjaan']) && $_GET['pekerjaan'] == 0)
                                <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2.5 py-0.5 rounded">Pekerjaan: Filter Aktif</span>
                            @endif
                            @if(isset($_GET['pendidikan']) && $_GET['pendidikan'] == 0)
                                <span class="bg-orange-100 text-orange-800 text-xs font-semibold px-2.5 py-0.5 rounded">Pendidikan: Filter Aktif</span>
                            @endif
                            @if(!isset($_GET['jenkel']) || ($_GET['jenkel'] == 1 && $_GET['usia'] == 1 && $_GET['pekerjaan'] == 1 && $_GET['pendidikan'] == 1))
                                <span class="text-gray-500 text-xs">Tidak ada filter aktif</span>
                            @endif
                        </div>
                    

                    <div class="flex items-center gap-3 flex-wrap">
                        <div class="flex flex-row items-center gap-2">
                            <label for="countries" class="font-bold text-[#008DD5] text-sm">Filter</label>
                            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                                class="flex items-center bg-white border border-gray-300 text-[#008DD5] font-bold text-sm rounded-full px-5 py-1"
                                type="button">Pilih <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>

                            <div id="dropdown"
                                class="z-10 hidden border bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                <ul class="py-2 text-sm text-gray-700"
                                    aria-labelledby="dropdownDefaultButton">
                                    <li>
                                        <a href="/rekapTotal?jenkel={{ $_GET['jenkel'] == 0 ? 1 : 0 }}&usia={{ $_GET['usia'] }}&pekerjaan={{ $_GET['pekerjaan'] }}&pendidikan={{ $_GET['pendidikan'] }}&tahun={{ $_GET['tahun'] }}"
                                            class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                                            <p>Jenis kelamin</p>
                                            <svg data-slot="icon" aria-hidden="true" fill="none" stroke-width="4"
                                                stroke="currentColor" viewBox="0 0 24 24" class="w-3 h-3 "
                                                {{ $_GET['jenkel'] == 0 ? 'hidden' : '' }}
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="m4.5 12.75 6 6 9-13.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/rekapTotal?jenkel={{ $_GET['jenkel'] }}&usia={{ $_GET['usia'] == 0 ? 1 : 0 }}&pekerjaan={{ $_GET['pekerjaan'] }}&pendidikan={{ $_GET['pendidikan'] }}&tahun={{ $_GET['tahun'] }}"
                                            class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                                            <p>Usia</p>
                                            <svg data-slot="icon" aria-hidden="true" fill="none" stroke-width="4"
                                                stroke="currentColor" viewBox="0 0 24 24" class="w-3 h-3 "
                                                {{ $_GET['usia'] == 0 ? 'hidden' : '' }}
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="m4.5 12.75 6 6 9-13.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/rekapTotal?jenkel={{ $_GET['jenkel'] }}&usia={{ $_GET['usia'] }}&pekerjaan={{ $_GET['pekerjaan'] == 0 ? 1 : 0 }}&pendidikan={{ $_GET['pendidikan'] }}&tahun={{ $_GET['tahun'] }}"
                                            class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                                            <p>Pekerjaan</p>
                                            <svg data-slot="icon" aria-hidden="true" fill="none" stroke-width="4"
                                                stroke="currentColor" viewBox="0 0 24 24" class="w-3 h-3 "
                                                {{ $_GET['pekerjaan'] == 0 ? 'hidden' : '' }}
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="m4.5 12.75 6 6 9-13.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/rekapTotal?jenkel={{ $_GET['jenkel'] }}&usia={{ $_GET['usia'] }}&pekerjaan={{ $_GET['pekerjaan'] }}&pendidikan={{ $_GET['pendidikan'] == 0 ? 1 : 0 }}"
                                            class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                                            <p>Pendidikan</p>
                                            <svg data-slot="icon" aria-hidden="true" fill="none" stroke-width="4"
                                                stroke="currentColor" viewBox="0 0 24 24" class="w-3 h-3 "
                                                {{ $_GET['pendidikan'] == 0 ? 'hidden' : '' }}
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="m4.5 12.75 6 6 9-13.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="flex flex-row items-center gap-2">
                            <label for="countries" class="font-bold text-[#008DD5] text-sm">Tahun</label>
                            <?php if($_GET['Tahun'] == ''){ ?>
                            <select id="countries" id="language"
                                onChange="document.location.href='?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw=' + {{ $_GET['tw'] == null ? '2024' : $_GET['tw'] }} + '&Tahun=' + this.value   "
                                class="bg-white border border-gray-300 text-[#008DD5] font-bold text-sm w-[150px] text-center rounded-full px-3 py-1">
                                <option value="2023" <?php if (date('Y') == '2023') { echo 'selected'; } ?>>2023</option>
                                <option value="2024" <?php if (date('Y') == '2024') { echo 'selected'; } ?>>2024</option>
                                <option value="2025" <?php if (date('Y') == '2025') { echo 'selected'; } ?>>2025</option>
                                <option value="2026" <?php if (date('Y') == '2026') { echo 'selected'; } ?>>2026</option>
                            </select>
                            <?php  } else {?>
                            <select id="countries" id="language"
                                onChange="document.location.href='?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw=' + {{ $_GET['tw'] == null ? '2024' : $_GET['tw'] }} + '&Tahun=' + this.value   "
                                class="bg-white border border-gray-300 text-[#008DD5] font-bold text-sm w-[150px] text-center rounded-full px-3 py-1">
                                <option value="2023" <?php if ($_GET['Tahun'] == '2023') { echo 'selected'; } ?>>2023</option>
                                <option value="2024" <?php if ($_GET['Tahun'] == '2024') { echo 'selected'; } ?>>2024</option>
                                <option value="2025" <?php if ($_GET['Tahun'] == '2025') { echo 'selected'; } ?>>2025</option>
                                <option value="2026" <?php if ($_GET['Tahun'] == '2026') { echo 'selected'; } ?>>2026</option>
                            </select>
                            <?php }?>
                        </div>

                        <div class="flex flex-row items-center gap-2">
                            <label for="countries" class="font-bold text-[#008DD5] text-sm">Triwulan</label>
                            <?php if($_GET['tw'] == ''){ ?>
                            <select id="countries" id="language"
                                onChange="document.location.href='?tw=' + this.value + '&Tahun=' + {{ $_GET['Tahun'] == null ? '2024' : $_GET['Tahun'] }} "
                                class="bg-white border border-gray-300 text-[#008DD5] font-bold text-sm w-[200px] text-center rounded-full px-3 py-1">
                                <option value="1" <?php if (date('m') == 1) { echo 'selected'; } ?>>Triwulan 1 (Jan, Feb, Mar)</option>
                                <option value="2" <?php if (date('m') == 2) { echo 'selected'; } ?>>Triwulan 2 (Apr, Mei, Jun)</option>
                                <option value="3" <?php if (date('m') == 3) { echo 'selected'; } ?>>Triwulan 2 (Jan s/d Jun)</option>
                                <option value="4" <?php if (date('m') == 4) { echo 'selected'; } ?>>Triwulan 3 (Jul, Agu, Sep)</option>
                                <option value="5" <?php if (date('m') == 5) { echo 'selected'; } ?>>Triwulan 3 (Jan s/d Sep)</option>
                                <option value="6" <?php if (date('m') == 6) { echo 'selected'; } ?>>Triwulan 4 (Okt, Nop, Des)</option>
                                <option value="7" <?php if (date('m') == 7) { echo 'selected'; } ?>>Triwulan 4 (Jan s/d Des)</option>
                            </select>
                            <?php  } else {?>
                            <select id="countries" id="language"
                                onChange="document.location.href='?tw=' + this.value + '&Tahun=' + {{ $_GET['Tahun'] == null ? '2024' : $_GET['Tahun'] }}"
                                class="bg-white border border-gray-300 text-[#008DD5] font-bold text-sm w-[200px] text-center rounded-full px-3 py-1">
                                <option value="1" <?php if ($_GET['tw'] == 1) { echo 'selected'; } ?>>Triwulan 1 (Jan, Feb, Mar)</option>
                                <option value="2" <?php if ($_GET['tw'] == 2) { echo 'selected'; } ?>>Triwulan 2 (Apr, Mei, Jun)</option>
                                <option value="3" <?php if ($_GET['tw'] == 3) { echo 'selected'; } ?>>Triwulan 2 (Jan s/d Jun)</option>
                                <option value="4" <?php if ($_GET['tw'] == 4) { echo 'selected'; } ?>>Triwulan 3 (Jul, Agu, Sep)</option>
                                <option value="5" <?php if ($_GET['tw'] == 5) { echo 'selected'; } ?>>Triwulan 3 (Jan s/d Sep)</option>
                                <option value="6" <?php if ($_GET['tw'] == 6) { echo 'selected'; } ?>>Triwulan 4 (Okt, Nop, Des)</option>
                                <option value="7" <?php if ($_GET['tw'] == 7) { echo 'selected'; } ?>>Triwulan 4 (Jan s/d Des)</option>
                            </select>
                            <?php }?>
                        </div>

                        <a href="/exportResume?jenkel={{ $_GET['jenkel'] }}&usia={{ $_GET['usia'] }}&pekerjaan={{ $_GET['pekerjaan'] }}&pendidikan={{ $_GET['pendidikan'] }}&tahun={{ $_GET['Tahun'] }}"
                            class="py-1 text-center items-center bg-[#008DD5] rounded-full font-bold text-sm px-3 text-white"
                            style="font-family:'Roboto'">
                            <p>DOWNLOAD</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full">
                <div class="-m-1.5">
                    <div class="p-1.5">
                        <div class="overflow-hidden rounded-xl border border-[#008DD5] shadow-sm">
                            <div class="max-h-[calc(100vh-290px)] overflow-auto">
                                <table class="min-w-full border-collapse text-left text-xs text-slate-700">
                                <thead class="sticky top-0 z-10"
                                    style="background-color: #008DD5; background-image: radial-gradient(at -30% -30%, #008DD5, transparent 80%), radial-gradient(at 130% 150%, #008DD5, transparent 80%);">
                                    <tr>
                                        <th scope="col" rowspan="2"
                                            class="min-w-[72px] px-3 py-3 text-center text-[10px] font-bold uppercase tracking-wide text-white">
                                            No.<br>Responden
                                        </th>
                                        <th scope="col" rowspan="2"
                                            class="min-w-[120px] px-3 py-3 text-center text-[10px] font-bold uppercase tracking-wide text-white">
                                            NIK
                                        </th>
                                        <th scope="col" rowspan="2"
                                            class="min-w-[80px] px-3 py-3 text-center text-[10px] font-bold uppercase tracking-wide text-white">
                                            KTP
                                        </th>
                                        <th scope="col" rowspan="2"
                                            class="min-w-[180px] px-3 py-3 text-center text-[10px] font-bold uppercase tracking-wide text-white">
                                            Nama
                                        </th>
                                        <th scope="col" rowspan="2"
                                            class="min-w-[150px] px-3 py-3 text-center text-[10px] font-bold uppercase tracking-wide text-white">
                                            Alamat
                                        </th>
                                        <th scope="col" rowspan="2"
                                            class="min-w-[120px] px-3 py-3 text-center text-[10px] font-bold uppercase tracking-wide text-white">
                                            No. HP
                                        </th>
                                        <th scope="col" rowspan="2"
                                            class="min-w-[120px] px-3 py-3 text-center text-[10px] font-bold uppercase tracking-wide text-white {{ $_GET['jenkel'] == 0 ? 'hidden' : '' }}">
                                            Jenis<br>Kelamin
                                        </th>
                                        <th scope="col" rowspan="2"
                                            class="min-w-[90px] px-3 py-3 text-center text-[10px] font-bold uppercase tracking-wide text-white {{ $_GET['usia'] == 0 ? 'hidden' : '' }}">
                                            Usia
                                        </th>
                                        <th scope="col" rowspan="2"
                                            class="min-w-[140px] px-3 py-3 text-center text-[10px] font-bold uppercase tracking-wide text-white {{ $_GET['pekerjaan'] == 0 ? 'hidden' : '' }}">
                                            Pekerjaan
                                        </th>
                                        <th scope="col" rowspan="2"
                                            class="min-w-[140px] px-3 py-3 text-center text-[10px] font-bold uppercase tracking-wide text-white {{ $_GET['pendidikan'] == 0 ? 'hidden' : '' }}">
                                            Pendidikan
                                        </th>
                                        <th scope="col" colspan="9"
                                            class="px-3 py-2 text-center text-[10px] font-bold uppercase tracking-wide text-white">
                                            Nilai Unsur Pelayanan
                                        </th>
                                        <th scope="col" rowspan="2"
                                            class="min-w-[200px] px-3 py-3 text-center text-[10px] font-bold uppercase tracking-wide text-white">
                                            Saran
                                        </th>
                                        <th scope="col" rowspan="2"
                                            class="min-w-[70px] px-3 py-3 text-center text-[10px] font-bold uppercase tracking-wide text-white">
                                            Aksi
                                        </th>
                                    </tr>
                                    <tr>
                                        @foreach(['U1','U2','U3','U4','U5','U6','U7','U8','U9'] as $u)
                                            <th scope="col"
                                                class="min-w-[64px] px-2 py-2 text-center text-[10px] font-bold uppercase tracking-wide text-white">
                                                {{ $u }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>

                                <tbody class="bg-white">
                                    <?php $row = 1; ?>
                                    @forelse($selects as $data)
                                        <tr class="{{ $row % 2 == 0 ? 'bg-[#E3E3E3]' : 'bg-white' }} align-middle">
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700">
                                                {{ $row++ }}
                                            </td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700">
                                                {{ $data->nik }}
                                            </td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700">
                                                @if($data->foto_ktp)
                                                    <button type="button" onclick="openKtpModal('{{ asset('storage/' . $data->foto_ktp) }}', '{{ $data->nama }}')"
                                                        class="inline-flex items-center justify-center px-2 py-1 rounded bg-blue-500 text-white hover:bg-blue-600 transition text-[10px] font-bold">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                        View
                                                    </button>
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-left text-[11px] font-medium text-slate-700">
                                                {{ $data->nama }}
                                            </td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-left text-[11px] font-medium text-slate-700">
                                                {{ $data->alamat ?? '-' }}
                                            </td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700">
                                                {{ $data->nohp ?? '-' }}
                                            </td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700 {{ $_GET['jenkel'] == 0 ? 'hidden' : '' }}">
                                                {{ $data->jenkel }}
                                            </td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700 {{ $_GET['usia'] == 0 ? 'hidden' : '' }}">
                                                {{ $data->usia }}
                                            </td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700 {{ $_GET['pekerjaan'] == 0 ? 'hidden' : '' }}">
                                                {{ $data->pekerjaan }}
                                            </td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700 {{ $_GET['pendidikan'] == 0 ? 'hidden' : '' }}">
                                                {{ $data->pendidikan }}
                                            </td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700">{{ $data->u1 }}</td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700">{{ $data->u2 }}</td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700">{{ $data->u3 }}</td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700">{{ $data->u4 }}</td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700">{{ $data->u5 }}</td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700">{{ $data->u6 }}</td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700">{{ $data->u7 }}</td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700">{{ $data->u8 }}</td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700">{{ $data->u9 }}</td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-left text-[11px] font-medium text-slate-700">
                                                {{ $data->saran ?? '-' }}
                                            </td>
                                            <td class="border-b border-gray-200 px-2 py-2 text-center text-[11px] font-medium text-slate-700">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('rekapTotal.destroy', $data->id) }}"
                                                    method="POST" class="flex justify-center">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex h-8 w-8 items-center justify-center rounded-full text-slate-600 transition hover:bg-red-100 hover:text-red-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12" class="px-4 py-8 text-center text-sm text-slate-500">
                                                Data tidak tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mt-2">
                            {{ $selects->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.12.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
        
        function openKtpModal(imageUrl, responderName) {
            const modal = document.getElementById('ktpModal');
            const ktpImage = document.getElementById('ktpImage');
            const responderNameEl = document.getElementById('responderName');
            
            ktpImage.src = imageUrl;
            responderNameEl.textContent = responderName;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        
        function closeKtpModal() {
            const modal = document.getElementById('ktpModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>

    <!-- KTP Modal Popup -->
    <div id="ktpModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full">
            <div class="flex justify-between items-center border-b p-4">
                <h3 class="text-lg font-bold text-gray-900">
                    Foto KTP - <span id="responderName"></span>
                </h3>
                <button onclick="closeKtpModal()" class="text-gray-500 hover:text-gray-700 text-2xl">×</button>
            </div>
            <div class="p-4 flex justify-center bg-gray-50">
                <img id="ktpImage" src="" alt="KTP" class="max-h-96 object-contain rounded">
            </div>
            <div class="flex justify-end gap-2 border-t p-4">
                <button onclick="closeKtpModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Tutup
                </button>
            </div>
        </div>
    </div>
@endsection
