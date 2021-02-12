@extends("front.master.master")
@section("title","Kalem Kayıt");
@section("content")
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Kalem Kayıt Ekranı</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <form method="post" enctype="multipart/form-data" action="{{route("kalem.store")}}">
                            <div class="form-group">
                                <label for="">Kalem Tipi</label>
                                <br/>
                                <label>
                                    Gelir
                                    <input type="radio" name="kalemtipi" class="musteriType" value="0">
                                </label>
                                <label class="mr-3">
                                    Gider
                                    <input type="radio" name="kalemtipi" class="musteriType" value="1">
                                </label>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputClientCompany">Kalem Adı</label>
                                        <input type="text" name="ad" id="adres" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputClientCompany">Kdv</label>
                                        <input type="text" name="kdv" id="kdv" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @csrf
                        <div class="col-12 mr-3 mb-3">
                            <input type="submit" value="Yeni Kalem Oluştur" class="btn btn-success float-right">
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>

        </div>
    </section>
@endsection

