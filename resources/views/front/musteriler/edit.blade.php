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
                    action="{{route("musteriler.update",$musteriedit->id)}}">
                    <div class="card-body">
                        @if($musteriedit->photo != "")
                        <div class="row">

                            <div class="col-md-10">
                                <label for="inputName">Müşteri Resim</label>
                                <input type="file" name="photo" class="form-control" id="photo">
                            </div>
                            <div class="col-md-2">
                                <label for="">
                                    <p>Önceki Resmi</p>    
                                    <img class="img-thumbnial" src="{{asset($musteriedit->photo)}}"
                                    style="width:100%;height:250px;" alt="Müşterinin Resmi">
                                </label>
                            </div>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="inputName">Müşteri Resim</label>
                            <input type="file" name="photo" class="form-control" id="photo">
                        </div>

                        @endif
                        <div class="form-group">
                            <label for="">Müşteri Tipi</label>
                            <br />
                            <label>
                                Bireysel
                                <input type="radio" @if($musteriedit->musteritipi == 0) checked @endif
                                name="musteritipi" class="musteriType" value="0">
                            </label>
                            <label class="mr-3">
                                Kurumsal
                                <input type="radio" @if($musteriedit->musteritipi == 1) checked @endif
                                name="musteritipi" class="musteriType" value="1">
                            </label>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputClientCompany">Ad</label>
                                    <input type="text" name="ad" value="{{$musteriedit->ad}}" id="ad"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputClientCompany">Soyad</label>
                                    <input type="text" name="soyad" value="{{$musteriedit->soyad}}" id="soyad"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputClientCompany">Doğum Tarihi</label>
                                    <input type="date" name="dogumTarihi" value="{{$musteriedit->dogumTarihi}}"
                                        id="dogumTarihi" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputClientCompany">Tc</label>
                                    <input type="text" name="tc" id="tc" value="{{$musteriedit->tc}}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row musteriTypeCompany"
                            style="display:{{$musteriedit->musteritipi == 1 ? 'show' : 'none'}}">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputClientCompany">Firma Adı</label>
                                    <input type="text" name="firmaAdi" value="{{$musteriedit->firmaAdi}}" id="firmaAdi"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputClientCompany">Vergi Numarası</label>
                                    <input type="text" name="vergiNumarasi" value="{{$musteriedit->vergiNumarasi}}"
                                        id="vergiNumarasi" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputClientCompany">Vergi Dairesi</label>
                                    <input type="text" name="vergiDairesi" value="{{$musteriedit->vergiDairesi}}"
                                        id="vergiDairesi" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputClientCompany">Adres</label>
                                    <input type="text" name="adres" value="{{$musteriedit->adres}}" id="adres"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputClientCompany">Telefon</label>
                                    <input type="text" name="telefon" value="{{$musteriedit->telefon}}" id="telefon"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputClientCompany">Email</label>
                                    <input type="text" name="email" value="{{$musteriedit->email}}" id="email"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    @csrf
                    <div class="col-12 mr-3 mb-3">
                        <input type="submit" value="Yeni Müşteri Oluştur" class="btn btn-success float-right">
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>

    </div>
</section>
@endsection

@section("footer")

<script>
    $(".musteriType").click(function () {
            if ($(this).val() == 1) {
                $(".musteriTypeCompany").show().css("border", "1px solid #aaa").attr("<h4>Müşteri paneli</h4>");
            } else {
                $(".musteriTypeCompany").hide();

            }
        });
</script>

@endsection