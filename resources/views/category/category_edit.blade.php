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
Edit Kategori Barang
@endsection

@section('subtitleHeader')
Halaman Edit Data Kategori Barang
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Category</a></li>
<li class="breadcrumb-item active" aria-current="page">Edit Kategori Barang</li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12" style="margin-bottom:20%">
        <div class="card">
            <div class="box-body" style="padding-bottom:50px">
            <form class="text-left border border-light p-5" enctype="multipart/form-data" action="{{route('category.update', $category->id())}}" method="POST" style="padding-bottom: 50px;">
                    @csrf
                    @method('PUT')
                    <input type="hidden" class="form-control form-control-capitalize " placeholder="Kode Produk"
                                name="kode" value="{{$category->id()}}" readonly>
                    <div class="form-group">
                        <label>Kode Kategori</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control form-control-capitalize " placeholder="Kode Kategori" name="category_code" value="{{$category['category_code']}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control form-control-capitalize " placeholder="Nama Kategori" name="category_name" value="{{$category['category_name']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Kategori</label>
                        <textarea name="category_desc" class="form-control html-editor" rows="5">{{$category['category_desc']}}</textarea>
                    </div>
                    <!-- <div class="form-group">
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
                        <button data-toggle="tooltip" data-placement="top" title="" type="button"
                            class="btn btn-icon btn-secondary " data-original-title="Kembali">
                            <i class="ik ik-arrow-left"></i>
                        </button>
                    </a>
                    <a class="fixedButtonAdd" href="">
                        <button data-toggle="tooltip" type="submit" data-placement="top" title="" href="{{route('category.index')}}"
                            class="btn btn-icon btn-info" data-original-title="Tambah">
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
