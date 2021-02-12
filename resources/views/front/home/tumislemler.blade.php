@extends("front.master.master")
@section("title","Tüm işlemler")
@section("content")

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Tüm İşlemler</h3>

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