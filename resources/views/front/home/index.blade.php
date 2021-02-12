@extends("front.master.master")
@section("content")

<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info text-center">
      <div class="inner">
        <h3>{{\App\Models\Rapor::toplamGelirFatura()}}</h3>
        <p>Gelir Faturası</p>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success text-center">
      <div class="inner">
        <h3>{{\App\Models\Rapor::toplamGiderFatura()}}</h3>
        <p>Gelir Faturası</p>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning text-center">
      <div class="inner">
        <h3>{{\App\Models\Rapor::toplamOdeme()}}</h3>
        <p>Toplam Ödeme</p>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger text-center">
      <div class="inner">
        <h3>{{\App\Models\Rapor::toplamTahsilat()}}</h3>
        <p>Toplam Tahsilat</p>
      </div>
    </div>
  </div>
  <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
  <!-- Left col -->
  <section class="col-lg-12 connectedSortable">
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">İşlemler</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>İşlem</th>
                <th>Açıklama</th>
                <th>Tarih</th>
              </tr>
            </thead>
            <tbody>

            @foreach($logger as $item)
            <tr>
              <td>{{$item["id"]}}</a></td>
              <td>{{$item["islem"]}}</td>
              <td>{{$item["text"]}}</td>
              <td>{{$item["created_at"]}}</td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.card-body -->
 
      <div class="card-footer clearfix">
        <a href="{{route("home.tumislemler")}}" class="btn btn-sm btn-info float-left">Tüm İşlemler</a>
      </div>
      <!-- /.card-footer -->
    </div>
  </section>
  <!-- /.Left col -->

</div>
<!-- /.row (main row) -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection()