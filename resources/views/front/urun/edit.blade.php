@extends("front.master.master")
@section("title","Ürün Düzenle");
@section("content")
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ürün Düzenleme Ekranı</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" action="{{route("urun.update",["id" => $data->id])}}">

                    <div class="row p-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputClientCompany">Ürün Adı</label>
                                <input type="text" value="{{$data->urun_adi}}" name="urun_adi" id="urun_adi"
                                    class="form-control">
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kalem İşlemi</label>
                                <select name="kalem_id" required class="form-control "
                                    data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    @foreach($kalemler as $kalem)
                                    <option @if($data->kalem_id == $kalem->id) selected @endif
                                        value="{{$kalem->id}}">{{$kalem->ad}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputClientCompany">Alış Fiyatı</label>
                                <input type="text" value="{{$data->alis_fiyati}}" name="alis_fiyati" id="alis_fiyati"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputClientCompany">Satış Fiyatı</label>
                                <input type="text" value="{{$data->satis_fiyati}}" name="satis_fiyati" id="satis_fiyati"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
            </div>
            @csrf
            <div class="col-12 mr-3 mb-3">
                <input type="submit" value="Yeni Ürün Ekle" class="btn btn-success float-right">
            </div>
            </form>
        </div>
        <!-- /.card -->
    </div>

    </div>
</section>
@endsection