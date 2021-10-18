@extends('master.app')

@section('cssStyle')
<!-- <link rel="stylesheet" href="/style/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css"> -->
@endsection

@section('jsStyle')
<!-- <link rel="stylesheet" href="/style/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css"> -->
@endsection

@section('iconHeader')
<i class="ik ik-box bg-blue"></i>
@endsection

@section('titleHeader')
Tambah Barang
@endsection

@section('subtitleHeader')
Halaman Pembuatan Data Barang
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Product</a></li>
<li class="breadcrumb-item active" aria-current="page">Tambah Barang</li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12" style="margin-bottom:20%">
        <div class="card">
            <div class="box-body" style="padding-bottom:50px">
                <form class="text-left border border-light p-5" enctype="multipart/form-data" action="{{route('product.store')}}" method="POST" style="padding-bottom: 50px;">
                @csrf
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <div class="input-group mb-4">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control form-control-capitalize " placeholder="Kode Barang" value="" name="product_code">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <div class="input-group mb-4">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control form-control-capitalize " placeholder="Nama Barang" value="" name="product_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kategori Barang</label>
                        <div class="input-group mb-4">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <select name="product_category" class="select2 form-control" id="categoryInput">
                                @foreach($categories as $category) 
                                    <option value="{{$category['category_name']}}">{{$category['category_name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Harga Barang</label>
                        <div class="input-group mb-4">
                            <span class="input-group-prepend">
                                <label class="input-group-text">IDR</label>
                            </span>
                            <input type="number" class="form-control form-control-capitalize " placeholder="ex: 100000" value="" name="product_price">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Gambar barang</label>
                        <img class="img-preview img-fluid mb-3 col-sm-3">
                        <div class="input-group mb-4">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-upload"></i></label>
                            </span>
                            <input type="file" class="form-control form-control-capitalize" id="image" name="product_image" style="padding:4px;" onchange="previewImage()">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Stok Barang</label>
                        <div class="input-group mb-4">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="number" class="form-control form-control-capitalize " placeholder="ex: 15" value="" name="product_stock">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Barang</label>
                        <textarea name="product_desc" class="form-control html-editor" rows="3"></textarea>
                    </div>
                    
                    <div class="footer-buttons">
                    <a class="fixedButtonRefresh" href="">
                        <button data-toggle="tooltip" data-placement="top" title="" type="button"
                            class="btn btn-icon btn-secondary " data-original-title="Back">
                            <i class="ik ik-arrow-left"></i>
                        </button>
                    </a>
                    <a class="fixedButtonAdd" href="">
                        <button data-toggle="tooltip" type="submit" data-placement="top" title="" href=""
                            class="btn btn-icon btn-info" data-original-title="Tambah">
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
    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const ofReader = new FileReader();
        ofReader.readAsDataURL(image.files[0]);

        ofReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
    $(document).ready(function () {
        var db = new FirestoreClient([
        'projectId'=> 'online-shop-ce498'
        ]);
        
        database.collection('categories').once('value', function(snapshot){
        if(snapshot.exists()){
            var cat_list = '';
                snapshot.forEach(function(data){
                    var val = data.val();
                    cat_list += '<option value="' + val.category_name + '">' + val.category_name + '</option>';
                });

            $('#categoryInput').append(cat_list);

        }
    });
    
    
</script>
@endsection
