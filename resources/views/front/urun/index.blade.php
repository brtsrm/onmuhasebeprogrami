@extends("front.master.master")
@section("title","Ürün")
@section("content")

<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Ad</th>
                    <th>Alış Fiyatı</th>
                    <th>Satış Fiyatı</th>
                    <th>Stok</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section("footer")
<script src="{{asset("/")}}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset("/")}}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset("/")}}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset("/")}}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset("/")}}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset("/")}}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset("/")}}plugins/jszip/jszip.min.js"></script>
<script src="{{asset("/")}}plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset("/")}}plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset("/")}}plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset("/")}}plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset("/")}}plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "serverSide": true,
                ajax: {
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                    url: '{{route('urun.data')}}',
                    data: function (d) {
                    }
                },
                columns: [
                    {data: 'urun_adi', name: 'urun_adi'},
                    {data: 'alis_fiyati', name: 'alis_fiyati'},
                    {data: 'satis_fiyati', name: 'satis_fiyati'},
                    {data: 'stok', name: 'stok'},
                    {data: 'edit', name: 'edit', orderable: false, searchable: false},
                    {data: 'delete', name: 'delete', orderable: false, searchable: false},
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-12:eq(0)');
        });
</script>
@endsection