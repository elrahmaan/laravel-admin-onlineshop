@extends('master.app')

@section('cssStyle')
<link rel="stylesheet" href="/style/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
@endsection

@section('jsStyle')
<link rel="stylesheet" href="/style/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
@endsection

@section('iconHeader')
<i class="ik ik-users bg-blue"></i>
@endsection

@section('titleHeader')
User
@endsection

@section('subtitleHeader')
Halaman Data User
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">User</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-body">
                    <table id="multi-colum-dt" class="table table-striped table-bordered nowrap dataTables_wrapper dt-bootstrap4 data-table">

                        <thead>
                            <tr>
                                <th>Id</th>
                                <!-- <th class="nosort">Avatar</th> -->
                                <th>Name</th>
                                <th>Email</th>
                                <th>Aksi</th>
                                <!-- <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th> -->
                            </tr>
                        </thead>

                        <tbody>
                            @php $no=1; @endphp
                            @foreach($users as $user)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td align="center">
                                    <a><button type="button" class="btn btn-info" style="width:35px;" data-toggle="modal" data-target="#productModal"><i class="ik ik-eye"></i></button></a>
                                    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{$user->name}}</p>
                                                    <p>{{$user->email}}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="/user/{{$user->id}}/edit"><button type="button" class="btn btn-warning" style="background-color:#ffc107; border:none; width:35px;"><i class="ik ik-edit iconT"></i></button></a>
                                    <a href="/user/{{$user->id}}/delete"><button type="button" class="btn btn-danger" style="width:35px;"><i class="ik ik-trash-2 iconT"></i></button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var name = $(this).data('name');
            var email = $(this).data('email');
            $('#name').val(name);
            $('#email').val(email);
            $('#productModal').modal('hide');
        })
    })
</script> -->

<script type="text/javascript">
    $(document).ready(function() {

        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            "initComplete": function(settings, json) {
                $("#dataTable").wrap(
                    "<div class='scroll' style='overflow:auto; width:100%;position:relative;padding-left:20px;padding-bottom:20px'></div>"
                );
            },
            ajax: "{{ route('user.index') }}",
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        table.columns().eq(0).each(function(colIdx) {
            $('input', table.column(colIdx).footer()).on('keyup change', function() {
                console.log(colIdx + '-' + this.value);
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });
        });
    });
</script>

@endsection
@section('fixedButton')
<a class="fixedButtonRefresh">
    <button data-toggle="tooltip" data-placement="top" title="" type="" class="btn btn-icon btn-secondary " onclick="window.location.reload();" data-original-title="Refresh">
        <i class="ik ik-refresh-ccw"></i>
    </button>
</a>
<a class="fixedButtonAdd" href="{{route('user.create')}}">
    <button data-toggle="tooltip" data-placement="top" title="" href="" class="btn btn-icon btn-info" data-original-title="Tambah">
        <i class="ik ik-plus"></i>
    </button>
</a>
@endsection