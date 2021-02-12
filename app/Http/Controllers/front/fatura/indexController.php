<?php

namespace App\Http\Controllers\front\fatura;

use App\Http\Controllers\Controller;
use App\Models\Fatura;
use App\Models\FaturaIslem;
use App\Models\Kalem;
use App\Models\Logger;
use App\Models\Musteriler;
use App\Models\Urun;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{

    public function index()
    {
        return view("front.fatura.index");
    }

    public function create($type)
    {

        $musteriler = Musteriler::all();
        $urunler = Urun::all();
        if ($type == "gelir") {
            $kalemGelir = Kalem::getList(0);
            return view("front.fatura.gelir.create", compact("musteriler", "kalemGelir", "urunler"));
        } else {
            $kalemGider = Kalem::getList(1);
            return view("front.fatura.gider.create", compact("musteriler", "kalemGider", "urunler"));
        }
    }
    public function store(Request $request)
    {
        $all = $request->except("_token");
        $type = ($request->route("type") == "gelir") ? 0 : 1;
        $faturaIslemler = $all["islem"];
        unset($all["islem"]);
        $all["faturaTipi"] = $type;
        $faturaCreate = Fatura::create($all);
        if ($type == 0) {
            Logger::insert("Gelir Faturası Eklendi", "Fatura");
        } else {
            Logger::insert("Gider Faturası Eklendi", "Fatura");

        }
        if ($faturaCreate) {
            foreach ($faturaIslemler as $faturaKey => $faturaVal) {
                FaturaIslem::create(
                    [
                        "faturaId" => $faturaCreate->id,
                        "kalemId" => $faturaVal["kalemId"],
                        "urun_id" => $faturaVal["urun_id"],
                        "miktar" => $faturaVal["gun_adet"],
                        "fiyat" => $faturaVal["tutar"],
                        "kdv" => $faturaVal["kdv"],
                        "araToplam" => $faturaVal["toplam_tutar"],
                        "kdvToplam" => $faturaVal["kdv_toplam"],
                        "genelToplam" => $faturaVal["genel_toplam"],
                        "text" => $faturaVal["text"],
                    ]
                );
            }

            toastr()->success('Fatura Eklenmiştir', 'Başarılı');
            return redirect()->route("fatura.index");
        }
    }

    public function data(Request $request)
    {

        $table = Fatura::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('fatura.edit', ["id" => $table]) . '">Düzenle</a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a href="' . route('fatura.delete', ["id" => $table]) . '">Sil</a>';
            })
            ->addColumn('faturaTipi', function ($table) {
                return ($table->faturaTipi == 0) ? "Gelir" : "Gider";
            })
            ->addColumn('musteri', function ($table) {
                return Musteriler::getPublicName($table->musteriId);
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);

        return $data;

    }

    public function edit($id)
    {
        $invoiceController = Fatura::findOrFail($id);
        $urunler = Urun::all();
        $data = Fatura::where("id", $id)->get();
        $dataIslem = FaturaIslem::where("faturaId", $id)->get();
        $musteriler = Musteriler::all();
        if ($data[0]["faturaTipi"] == 0) {
            // Gelir
            $kalemGelir = Kalem::getList(0);
            return view("front.fatura.gelir.edit", ["urunler" => $urunler, "data" => $data, "dataIslem" => $dataIslem, "musteriler" => $musteriler, "kalemGelir" => $kalemGelir]);
        } else {
            // Gider
            $kalemGider = Kalem::getList(1);
            return view("front.fatura.gelir.edit", ["urunler" => $urunler, "data" => $data, "dataIslem" => $dataIslem, "musteriler" => $musteriler, "kalemGider" => $kalemGider]);
        }

    }

    public function update(Request $request)
    {

        $id = $request->route("id");
        $c = Fatura::where("id", $id)->count();

        if ($c != 0) {
            $all = $request->except("_token");
            $faturaIslemler = $all["islem"];
            unset($all["islem"]);
            $data = Fatura::where("id", $id)->get();
            if ($data[0]["faturaTipi"] == 0) {
                Logger::insert($data[0]["faturaNo"] . "Gelir Faturası Düzenlendi", "Fatura");
            } else {
                Logger::insert($data[0]["faturaNo"] . "Gider Faturası Düzenlendi", "Fatura");

            }

            if (count($faturaIslemler) != 0) {
                FaturaIslem::where('faturaId', $id)->delete();
                foreach ($faturaIslemler as $faturaKey => $faturaVal) {
                    FaturaIslem::create(
                        [
                            "faturaId" => $id,
                            "kalemId" => $faturaVal["kalemId"],
                            "urun_id" => $faturaVal["urun_id"],
                            "miktar" => $faturaVal["gun_adet"],
                            "fiyat" => $faturaVal["tutar"],
                            "kdv" => $faturaVal["kdv"],
                            "araToplam" => $faturaVal["toplam_tutar"],
                            "kdvToplam" => $faturaVal["kdv_toplam"],
                            "genelToplam" => $faturaVal["genel_toplam"],
                            "text" => $faturaVal["text"],
                        ]
                    );
                }

                toastr()->success('Fatura Düzeltilmiştir', 'Başarılı');
                return redirect()->back();
            }
        }
    }

}
