<?php

namespace App\Http\Controllers\front\islem;

use App\Http\Controllers\Controller;
use App\Models\Banka;
use App\Models\Fatura;
use App\Models\Islem;
use App\Models\Logger;
use App\Models\Musteriler;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{

    public function index()
    {
        return view("front.islem.index");
    }

    public function create($type)
    {
        $musteriler = Musteriler::all();
        $faturalar = Fatura::getList($type);
        $bankalar = Banka::all();
        if ($type == 0) {
            // Odeme
            return view("front.islem.odeme.create", compact("musteriler", "faturalar", "bankalar"));
        } else {
            // Tahsilat
            return view("front.islem.tahsilat.create", compact("musteriler", "faturalar", "bankalar"));
        }
    }

    public function edit($id)
    {

        $query = Islem::findOrFail($id);

        $musteriler = Musteriler::all();
        $faturalar = Fatura::getList($query["tip"]);
        $bankalar = Banka::all();

        if ($query["tip"] == 0) {
            return view("front.islem.odeme.edit", compact("query", "musteriler", "faturalar", "bankalar"));
        } else {
            return view("front.islem.tahsilat.edit", compact("query", "musteriler", "faturalar", "bankalar"));
        }

    }

    public function update(Request $request)
    {
        $all = $request->except("_token");
        $id = $request->route("id");

        $query = Islem::findOrFail($id)->get();

        if ($query[0]["tip"] == 0) {
            Logger::insert("Ödeme Düzenlendi", "İşlem");
        } else {
            Logger::insert("Tahsilat Düzenlendi", "İşlem");

        }

        $query = Islem::findOrFail($id);
        $query->update($all);

        toastr()->success('İşlem Güncellenmiştir', 'Başarılı');
        return redirect()->back();

    }

    public function data(Request $request)
    {

        $table = Islem::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('islem.edit', ["id" => $table]) . '">Düzenle</a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a href="' . route('islem.delete', ["id" => $table]) . '">Sil</a>';
            })
            ->addColumn('tip', function ($table) {
                return ($table->tip == 0) ? "Ödeme" : "Tahsilat";
            })
            ->addColumn('faturaNo', function ($table) {
                return Fatura::getNo($table->faturaId);
            })
            ->addColumn('musteri', function ($table) {
                return Musteriler::getPublicName($table->musteriId);
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);

        return $data;

    }

    public function store(Request $request)
    {

        $all = $request->except("_token");
        $type = $request->route("type");
        $all["tip"] = $type;
        $ekleme = Islem::create($all);
        if ($ekleme) {
            if ($type == 0) {
                Logger::insert("Ödeme Yapıldı", "İşlem");
            } else {
                Logger::insert("Tahsilat Yapıldı", "İşlem");

            }
            toastr()->success('İşlem Eklenmiştir', 'Başarılı');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $data = Islem::findOrFail($id)->get();
        if ($data[0]["tip"] == 0) {
            Logger::insert("Ödeme Silindi", "İşlem");
        } else {
            Logger::insert("Tahsilat Silindi", "İşlem");

        }
        $data->delete();
        toastr()->success('İşlem Silnmiştir', 'Başarılı');
        return redirect()->back();
    }

}
