@extends('master.app')

@section('cssStyle')
<!-- <link rel="stylesheet" href="/style/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css"> -->
@endsection

@section('jsStyle')
<!-- <link rel="stylesheet" href="/style/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css"> -->
@endsection

@section('iconHeader')
<i class="ik ik-list bg-blue"></i>
@endsection

@section('titleHeader')
Edit User
@endsection

@section('subtitleHeader')
Halaman Edit Data User
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">User</a></li>
<li class="breadcrumb-item active" aria-current="page">Edit User</li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12" style="margin-bottom:20%">
        <div class="card">
            <div class="box-body" style="padding-bottom:50px">
                <form class="text-left border border-light p-5" enctype="multipart/form-data" action="{{route('user.update', $id)}}" method="POST" style="padding-bottom: 50px;">
                    @csrf
                    @method('PUT')
                    <input type="hidden" class="form-control form-control-capitalize " placeholder="Id" name="id" value="{{$user->id}}" readonly>
                    <div class="form-group">
                        <label>Nama</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control form-control-capitalize " placeholder="Name" name="name" value="{{$user->name}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="email" class="form-control form-control-capitalize " placeholder="Email" name="email" value="{{$user->email}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="password" class="form-control form-control-capitalize " placeholder="Password" name="password"">
                        </div>
                    </div>
                    <div class=" form-group">
                            <label for="exampleFormControlSelect1">Role</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="role">
                                <option>Administrator</option>
                                <option>Customer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Foto Profil</label>
                            <input type="file" class="form-control" placeholder="Company name" name="image" required="required">
                        </div>
                        <!-- <div class=" form-group">
                            <label>Deskripsi Kategori</label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                                </span>
                                <select name="regional_id" class="select2 form-control" id="default-select">

                                    <option value=""></option>

                                </select>
                            </div>
                        </div> -->
                        <div class="footer-buttons">
                            <a class="fixedButtonRefresh" href="">
                                <button data-toggle="tooltip" data-placement="top" title="" type="button" class="btn btn-icon btn-secondary " data-original-title="Kembali">
                                    <i class="ik ik-arrow-left"></i>
                                </button>
                            </a>
                            <a class="fixedButtonAdd" href="">
                                <button data-toggle="tooltip" type="submit" data-placement="top" title="" href="{{route('user.index')}}" class="btn btn-icon btn-info" data-original-title="Tambah">
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
@endsection