@extends('master.app')

@section('cssStyle')
@endsection

@section('jsStyle')
<script src="/style/js/datatables.js"></script>
@endsection

@section('iconHeader')
<i class="ik ik-users bg-blue"></i>
@endsection

@section('titleHeader')
User Admin
@endsection

@section('subtitleHeader')
Halaman Data User Admin
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Admin</li>
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Telp</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $no=1; @endphp
                            @foreach($users as $user)
                            <tr>
                                <td>{{$no++}}</td>
                                <td class="text-capitalize">{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->role}}</td>
                                <td align="center">
                                    @if($user->role!='Super Admin')
                                    <a href="#"><button type="button" data-toggle="modal" data-target="#editUser{{$user->id}}" class="btn btn-warning" style="background-color:#ffc107; border:none; width:35px;"><i class="ik ik-edit iconT"></i></button></a>
                                    <a href="#"><button type="button" class="btn btn-danger delete" data-id="{{$user->id}}" data-name="{{$user->name}}" style="width:35px;"><i class="ik ik-trash-2 iconT"></i></button></a>
                                    @endif
                                </td>
                                <div class="modal fade" id="editUser{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongLabel">Data Admin</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="{{route('user.update', $user->id)}}" method="POST" style="margin:0px; padding:0px;">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <div class="input-group mb-4">
                                                    <span class="input-group-prepend">
                                                        <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                                                    </span>
                                                    <input type="text" class="form-control form-control-capitalize " placeholder="Name" name="name" value="{{$user->name}}" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <div class="input-group mb-4">
                                                    <span class="input-group-prepend">
                                                        <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                                                    </span>
                                                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{$user->email}}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <div class="input-group mb-4">
                                                    <span class="input-group-prepend">
                                                        <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="Email" name="phone" value="{{$user->phone}}" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Role</label>
                                                <div class="input-group mb-4">
                                                    <span class="input-group-prepend">
                                                        <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                                                    </span>
                                                    <select name="role" class="select2 form-control" id="default-select">
                                                        <option>Admin</option>
                                                        <option>Super Admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button data-name="{{$user->name}}" type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
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
<script>
    $('.delete').click(function() {
        var userid = $(this).attr('data-id');
        var username = $(this).attr('data-name');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "ingin menghapus user '" + username + "' ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#AAAAAA',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'info',
                    title: 'Tunggu sebentar, penghapusan data sedang berlangsung'
                })
                window.location = "/user/" + userid + "/delete"
            }
        })
    });
    
</script>
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
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role'
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