@extends("front.master.master")
@section("title","Kalem Kayıt");
@section("content")
@section('header')
<link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">
@endsection
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Gelir Kayıt Ekranı</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data"
                    action="{{route("fatura.store",["type" => "gelir"])}}">
                    <div class="row p-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputClientCompany">Fatura No</label>
                                <input type="text" value="{{ENV("FATURA")}}-{{date("Ymd")}}-{{rand(0,99999999999)}}"
                                    name="faturaNo" required id="adres" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputClientCompany">Fatura Tarihi</label>
                                <input type="date" name="faturaTarih" required id="faturaTarihi"
                                    value="{{date("Y-m-d")}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Müşteriler</label>
                                <select name="musteriId" required class="form-control select2 select2-danger"
                                    data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option selected="selected" disabled>Müşteri Seçiniz</option>
                                    @foreach($musteriler as $musteri)
                                    <option value="{{$musteri->id}}">{{$musteri->ad}} {{$musteri->soyad}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button id="addRowBtn" type="button" class="float-right m-4 btn btn-primary">+</button>

                    <table class="table" id="faturaData">
                        <thead>
                            <tr>
                                <td>Kalem</td>
                                <td>Ürün</td>
                                <td>Adet / Gün</td>
                                <td>Tutar</td>
                                <td>Toplam Tutar</td>
                                <td>Kdv</td>
                                <td>Kdv Toplam</td>
                                <td>Genel Toplam</td>
                                <td>Açıklama</td>
                                <td>Kaldır</td>
                            </tr>
                        </thead>
                    </table>

                    <table class="table">
                        <tr>
                            <td align="left">
                                Ara Toplam
                            </td>
                            <td class="ara_toplam" align="right">
                                0.00
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                Kdv Toplam
                            </td>
                            <td class="kdv_toplam" align="right">
                                0.00
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                Genel Toplam
                            </td>
                            <td class="genel_toplam" align="right">
                                0.00
                            </td>
                        </tr>
                    </table>

                    @csrf
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

<script src="{{asset("/plugins/select2/js/select2.full.min.js")}}"></script>
<script>
    $('.select2').select2();

    var i = $(".islem_field").length;
    $("#addRowBtn").click(function(){
        var newRow = 
        '<tr class="islem_field">'+
        '<td><select name="islem['+i+'][kalemId]" class="form-control kalem" value="islem['+i+'][kalemId]">'+
        '<option value="0">Kalem Seçiniz</option>';
        @foreach($kalemGelir as $item)
        newRow += '<option data-k="{{$item["kdv"]}}" value="{{$item["id"]}}">{{$item["ad"]}}</option>';
        @endforeach
            newRow += "</select></td>" +
        '<td><select name="islem['+i+'][urun_id]" class="form-control urun" value="islem['+i+'][urun_id]">'+
        '<option value="0">Ürün Seçiniz</option>';
        @foreach($urunler as $item)
        newRow += '<option data-fiyat="{{$item["satis_fiyati"]}}" value="{{$item["id"]}}">{{$item["urun_adi"]}}</option>';
        @endforeach
            newRow += "</select></td>" +
            '<td><input type="text" class="form-control" id="gun_adet" name="islem['+i+'][gun_adet]" />'+
            '<td><input type="text" class="form-control" id="tutar" name="islem['+i+'][tutar]" />'+
            '<td><input type="text" class="form-control" id="toplam_tutar" name="islem['+i+'][toplam_tutar]" />'+
            '<td><input type="text" class="form-control" id="kdv" name="islem['+i+'][kdv]" />'+
            '<td><input type="text" class="form-control" id="kdv_toplam" name="islem['+i+'][kdv_toplam]" />'+
            '<td><input type="text" class="form-control" id="genel_toplam" name="islem['+i+'][genel_toplam]" />'+
            '<td><input type="text" class="form-control" id="text" name="islem['+i+'][text]" />'+
            '<td><button class="btn btn-danger" id="removeButton" type="button">X</button></td>'+
            '</tr>';

            $("#faturaData").append(newRow);
        i++;
    });
    $("body").on("change",".kalem",function(){
        var kdv = $(this).find(":selected").data("k");
        $(this).closest(".islem_field").find("#kdv").val(kdv);
    });

    $("body").on("change",".urun",function(){
        var fiyat = $(this).find(":selected").data("fiyat");
        $(this).closest(".islem_field").find("#tutar").val(fiyat);
    });

    $("body").on("click","#removeButton",function(){
        $(this).closest(".islem_field").remove();
        calc();
    });

    $("body").on("change","#faturaData input",function(){
        var $this = $(this);
        if($this.is("#tutar,#gun_adet,#toplam_tutar,#genel_kdv,#kdv"))
        {
             var adet= $this.closest("tr").find("#gun_adet").val();
             var tutar = $this.closest("tr").find("#tutar").val();
             var kdv = $this.closest("tr").find("#kdv").val();
             var toplam_tutar;
             var genel_tutar;
             var kdv_tutar;
             if(adet == "" && tutar == ""){
                toplam_tutar = $this.closest("tr").find("#toplam_tutar").val();
                if(toplam_tutar == ""){
                    genel_tutar = parseFloat($this.closest("tr").find("#genel_toplam").val());
                    kdv_tutar = genel_tutar / (1+kdv/100);
                    toplam_tutar = genel_tutar - kdv_tutar;
                }else{
                    toplam_tutar = parseFloat($this.closest("tr").find("#toplam_tutar").val());
                    kdv_tutar = toplam_tutar*kdv/100;
                    genel_tutar = kdv_tutar + toplam_tutar;
                }
             }else{
                 toplam_tutar = adet * tutar;
                 kdv_tutar = toplam_tutar*kdv/100;
                 genel_tutar= toplam_tutar+kdv_tutar;
             }
             kdv_tutar = kdv_tutar.toFixed(2);
             toplam_tutar = toplam_tutar.toFixed(2);
             genel_tutar = genel_tutar.toFixed(2);
             $this.closest("tr").find("#toplam_tutar").val(toplam_tutar);
             $this.closest("tr").find("#kdv_toplam").val(kdv_tutar);
             $this.closest("tr").find("#genel_toplam").val(genel_tutar);
        }
        calc();
    });
    function calc(){
        var kdv_toplam = 0;
        var toplam_tutar = 0;
        var genel_toplam = 0;
        
        $("[id=kdv_toplam]").each(function(){
            kdv_toplam = parseFloat(kdv_toplam) + parseFloat($(this).val());
            
        })
        
        $("[id=toplam_tutar]").each(function(){
            toplam_tutar = parseFloat(toplam_tutar) + parseFloat($(this).val());

        })
        
        $("[id=genel_toplam]").each(function(){
            genel_toplam = parseFloat(genel_toplam) + parseFloat($(this).val());

        });
        $(".ara_toplam").html(toplam_tutar);
        $(".kdv_toplam").html(kdv_toplam);
        $(".genel_toplam").html(genel_toplam);
    }

</script>
@endsection