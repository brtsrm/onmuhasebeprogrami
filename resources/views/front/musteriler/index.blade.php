@extends("front.master.master")
@section("title","Müşteriler")
@section("content")

<div class="card">
    <div class="card-header">
        <h3 class="card-title">DataTable with default features</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Ad</th>
                    <th>Müşteri Tipi</th>
                    <th>Bakiye</th>
                    <th>Extre</th>
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
                    url: '{{route('musteriler.data')}}',
                    data: function (d) {
                    }
                },
                columns: [
                    {data: 'publicname', name: 'publicname'},
                    {data: 'musteritipi', name: 'musteritipi'},
                    {data: 'bakiye', name: 'bakiye'},
                    {data: 'extre', name: 'extre'},
                    {data: 'edit', name: 'edit', orderable: false, searchable: false},
                    {data: 'delete', name: 'delete', orderable: false, searchable: false},
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-12:eq(0)');
        
        });


</script>
@endsection