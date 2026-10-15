<?php

error_reporting(0);

$startDate = '2024-01-01';

$endDate = '2024-10-03';

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

$tu1 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u1');

$tu2 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u2');

$tu3 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u3');

$tu4 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u4');

$tu5 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u5');

$tu6 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u6');

$tu7 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u7');

$tu8 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u8');

$tu9 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u9');

$Ttl_Nilai_Unsur = $tu1 + $tu2 + $tu3 + $tu4 + $tu5 + $tu6 + $tu7 + $tu8 + $tu9;

$n = DB::table('2024')
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
    $nrr1 = sprintf('%0.3f', $tu1 / $n);
    $nrr2 = sprintf('%0.3f', $tu2 / $n);
    $nrr3 = sprintf('%0.3f', $tu3 / $n);
    $nrr4 = sprintf('%0.3f', $tu4 / $n);
    $nrr5 = sprintf('%0.3f', $tu5 / $n);
    $nrr6 = sprintf('%0.3f', $tu6 / $n);
    $nrr7 = sprintf('%0.3f', $tu7 / $n);
    $nrr8 = sprintf('%0.3f', $tu8 / $n);
    $nrr9 = sprintf('%0.3f', $tu9 / $n);

    $nrr = $nrr1 + $nrr2 + $nrr3 + $nrr4 + $nrr5 + $nrr6 + $nrr7 + $nrr8 + $nrr9;
    $nrr = sprintf('%0.3f', $nrr);

    $nrrt1 = sprintf('%0.3f', $nrr1 * (1/9));
    $nrrt2 = sprintf('%0.3f', $nrr2 * (1/9));
    $nrrt3 = sprintf('%0.3f', $nrr3 * (1/9));
    $nrrt4 = sprintf('%0.3f', $nrr4 * (1/9));
    $nrrt5 = sprintf('%0.3f', $nrr5 * (1/9));
    $nrrt6 = sprintf('%0.3f', $nrr6 * (1/9));
    $nrrt7 = sprintf('%0.3f', $nrr7 * (1/9));
    $nrrt8 = sprintf('%0.3f', $nrr8 * (1/9));
    $nrrt9 = sprintf('%0.3f', $nrr9 * (1/9));

    $nrrT = $nrrt1 + $nrrt2 + $nrrt3 + $nrrt4 + $nrrt5 + $nrrt6 + $nrrt7 + $nrrt8 + $nrrt9;
    $nrrT = sprintf('%0.3f', $nrrT);

    $nilaiSKM = $nrrT * 25;
}

?>

@extends('layouts.index', ['title' => 'Dashboard'])

@section('content')
    <div class="absolute top-0 left-[215px] right-2 bottom-2 p-2">
        <div class="bg-white h-full w-full rounded-xl p-4 shadow-sm border border-slate-200">
            <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-3 pb-4">
                <p class="text-[22px] lg:text-[28px] font-black text-[#008DD5] leading-tight">RESUME / NILAI UNSUR</p>

                <div class="flex flex-wrap items-center justify-end gap-3">
                    <?php
                    error_reporting(0);
                    if ($_GET['triwulan'] == '') {
                    } else {
                        $_SESSION['triwulan'] = $_GET['triwulan'];
                    }

                    if ($_GET['tw'] == '') {
                    } else {
                        $_SESSION['tw'] = $_GET['tw'];
                    }
                    ?>

                    <div class="flex items-center gap-2 rounded-full border border-[#008DD5] bg-slate-50 px-3 py-2">
                        <label class="text-sm font-bold text-[#008DD5]">Tahun</label>
                        <?php if($_GET['Tahun'] == ''){ ?>
                        <select
                            onChange="document.location.href='?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw=' + {{ $_GET['tw'] == null ? '2024' : $_GET['tw'] }} + '&Tahun=' + this.value"
                            class="bg-white border border-gray-300 text-[#008DD5] font-bold text-sm rounded-full px-3 py-1 focus:outline-none focus:ring-2 focus:ring-[#008DD5]/30">
                            <option value="2023" <?php if (date('Y') == '2023') echo 'selected'; ?>>2023</option>
                            <option value="2024" <?php if (date('Y') == '2024') echo 'selected'; ?>>2024</option>
                            <option value="2025" <?php if (date('Y') == '2025') echo 'selected'; ?>>2025</option>
                            <option value="2026" <?php if (date('Y') == '2026') echo 'selected'; ?>>2026</option>
                        </select>
                        <?php } else { ?>
                        <select
                            onChange="document.location.href='?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw=' + {{ $_GET['tw'] == null ? '2024' : $_GET['tw'] }} + '&Tahun=' + this.value"
                            class="bg-white border border-gray-300 text-[#008DD5] font-bold text-sm rounded-full px-3 py-1 focus:outline-none focus:ring-2 focus:ring-[#008DD5]/30">
                            <option value="2023" <?php if ($_GET['Tahun'] == '2023') echo 'selected'; ?>>2023</option>
                            <option value="2024" <?php if ($_GET['Tahun'] == '2024') echo 'selected'; ?>>2024</option>
                            <option value="2025" <?php if ($_GET['Tahun'] == '2025') echo 'selected'; ?>>2025</option>
                            <option value="2026" <?php if ($_GET['Tahun'] == '2026') echo 'selected'; ?>>2026</option>
                        </select>
                        <?php } ?>
                    </div>

                    <div class="flex items-center gap-2 rounded-full border border-[#008DD5] bg-slate-50 px-3 py-2">
                        <label class="text-sm font-bold text-[#008DD5]">Triwulan</label>
                        <?php if($_GET['tw'] == ''){ ?>
                        <select
                            onChange="document.location.href='?tw=' + this.value + '&Tahun=' + {{ $_GET['Tahun'] == null ? '2024' : $_GET['Tahun'] }}"
                            class="bg-white border border-gray-300 text-[#008DD5] font-bold text-sm rounded-full px-3 py-1 focus:outline-none focus:ring-2 focus:ring-[#008DD5]/30">
                            <option value="1" <?php if (date('m') == 1) echo 'selected'; ?>>Triwulan 1 (Jan, Feb, Mar)</option>
                            <option value="2" <?php if (date('m') == 2) echo 'selected'; ?>>Triwulan 2 (Apr, Mei, Jun)</option>
                            <option value="3" <?php if (date('m') == 3) echo 'selected'; ?>>Triwulan 2 (Jan s/d Jun)</option>
                            <option value="4" <?php if (date('m') == 4) echo 'selected'; ?>>Triwulan 3 (Jul, Agu, Sep)</option>
                            <option value="5" <?php if (date('m') == 5) echo 'selected'; ?>>Triwulan 3 (Jan s/d Sep)</option>
                            <option value="6" <?php if (date('m') == 6) echo 'selected'; ?>>Triwulan 4 (Okt, Nop, Des)</option>
                            <option value="7" <?php if (date('m') == 7) echo 'selected'; ?>>Triwulan 4 (Jan s/d Des)</option>
                        </select>
                        <?php } else { ?>
                        <select
                            onChange="document.location.href='?tw=' + this.value + '&Tahun=' + {{ $_GET['Tahun'] == null ? '2024' : $_GET['Tahun'] }}"
                            class="bg-white border border-gray-300 text-[#008DD5] font-bold text-sm rounded-full px-3 py-1 focus:outline-none focus:ring-2 focus:ring-[#008DD5]/30">
                            <option value="1" <?php if ($_GET['tw'] == 1) echo 'selected'; ?>>Triwulan 1 (Jan, Feb, Mar)</option>
                            <option value="2" <?php if ($_GET['tw'] == 2) echo 'selected'; ?>>Triwulan 2 (Apr, Mei, Jun)</option>
                            <option value="3" <?php if ($_GET['tw'] == 3) echo 'selected'; ?>>Triwulan 2 (Jan s/d Jun)</option>
                            <option value="4" <?php if ($_GET['tw'] == 4) echo 'selected'; ?>>Triwulan 3 (Jul, Agu, Sep)</option>
                            <option value="5" <?php if ($_GET['tw'] == 5) echo 'selected'; ?>>Triwulan 3 (Jan s/d Sep)</option>
                            <option value="6" <?php if ($_GET['tw'] == 6) echo 'selected'; ?>>Triwulan 4 (Okt, Nop, Des)</option>
                            <option value="7" <?php if ($_GET['tw'] == 7) echo 'selected'; ?>>Triwulan 4 (Jan s/d Des)</option>
                        </select>
                        <?php } ?>
                    </div>

                    <a href="/exportResume?jenkel={{ $_GET['jenkel'] }}&usia={{ $_GET['usia'] }}&pekerjaan={{ $_GET['pekerjaan'] }}&pendidikan={{ $_GET['pendidikan'] }}&tahun={{ $_GET['tahun'] }}"
                        class="inline-flex items-center justify-center bg-[#008DD5] hover:bg-[#0077b8] rounded-full font-bold text-sm px-4 py-2 text-white transition">
                        DOWNLOAD
                    </a>
                </div>
            </div>

            <div class="w-full">
                <div class="rounded-xl border border-[#008DD5] overflow-hidden">
                    <div class="overflow-auto max-h-[52vh]">
                        <table class="min-w-[820px] w-full border-collapse">
                            <thead class="sticky top-0 z-10" style="background-color: #008DD5; background-image: radial-gradient(at -30% -30%, #008DD5, transparent 80%), radial-gradient(at 130% 150%, #008DD5, transparent 80%);">
                                <tr>
                                    <th scope="col" rowspan="2" class="px-3 py-3 w-[90px] text-center text-[11px] font-semibold text-white uppercase border border-[#008DD5]">No.<br>Responden</th>
                                    <th scope="col" colspan="10" class="px-3 py-2 text-center text-[11px] font-semibold text-white uppercase border border-[#008DD5]">Nilai Unsur Pelayanan</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-2 py-2 w-[70px] text-center text-[11px] font-semibold text-white uppercase border border-[#008DD5]">U1</th>
                                    <th scope="col" class="px-2 py-2 w-[70px] text-center text-[11px] font-semibold text-white uppercase border border-[#008DD5]">U2</th>
                                    <th scope="col" class="px-2 py-2 w-[70px] text-center text-[11px] font-semibold text-white uppercase border border-[#008DD5]">U3</th>
                                    <th scope="col" class="px-2 py-2 w-[70px] text-center text-[11px] font-semibold text-white uppercase border border-[#008DD5]">U4</th>
                                    <th scope="col" class="px-2 py-2 w-[70px] text-center text-[11px] font-semibold text-white uppercase border border-[#008DD5]">U5</th>
                                    <th scope="col" class="px-2 py-2 w-[70px] text-center text-[11px] font-semibold text-white uppercase border border-[#008DD5]">U6</th>
                                    <th scope="col" class="px-2 py-2 w-[70px] text-center text-[11px] font-semibold text-white uppercase border border-[#008DD5]">U7</th>
                                    <th scope="col" class="px-2 py-2 w-[70px] text-center text-[11px] font-semibold text-white uppercase border border-[#008DD5]">U8</th>
                                    <th scope="col" class="px-2 py-2 w-[70px] text-center text-[11px] font-semibold text-white uppercase border border-[#008DD5]">U9</th>
                                    <th scope="col" class="px-2 py-2 w-[90px] text-center text-[11px] font-semibold text-white uppercase border border-[#008DD5]">Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1; ?>
                                @forelse($selects as $data)
                                    <tr class="{{ $row % 2 == 0 ? 'bg-[#E3E3E3]' : 'bg-white' }}">
                                        <td class="px-3 py-2 text-center text-sm font-medium text-slate-700 border border-slate-200">{{ $row++ }}</td>
                                        <td class="px-3 py-2 text-center text-sm font-medium text-slate-700 border border-slate-200">{{ $data->u1 }}</td>
                                        <td class="px-3 py-2 text-center text-sm font-medium text-slate-700 border border-slate-200">{{ $data->u2 }}</td>
                                        <td class="px-3 py-2 text-center text-sm font-medium text-slate-700 border border-slate-200">{{ $data->u3 }}</td>
                                        <td class="px-3 py-2 text-center text-sm font-medium text-slate-700 border border-slate-200">{{ $data->u4 }}</td>
                                        <td class="px-3 py-2 text-center text-sm font-medium text-slate-700 border border-slate-200">{{ $data->u5 }}</td>
                                        <td class="px-3 py-2 text-center text-sm font-medium text-slate-700 border border-slate-200">{{ $data->u6 }}</td>
                                        <td class="px-3 py-2 text-center text-sm font-medium text-slate-700 border border-slate-200">{{ $data->u7 }}</td>
                                        <td class="px-3 py-2 text-center text-sm font-medium text-slate-700 border border-slate-200">{{ $data->u8 }}</td>
                                        <td class="px-3 py-2 text-center text-sm font-medium text-slate-700 border border-slate-200">{{ $data->u9 }}</td>
                                        <td class="px-3 py-2 text-center text-sm font-medium text-slate-700 border border-slate-200"></td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-3 rounded-xl border border-[#008DD5] overflow-hidden">
                    <table class="min-w-[820px] w-full border-collapse">
                        <thead style="background-color: #008DD5; background-image: radial-gradient(at -30% -30%, #008DD5, transparent 100%), radial-gradient(at 130% 150%, #008DD5, transparent 100%);">
                            <tr class="text-white">
                                <td class="px-3 py-2 text-left text-sm font-semibold border border-[#008DD5]">Total Nilai Unsur</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $tu1 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $tu2 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $tu3 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $tu4 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $tu5 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $tu6 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $tu7 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $tu8 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $tu9 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $Ttl_Nilai_Unsur }}</td>
                            </tr>
                            <tr class="text-white">
                                <td class="px-3 py-2 text-left text-sm font-semibold border border-[#008DD5]">NRR Per Unsur</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrr1 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrr2 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrr3 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrr4 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrr5 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrr6 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrr7 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrr8 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrr9 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrr }}</td>
                            </tr>
                            <tr class="text-white">
                                <td class="px-3 py-2 text-left text-sm font-semibold border border-[#008DD5]">NRR Tertimbang</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrrt1 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrrt2 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrrt3 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrrt4 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrrt5 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrrt6 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrrt7 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrrt8 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrrt9 }}</td>
                                <td class="px-3 py-2 text-center text-sm font-semibold border border-[#008DD5]">{{ $nrrT }}</td>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $selects->links() }}
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.12.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
