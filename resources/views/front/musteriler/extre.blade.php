@extends("front.master.master")
@section("title","Müşteri Extresi");
@section("content")

<div class="col-md-12">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
        <!-- Add the bg color to the header using any   of the bg-* classes -->
        <div class="widget-user-header bg-info">
            <h3 class="widget-user-username">{{\App\Models\Musteriler::getPublicName($data[0]["id"])}}</h3>
            <h5 class="widget-user-desc">{{($data[0]["musteritipi"] == 0 ) ? "Bireysel" : "Kurumsal"}}</h5>
        </div>
        <div class="widget-user-image">
            <img class="img-circle elevation-2" src="{{asset("/")}}{{$data[0]["photo"]}}" alt="User Avatar">
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">3,200</h5>
                        <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">13,000</h5>
                        <span class="description-text">FOLLOWERS</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                    <div class="description-block">
                        <h5 class="description-header">35</h5>
                        <span class="description-text">PRODUCTS</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <div class="row">
            <div class="col-md-12">

                <table class="table ">

                    <thead>
                        <tr class=" border-bottom">
                            <th>İşlem</th>
                            <th>Fiyat</th>
                            <th>Tarih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewData as $item)
                        <tr>
                            <td>
                                @if ($item["uType"] == "fatura")
                                @if($item["type"] == 1)
                                Gelir Faturası

                                @else
                                Gider Faturası
                                @endif
                                @else
                                @if($item["type"] == 0)
                                Ödeme
                                @else
                                Tahsilat
                                @endif
                                @endif
                            </td>
                            <td>{{$item["fiyat"]}}</td>
                            <td>{{$item["tarih"]}}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

@endsection