<?php

namespace App\Http\Controllers\front\musteriler;

use App\Helper\fileUpload;
use App\Http\Controllers\Controller;
use App\Models\FaturaIslem;
use App\Models\Islem;
use App\Models\Logger;
use App\Models\Musteriler;
use App\Models\Rapor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{

    public function index()
    {
        return view("front.musteriler.index");
    }

    public function create()
    {
        return view("front.musteriler.create");
    }

    public function store(Request $request)
    {

        $all = $request->except("_token");

        $all["photo"] = fileUpload::newUpload(rand(1, 9000), 'musteriler', $request->file('photo'), 0);

        $create = Musteriler::create($all);
        if ($create) {
            Logger::insert("Müşteri Eklendi", "Müşteri");

            toastr()->success('Müşteri Eklfdsafenmiştir', 'Başarılı');
            return redirect()->back();
        } else {

            toastr()->error('Müşteri Eklenemedi', 'Hata');
            return redirect()->back();
        }

    }

    public function data(Request $request)
    {

        $table = Musteriler::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('musteriler.edit', ["id" => $table]) . '">Düzenle</a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a href="' . route('musteriler.delete', ["id" => $table]) . '">Sil</a>';
            })
            ->addColumn('publicname', function ($table) {
                return Musteriler::getPublicName($table->id);
            })
            ->addColumn('publicname', function ($table) {
                return Musteriler::getPublicName($table->id);
            })
            ->addColumn('extre', function ($table) {
                return '<a href="' . route('musteriler.extre', ["id" => $table->id]) . '">Extre</a>';
            })
            ->addColumn('bakiye', function ($table) {
                $bakiye = Rapor::getMusteriBakiye($table->id);
                if ($bakiye < 0) {
                    return '<span style="color:red">-' . $bakiye . '</span>';
                } else if ($bakiye > 0) {
                    return '<span style="color:green">+' . $bakiye . '</span>';

                } else {
                    return $bakiye;
                }
            })
            ->rawColumns(['edit', 'delete', "publicname", "bakiye", "extre"])
            ->make(true);

        return $data;

    }

    public function edit($id)
    {
        $musteriedit = Musteriler::findOrFail($id);

        return view("front.musteriler.edit", compact("musteriedit"));

    }

    public function update(Request $request)
    {

        $id = $request->id;
        $requestAllData = $request->except('_token');
        $controller = Musteriler::findOrFail($id)->get();
        $requestAllData['photo'] = fileUpload::changeUpload($request->id . $request->ad . $request->soyad, 'musteriler', $request->file('photo'), 0, $controller, "photo");

        $update = Musteriler::where('id', $id)->update($requestAllData);

        if ($update) {
            Logger::insert(Musteriler::getPublicName($id) . " Güncellendi", "Müşteri");
            toastr()->success('Müşteri Güncellendi', 'Başarılı');
            return redirect()->back();
        }

    }

    public function delete($id)
    {

        $data = Musteriler::findOrFail($id);
        fileUpload::directoryDelete($data['photo']);
        Musteriler::where('id', $id)->delete();

        
        Logger::insert(Musteriler::getPublicName($data[0]["id"]), "Müşteri");
        toastr()->success('Müşterinin Resmi ve Bilgileri Silinmiştir.', 'Başarılı');
        return redirect()->back();

    }

    public function extre($id)
    {

        $musterExtreleri = Musteriler::findOrFail($id)->get();

        $faturaTablo = FaturaIslem::leftJoin('faturas', 'fatura_islems.faturaId', "=", "faturas.id")
            ->where("faturas.musteriId", $id)
            ->groupBy("faturas.id")
            ->select(["faturas.id as id", "faturas.faturaTipi as type", DB::raw('"fatura" as uType'), DB::raw("sum(genelToplam) as fiyat"), "faturas.faturaTarih as tarih"])
            ->orderBy("tarih", "desc");

        $islemTablo = Islem::where("musteriId", $id)
            ->select(["id", "tip as type", DB::raw("'islem' as uType"), "fiyat", "islemTarihi"])
            ->orderBy("islemTarihi", "desc");

        $viewData = $faturaTablo->union($islemTablo)
            ->orderBy("tarih", "desc")->get();

        return view("front.musteriler.extre", ["data" => $musterExtreleri, "viewData" => $viewData]);

    }

}
