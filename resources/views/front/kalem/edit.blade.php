@extends("front.master.master")
@section("title","Müşteri Kayıt");
@section("content")
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Müşteri Kayıt Ekranı</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data"
                    action="{{route("kalem.update",$musteriedit->id)}}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Kalem Tipi</label>
                            <br />
                            <label>
                                Gelir
                                <input type="radio" @if($musteriedit->kalemtipi == 0) checked @endif
                                name="kalemtipi" class="musteriType" value="0">
                            </label>
                            <label class="mr-3">
                                Gider
                                <input type="radio" @if($musteriedit->kalemtipi == 1) checked @endif
                                name="kalemtipi" class="musteriType" value="1">
                            </label>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputClientCompany">Kalem Ad</label>
                                    <input type="text" name="ad" value="{{$musteriedit->ad}}" id="ad"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputClientCompany">Kdv</label>
                                    <input type="text" name="kdv" value="{{$musteriedit->kdv}}"
                                        id="kdv" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    @csrf
                    <div class="col-12 mr-3 mb-3">
                        <input type="submit" value="Güncelle" class="btn btn-info float-right">
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>

    </div>
</section>
@endsection
