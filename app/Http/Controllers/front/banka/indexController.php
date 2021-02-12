<?php

namespace App\Http\Controllers\front\banka;

use App\Http\Controllers\Controller;
use App\Models\Banka;
use App\Models\Logger;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{

    public function index()
    {
        return view("front.banka.index");
    }

    public function create()
    {
        return view("front.banka.create");
    }

    public function store(Request $request)
    {

        $all = $request->except("_token");

        $create = Banka::create($all);
        if ($create) {
            Logger::insert("Banka Eklendi", "Banka");
            toastr()->success('Banka Eklenmiştir', 'Başarılı');
            return redirect()->back();
        } else {

            toastr()->error('Banka Eklenemedi', 'Hata');
            return redirect()->back();
        }

    }

    public function data(Request $request)
    {

        $table = Banka::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('banka.edit', ["id" => $table]) . '">Düzenle</a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a href="' . route('banka.delete', ["id" => $table]) . '">Sil</a>';
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);

        return $data;

    }

    public function edit($id)
    {
        $banka = Banka::findOrFail($id);

        return view("front.banka.edit", compact("banka"));

    }

    public function update(Request $request)
    {

        $id = $request->id;
        $requestAllData = $request->except('_token');
        $controller = Banka::findOrFail($id)->get();
        $update = Banka::where('id', $id)->update($requestAllData);

        if ($update) {
            Logger::insert($update[0]["ad"] . "Düzenlendi", "Banka");
            toastr()->success('Banka Güncellendi', 'Başarılı');
            return redirect()->back();
        }

    }

    public function delete($id)
    {

        $data = Banka::findOrFail($id);
        Logger::insert($data[0]["ad"],"Banka silindi");
        Banka::where('id', $id)->delete();
        toastr()->success('Banka bilgileri silinmiştir.', 'Başarılı');
        return redirect()->back();

    }

}
