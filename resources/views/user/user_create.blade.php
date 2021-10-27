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
Tambah User Admin
@endsection

@section('subtitleHeader')
Pembuatan Data User Admin
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">User</a></li>
<li class="breadcrumb-item active" aria-current="page">Tambah User Admin</li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12" style="margin-bottom:20%">
        <div class="card">
            <div class="box-body" style="padding-bottom:50px">
                <form id="add-user-form" class="text-left border border-light p-5" enctype="multipart/form-data" action="{{route('user.store')}}" method="POST" style="padding-bottom: 50px;">
                @if(session('failed'))
                <div class="alert alert-danger alert-dismissible mb-2 text-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{session('failed')}}
                </div>
                @endif
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control form-control-capitalize " placeholder="Nama" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
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
                            <input type="text" class="form-control form-control-capitalize " placeholder="Telepon" name="phone" required>
                        </div>
                    </div>
                    <div class=" form-group">
                        <label for="exampleFormControlSelect1">Role</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="role">
                            <option>Admin</option>
                            <option>Super Admin</option>
                            
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label>Foto Profil</label>
                        <input type="file" class="form-control" placeholder="Company name" name="image" required="required">
                    </div> -->
                    <!-- <div class="form-group">
                        <label>Deskripsi Kategori</label>
                        <textarea name="category_desc" class="form-control html-editor" rows="5"></textarea>
                    </div> -->
                    <div class="footer-buttons">
                        <a class="fixedButtonRefresh" href="">
                            <button data-toggle="tooltip" data-placement="top" title="" type="button" class="btn btn-icon btn-secondary " data-original-title="Kembali">
                                <i class="ik ik-arrow-left"></i>
                            </button>
                        </a>
                        <a class="fixedButtonAdd" href="">
                            <button onclick="return false" id="add-user" data-toggle="tooltip" type="submit" data-placement="top" title="" href="{{route('user.index')}}" class="btn btn-icon btn-info" data-original-title="Tambah">
                                <i class="ik ik-save"></i>
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#add-user').on('click', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        var name = $(this).attr('data-name');
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 12000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'info',
            title: 'Tunggu sebentar, penambahan data sedang berlangsung'
        })
        $('#add-user-form').submit();
    });
</script>
@endsection