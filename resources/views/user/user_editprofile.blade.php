@extends('master.app')

@section('cssStyle')
<!-- <link rel="stylesheet" href="/style/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css"> -->
@endsection

@section('jsStyle')
<!-- <link rel="stylesheet" href="/style/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css"> -->
@endsection

@section('iconHeader')
<i class="ik ik-user bg-blue"></i>
@endsection

@section('titleHeader')
Akun
@endsection

@section('subtitleHeader')
Edit Profil
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">User</a></li>
<li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12" style="margin-bottom:20%">
        <div class="card">
            <div class="box-body">
                <form id="edit-user-form" class="text-left border border-light p-5" enctype="multipart/form-data" action="{{route('user.update', $id)}}" method="POST" style="padding-bottom: 50px;">
                @if(session('failed'))
                <div class="alert alert-danger alert-dismissible mb-2 text-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{session('failed')}}
                </div>
                @endif
                    @csrf
                    @method('PUT')
                    <input type="hidden" class="form-control form-control-capitalize " placeholder="Id" name="id" value="{{$user->id}}" required>
                    <div class="form-group">
                        <label>Nama</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control form-control-capitalize " placeholder="Name" name="name" value="{{$user->name}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{$user->email}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="password" class="form-control form-control-capitalize " placeholder="Password" name="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="password" class="form-control form-control-capitalize " placeholder="Konfirmasi Password" name="confirmPassword" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon (WA)</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control form-control-capitalize " placeholder="Telepon" name="phone" value="{{$user->phone}}" required>
                        </div>
                    </div>
                    
                    <div class=" form-group">
                        <label for="exampleFormControlSelect1">Role</label>
                        @if($user->role == 'Admin')
                        <select class="form-control" id="exampleFormControlSelect1" name="role">
                            <option>Admin</option>
                            <option>Super Admin</option>
                        </select>
                        @else
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control form-control-capitalize" name="role" value="{{$user->role}}" readonly>
                        </div>
                        @endif
                    </div>
                        <div class="footer-buttons">
                            <a class="fixedButtonRefresh" href="">
                                <button data-toggle="tooltip" data-placement="top" title="" type="button" class="btn btn-icon btn-secondary " data-original-title="Kembali">
                                    <i class="ik ik-arrow-left"></i>
                                </button>
                            </a>
                            <a class="fixedButtonAdd" href="">
                                <button onclick="return false" id="edit-user" data-name="{{$user->name}}" data-toggle="tooltip" type="submit" data-placement="top" title="" href="{{route('user.index')}}" class="btn btn-icon btn-info" data-original-title="Tambah">
                                    <i class="ik ik-save"></i>
                                </button>
                            </a>
                        </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<script>
    $('#edit-user').on('click', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        var name = $(this).attr('data-name');
        Swal.fire({
            title: 'Apa anda yakin?',
            text: "ingin mengubah data profil ?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085D6',
            cancelButtonColor: '#AAAAAA',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 10000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'info',
                    title: 'Tunggu sebentar, perubahan profil sedang berlangsung'
                })
                $('#edit-user-form').submit();
            }
        })
    });
</script>
@endsection