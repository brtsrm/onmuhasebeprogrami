@extends("front.master.master")
@section("title","Ödeme Kayıt");
@section("content")
@section('header')
<link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">
@endsection
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ödeme Kayıt</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" action="{{route("islem.store",["type" => 0])}}">
                    <div class="row p-3">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fatura</label>
                                <select name="faturaId" name="faturaId" required
                                    class="form-control select2 select2-danger faturaId"
                                    data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option selected="selected" disabled>Fatura Seçiniz</option>
                                    @foreach($faturalar as $fatura)
                                    <option data-fatura-fiyat='{{\App\Models\Fatura::getTotal($fatura->id)}}'
                                        data-musteri-id="{{$fatura->musteriId}}" value="{{$fatura->id}}">
                                        {{$fatura->faturaNo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Müşteriler</label>
                                <select name="musteriId" required class="form-control select2 select2-danger musteriId"
                                    data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option selected="selected" disabled>Müşteri Seçiniz</option>
                                    @foreach($musteriler as $musteri)
                                    <option value="{{$musteri->id}}">{{$musteri->ad}} {{$musteri->soyad}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputClientCompany">İşlem Tarihi</label>
                                <input type="date" min="{{date("Y-m-d")}}" value="{{date("Y-m-d")}}" name="islemTarihi"
                                    required id="faturaTarihi" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ödeme Türü</label>
                                <select name="odemeTuru" required class="form-control select2 select2-danger"
                                    data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option value="0">Nakit</option>
                                    <option value="1">Banka</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ödeme İşlemi</label>
                                <select name="odemeSekli" required class="form-control select2 select2-danger"
                                    data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option selected="selected" disabled>Ödeme Seçiniz</option>
                                    <option value="0">Nakit</option>
                                    @foreach($bankalar as $banka)
                                    <option value="{{$banka->id}}">{{$banka->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputClientCompany">Fiyat</label>
                                <input type="text" name="fiyat" required id="fiyat" class="form-control">
                            </div>
                        </div>
                    </div>

                    @csrf

                    <div class="form-group p-3">
                        <label for="">Açıklama</label>
                        <textarea name="text" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-12 mr-3 mb-3">
                        <input type="submit" value="Yeni Fatura Oluştur" class="btn btn-success float-right">
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>

    </div>
</section>
@endsection
@section('footer')
<script>
    $(document).ready(function(){  
            $(".faturaId").change(function(){
               var musteriId = $(this).find(":selected").attr("data-musteri-id");
               var fiyat = $(this).find(":selected").attr("data-fatura-fiyat");
               $(".musteriId").val(musteriId).trigger('change');
               $("input[name=fiyat]").val(fiyat);
               
            });
        });
</script>
@endsection