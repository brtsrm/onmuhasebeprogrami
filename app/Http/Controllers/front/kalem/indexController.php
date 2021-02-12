<?php

namespace App\Http\Controllers\front\kalem;

use App\Http\Controllers\Controller;
use App\Models\Kalem;
use App\Models\Logger;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{

    public function index()
    {
        return view("front.kalem.index");
    }

    public function create()
    {
        return view("front.kalem.create");
    }

    public function store(Request $request)
    {

        $all = $request->except("_token");

        $create = Kalem::create($all);
        if ($create) {

            Logger::insert($all["ad"]."Kalem Eklendi", "Kalem");

            toastr()->success('Müşteri Eklfdsafenmiştir', 'Başarılı');
            return redirect()->back();
        } else {

            toastr()->error('Müşteri Eklenemedi', 'Hata');
            return redirect()->back();
        }

    }

    public function data(Request $request)
    {

        $table = Kalem::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('kalem.edit', ["id" => $table]) . '">Düzenle</a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a href="' . route('kalem.delete', ["id" => $table]) . '">Sil</a>';
            })
            ->addColumn('kalemtipi', function ($table) {
                return ($table->kalemtipi == 0) ? "Gelir" : "Gider";
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);

        return $data;

    }

    public function edit($id)
    {
        $musteriedit = Kalem::findOrFail($id);

        return view("front.kalem.edit", compact("musteriedit"));

    }

    public function update(Request $request)
    {

        $id = $request->id;
        $requestAllData = $request->except('_token');
        $controller = Kalem::findOrFail($id)->get();
        $update = Kalem::where('id', $id)->update($requestAllData);
        

        Logger::insert($controller[0]["ad"]."Kalem Düzenlendi", "Kalem");

        if ($update) {
            toastr()->success('Müşteri Güncellendi', 'Başarılı');
            return redirect()->back();
        }

    }

    public function delete($id)
    {

        $data = Kalem::findOrFail($id)->get();
        Kalem::where('id', $id)->delete();
        
        Logger::insert($data[0]["ad"]."Kalem Düzenlendi", "Kalem");
        toastr()->success('Kalem bilgileri silinmiştir.', 'Başarılı');
        return redirect()->back();

    }

}
