<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use App\Models\NilaiUnsur;


class RekapTotalController extends Controller
{
   public function index(Request $request)
    {
       error_reporting(0);

       $tahun = $request->input('Tahun') ?? date('Y');
       $tw = $request->input('tw');
       $search = trim((string) $request->input('search', ''));

       $startDate = '2024-01-01';
       $endDate = '2024-10-03';

       if ($tw == null) {
           $today = date('Y-m-d', strtotime('+1 days'));
           $endDate = $today;
       } elseif ($tw == 1) {
           $startDate = $tahun . '-01-01';
           $endDate = $tahun . '-03-31';
       } elseif ($tw == 2) {
           $startDate = $tahun . '-04-01';
           $endDate = $tahun . '-06-31';
       } elseif ($tw == 3) {
           $startDate = $tahun . '-01-01';
           $endDate = $tahun . '-06-31';
       } elseif ($tw == 4) {
           $startDate = $tahun . '-07-01';
           $endDate = $tahun . '-09-31';
       } elseif ($tw == 5) {
           $startDate = $tahun . '-01-01';
           $endDate = $tahun . '-09-31';
       } elseif ($tw == 6) {
           $startDate = $tahun . '-10-01';
           $endDate = $tahun . '-12-31';
       } elseif ($tw == 7) {
           $startDate = $tahun . '-01-01';
           $endDate = $tahun . '-12-31';
       }

       $table = ($tahun == 2023) ? '2023' : '2024';

       $query = DB::table($table)
           ->whereBetween('created_at', [$startDate, $endDate]);

       if (!empty($search)) {
           $query->where(function ($q) use ($search) {
               $q->where('nama', 'like', '%' . $search . '%')
                   ->orWhere('nik', 'like', '%' . $search . '%');
           });
       }

      $selects = $query->paginate(10)->appends($request->query());

      return view('RekapTotal.index', compact('selects', 'tahun'));
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
        // return $request;

        $data = new NilaiUnsur();
        // $data->nm_kelas = $request->nm_kelas;
        // $data->ket = $request->ket;
        // $data->save();
        // return redirect()->back();

        $store = NilaiUnsur::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'pekerjaan' => $request->pekerjaan,
            'jenkel' => $request->jenkel,
            'usia' => $request->usia,
            'nohp' => $request->nohp,
            'pendidikan' => $request->pendidikan,
            'nik' => $request->nik,
            'u1' => $request->persyaratan,
            'u2' => $request->kompetensi,
            'u3' => $request->prosedur,
            'u4' => $request->perilaku,
            'u5' => $request->kecepatan,
            'u6' => $request->sarana,
            'u7' => $request->biaya,
            'u8' => $request->penanganan,
            'u9' => $request->kesesuaian,
            'saran' => $request->saran,
        ]);

        if ($store) {
            //redirect dengan pesan sukses
            return redirect('/');
        } else {
        //     //redirect dengan pesan error
            return redirect('/');
        }
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
    public function destroy(String $id)
    {
        $NilaiUnsur = NilaiUnsur::findOrFail($id);
        $NilaiUnsur->delete();

        if ($NilaiUnsur) {
            //redirect dengan pesan sukses
            return redirect('/rekapTotal?jenkel=1&usia=1&pekerjaan=1&pendidikan=1');
        } else {
            //redirect dengan pesan erro
            return redirect('/rekapTotal?jenkel=1&usia=1&pekerjaan=1&pendidikan=1');
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
