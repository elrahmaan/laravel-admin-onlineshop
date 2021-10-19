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
Tambah User
@endsection

@section('subtitleHeader')
Halaman Pembuatan Data User
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">User</a></li>
<li class="breadcrumb-item active" aria-current="page">Tambah User</li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12" style="margin-bottom:20%">
        <div class="card">
            <div class="box-body" style="padding-bottom:50px">
                <form class="text-left border border-light p-5" enctype="multipart/form-data" action="{{route('user.store')}}" method="POST" style="padding-bottom: 50px;">
                    @csrf
                    <!-- <div class="form-group">
                        <label>Kode Kategori</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control form-control-capitalize " placeholder="Kode Kategori" name="category_code">
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label>Nama</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control form-control-capitalize " placeholder="Input Name" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="email" class="form-control form-control-capitalize " placeholder="Input email" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="password" class="form-control form-control-capitalize " placeholder="Input password" name="password">
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
                            <button data-toggle="tooltip" type="submit" data-placement="top" title="" href="{{route('user.index')}}" class="btn btn-icon btn-info" data-original-title="Tambah">
                                <i class="ik ik-save"></i>
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection