<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Session;
use App\Models\NilaiUnsur;


class NilaiUnsurController extends Controller
{
    public function index()
    {
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
}        $selects = DB::table('2024')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->paginate(10);

        if($_GET['Tahun']==2023 ){
            $selects = DB::table('2023')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->paginate(10);}

        return view('NilaiUnsur.index', compact('selects'));
    }


    public function cariNilaiUnsur(Request $request)
    {
        $keyword = $request->search;
        $datas = NilaiUnsur::where('nilaiUnsur', 'like', "%" . 'like', "%" . $keyword . "%");
        return view('nilaiUnsur.index', compact('datas'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('Nilai.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
     {
        // echo ("request");
        // return $request->post();
        // return $request->jenkel['jenkel'];

        $this->validate($request, [
            'nik' => 'nullable|digits:16',
            'nama' => 'required',
            'jenisPelayanan' => 'required',
            'nohp' => 'required',
            'keperluan' => 'required',
            'jenkel' => 'required',
            'alamat' => 'required',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'usia' => 'required',
            'u1' => 'required',
            'u2' => 'required',
            'u3' => 'required',
            'u4' => 'required',
            'u5' => 'required',
            'u6' => 'required',
            'u7' => 'required',
            'u8' => 'required',
            'u9' => 'required',
            'saran' => 'required',
        ], [
            'nik.digits' => 'NIK harus 16 digit angka.',
            'foto_ktp.image' => 'Foto KTP harus berupa gambar.',
            'foto_ktp.mimes' => 'Foto KTP harus berformat JPG atau PNG.',
            'foto_ktp.max' => 'Ukuran foto KTP maksimal 2 MB.',
            'foto_ktp.uploaded' => 'Foto KTP gagal diupload, kemungkinan ukurannya terlalu besar.',
            'saran.required' => 'Saran, masukan dan harapan wajib diisi.',
            'required' => 'Kolom :attribute wajib diisi.',
        ]);


        $data = new NilaiUnsur();

        // $data->nm_kelas = $request->nm_kelas;
        // $data->ket = $request->ket;
        // $data->save();
        // return redirect()->back();

        try {
            $fotoKtpPath = null;
            if ($request->hasFile('foto_ktp')) {
                $fotoKtpPath = $request->file('foto_ktp')->store('ktp', 'public');
            }

            $store = NilaiUnsur::create([
                'jenisPelayanan' => $request->jenisPelayanan,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'keperluan' => $request->keperluan,
                'foto_ktp' => $fotoKtpPath,
                'pekerjaan' => $request->pekerjaan,
                'jenkel' => $request->jenkel['jenkel'],
                'usia' => $request->usia,
                'nohp' => $request->nohp,
                'pendidikan' => $request->pendidikan,
                'nik' => $request->filled('nik') ? $request->nik : null, // NIK opsional
                'u1' => $request->u1,
                'u2' => $request->u2,
                'u3' => $request->u3,
                'u4' => $request->u4,
                'u5' => $request->u5,
                'u6' => $request->u6,
                'u7' => $request->u7,
                'u8' => $request->u8,
                'u9' => $request->u9,
                'saran' => $request->saran,
            ]);
        } catch (\Throwable $e) {
            // catat ke storage/logs/laravel.log, lalu kembalikan responden ke form dengan pesan
            report($e);

            return redirect('/skm')
                ->withInput($request->except(['_token', 'foto_ktp']))
                ->with('error', 'Maaf, survei gagal disimpan karena gangguan pada server. Silakan coba kirim lagi.');
        }

        // setelah berhasil, langsung ke halaman hasil SKM
        return redirect('/hasil-skm')->with('success', 'Terima kasih, survei Anda berhasil dikirim.');
    }

    /**
     * edit
     *
     * @param  mixed $NilaiUnsur
     * @return void
     */
    public function edit(request $request)
    {
        // echo ($request->jenis);
        $datas = NilaiUnsur::latest()->when(request()->search, function ($data_dasars) {
            $data_dasars = $data_dasars->where('id', 'like', '%' . request()->id_nilaiUnsur . '%');
        })
            ->where('id', $_GET['id_nilaiUnsur'])
            ->get();

        return view('Nilai.detail', compact('datas'));
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $NilaiUnsur = NilaiUnsur::findOrFail($id);
        $NilaiUnsur->delete();

        if ($NilaiUnsur) {
            //redirect dengan pesan sukses
            return redirect()->route('NilaiUnsur.index')->with(['pesan' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('NilaiUnsur.index')->with(['pesan' => 'Data Gagal Dihapus!']);
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $NilaiUnsur
     * @return void
     */
    public function update(Request $request, NilaiUnsur $NilaiUnsur)
    {
        // print_r($request->post());
        $NilaiUnsur->update([
            'nm_nilaiUnsur' => $request->nm_nilaiUnsur,
            'ket' => $request->ket,
        ]);

        return redirect()->route('NilaiUnsur.index');
    }
}
