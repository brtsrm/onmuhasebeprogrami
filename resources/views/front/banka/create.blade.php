@extends("front.master.master")
@section("title","Banka Ekle");
@section("content")
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Banka Ekle</h3>
                </div>
                <form method="post" enctype="multipart/form-data" action="{{route("banka.store")}}">
                    <div class="row p-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputClientCompany">Banka Adı</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputClientCompany">IBAN</label>
                                <input type="text" name="iban" id="iban" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputClientCompany">Hesap No</label>
                                <input type="text" name="hesapno" id="hesapno" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mr-3 mb-3">
                        <input type="submit" value="Yeni Banka Oluştur" class="btn btn-success float-right">
                    </div>
            @csrf
            </form>
        </div>
        <!-- /.card -->
    </div>

    </div>
</section>
@endsection