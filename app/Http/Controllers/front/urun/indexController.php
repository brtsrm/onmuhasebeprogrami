<?php

namespace App\Http\Controllers\front\urun;

use App\Http\Controllers\Controller;
use App\Models\FaturaIslem;
use App\Models\Kalem;
use App\Models\Logger;
use App\Models\Urun;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class indexController extends Controller
{

    public function index()
    {
        return view("front.urun.index");
    }

    public function create()
    {
        $kalemler = Kalem::all();
        return view("front.urun.create", compact("kalemler"));
    }

    public function store(Request $request)
    {

        $all = $request->except("_token");

        $create = Urun::create($all);
        if ($create) {

            Logger::insert($all["urun_adi"] . "Urun Eklendi", "Urun");
            toastr()->success('Ürün Eklenmiştir', 'Başarılı');
            return redirect()->back();
        } else {

            toastr()->error('Ürün Eklenemedi', 'Hata');
            return redirect()->back();
        }

    }

    public function data(Request $request)
    {

        $table = Urun::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('urun.edit', ["id" => $table]) . '">Düzenle</a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a href="' . route('urun.delete', ["id" => $table]) . '">Sil</a>';
            })
            ->addColumn('kalemtipi', function ($table) {
                return ($table->kalemtipi == 0) ? "Gelir" : "Gider";
            })
            ->addColumn('stok', function ($table) {
                $girdi = FaturaIslem::leftJoin('faturas', 'fatura_islems.faturaId', "=", 'faturas.id')
                    ->where("fatura_islems.urun_id", $table->id)
                    ->where("faturas.faturaTipi", 0)
                    ->sum("fatura_islems.miktar");
                $cikti = FaturaIslem::leftJoin('faturas', 'fatura_islems.faturaId', "=", 'faturas.id')
                    ->where("fatura_islems.urun_id", $table->id)
                    ->where("faturas.faturaTipi", 1)
                    ->sum("fatura_islems.miktar");
                    return $girdi - $cikti;
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);

        return $data;

    }

    public function edit($id)
    {
        $data = Urun::findOrFail($id);
        $kalemler = Kalem::all();
        return view("front.urun.edit", compact("data", "kalemler"));

    }

    public function update(Request $request)
    {

        $id = $request->id;
        $requestAllData = $request->except('_token');
        $controller = Urun::findOrFail($id)->get();
        $update = Urun::where('id', $id)->update($requestAllData);

        Logger::insert($controller[0]["urun_adi"] . "Urun Düzenlendi", "Urun");

        if ($update) {
            toastr()->success('Müşteri Güncellendi', 'Başarılı');
            return redirect()->back();
        }

    }

    public function delete($id)
    {

        $data = Urun::findOrFail($id)->get();
        Urun::where('id', $id)->delete();

        Logger::insert($data[0]["urun_adi"] . "Urun Silinmiştir", "Urun");
        toastr()->success('Urun bilgileri silinmiştir.', 'Başarılı');
        return redirect()->back();

    }

}
