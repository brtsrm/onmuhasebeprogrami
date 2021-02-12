<?php

namespace App\Http\Controllers\front\user;

use App\Http\Controllers\Controller;
use App\Models\Logger;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{


    public function index()
    {
        return view("front.user.index");
    }

    public function create()
    {
        return view("front.user.create");
    }

    public function store(Request $request)
    {

        $all = $request->except("_token");

        $emailController = User::where("email", $request->email)->count();
        $all["password"] = md5($request->password);
        $permission = ($all["permission"] != "") ? $all["permission"] : "";
        unset($all["permission"]);
        if ($emailController == 1) {
            toastr()->warning($request->email . ' Yazmış olduğunuz mail adresi mevcut', 'Hata');
            return redirect()->back();
        }
        unset($all["permission"]);
        $create = User::create($all);
        if ($create) {
            foreach ($permission as $k => $v) {
                UserPermission::insert([
                    "userId" => $create->id,
                    "permissionId" => $v,
                ]);
            }
            Logger::insert($all["name"] . "Kullanıcı Eklendi", "Kullanıcı");
            toastr()->success('Müşteri Eklenmiştir', 'Başarılı');
            return redirect()->back();
        } else {

            toastr()->error('Müşteri Eklenemedi', 'Hata');
            return redirect()->back();
        }

    }

    public function data(Request $request)
    {

        $table = User::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('user.edit', ["id" => $table]) . '">Düzenle</a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a href="' . route('user.delete', ["id" => $table]) . '">Sil</a>';
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);

        return $data;

    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view("front.user.edit", compact("data"));

    }

    public function update(Request $request)
    {

        $id = $request->id;
        $requestAllData = $request->except('_token');
        $emailController = User::where("email", $request->email)->where("id", "!=", $id)->count();

        if ($emailController == 1) {
            toastr()->warning($request->email . ' Yazmış olduğunuz mail adresi mevcut', 'Hata');
            return redirect()->back();
        }
        if ($requestAllData["password"] == "") {
            unset($requestAllData["password"]);
        } else {
            $all["password"] = md5($requestAllData["password"]);
        }

        $permission = ($requestAllData["permission"]) ? $requestAllData["permission"] : [];
        UserPermission::where("userId", $id)->delete();
        if (count($permission) != 0) {
            foreach ($permission as $k => $v) {
                UserPermission::create(
                    [
                        "userId" => $id,
                        "permissionId" => $v,
                    ]
                );
            }
        }
        unset($requestAllData["permission"]);

        $controller = User::findOrFail($id)->get();
        $update = User::where('id', $id)->update($requestAllData);

        Logger::insert($controller[0]["name"] . "Kullanıcı Düzenlendi", "User");

        if ($update) {
            toastr()->success('Kullanıcı Güncellendi', 'Başarılı');
            return redirect()->back();
        }

    }

    public function delete($id)
    {

        $data = User::findOrFail($id)->get();
        User::where('id', $id)->delete();

        Logger::insert($data[0]["urun_adi"] . "User Silinmiştir", "User");
        toastr()->success('User bilgileri silinmiştir.', 'Başarılı');
        return redirect()->back();

    }

}
