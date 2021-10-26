@extends('master.app')

@section('cssStyle')
@endsection

@section('jsStyle')
<script src="/style/js/datatables.js"></script>
<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const ofReader = new FileReader();
        ofReader.readAsDataURL(image.files[0]);

        ofReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection

@section('iconHeader')
<i class="ik ik-box bg-blue"></i>
@endsection

@section('titleHeader')
Product
@endsection

@section('subtitleHeader')
Halaman Data Barang
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Product</li>
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
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $no=1; @endphp
                            @foreach($products as $product)
                            @foreach($categories as $category)
                            @if($product['product_category']==$category['category_name'])
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$product['product_code']}}</td>
                                <td>{{$product['product_name']}}</td>
                                <td>{{$category['category_name']}}</td>
                                <td>IDR {{$product['product_price']}}</td>
                                <td>{{$product['product_stock']}}</td>
                                <td align="center">
                                    <a href="#" data-productName="{{$product['product_name']}}" id="showProduct" class="btn btn-info" style="width:35px;" data-toggle="modal" data-target="#productModal{{$product->id()}}"><i class="ik ik-eye"></i></a>
                                    <a href="/product/{{$product->id()}}/edit"><button type="button" class="btn btn-warning" style="background-color:#ffc107; border:none; width:35px;"><i class="ik ik-edit iconT"></i></button></a>
                                    <a href="#"><button type="button" class="btn btn-danger deleteProduct" data-id="{{$product->id()}}" data-name="{{$product['product_name']}}" style="width:35px;"><i class="ik ik-trash-2 iconT"></i></button></a>
                                </td>
                            </tr>
                            <!-- modal -->
                            <div class="modal fade" id="productModal{{$product->id()}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongLabel">Data barang</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- modal content -->
                                            <div class="form-group">
                                                <label>Kode Produk</label>
                                                <input type="text" class="form-control form-control text-uppercase " placeholder="Kode Kategori" value="{{$product['product_code']}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Produk</label>
                                                <input type="text" class="form-control form-control-capitalize " placeholder="Kode Kategori" value="{{$product['product_name']}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Kategori Produk</label>
                                                <input type="text" class="form-control " placeholder="Kode Kategori" value="{{$product['product_category']}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga Produk</label>
                                                <input type="text" class="form-control form-control-capitalize " placeholder="Kode Kategori" value="IDR {{number_format($product['product_price'], 0, "," , ".")}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Gambar Produk</label>
                                                <img src="{{asset($product['product_image'])}}" class="img-preview img-fluid mb-3 col-sm-3 d-block">
                                            </div>
                                            <div class="form-group">
                                                <label>Stok Produk</label>
                                                <input type="text" class="form-control form-control-capitalize " placeholder="Kode Kategori" value="{{$product['product_stock']}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi Produk</label>
                                                <textarea class="form-control html-editor" rows="5" readonly>{{$product['product_desc']}}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sweet Alert Delete -->
<script>
    $('.deleteProduct').click(function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        Swal.fire({
            title: 'Are you sure?',
            text: "Want to delete product " + name + " ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
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
                    icon: 'success',
                    title: 'Product has been removed'
                })
                window.location = "/product/" + id + "/delete"
            }
        })
    })
</script>
<!-- End Sweet Alert Delete -->

@endsection

@section('fixedButton')
<a class="fixedButtonRefresh">
    <button data-toggle="tooltip" data-placement="top" title="" type="" class="btn btn-icon btn-secondary " onclick="window.location.reload();" data-original-title="Refresh">
        <i class="ik ik-refresh-ccw"></i>
    </button>
</a>
<a class="fixedButtonAdd" href="{{route('product.create')}}">
    <button data-toggle="tooltip" data-placement="top" title="" href="" class="btn btn-icon btn-info" data-original-title="Tambah">
        <i class="ik ik-plus"></i>
    </button>
</a>
<!-- <a class="fixedButtonAdd" href="#">
    <button data-toggle="modal" data-target="#productCreate" data-placement="top" title="" href="" class="btn btn-icon btn-info"
        data-original-title="Tambah">
        <i class="ik ik-plus"></i>
    </button>
</a> -->
<div class="modal fade" id="productCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongLabel">Tambah Data barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- modal content -->
                <form style="margin:0px; padding:0px;" enctype="multipart/form-data" action="{{route('order.store')}}" method="POST">
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" class="form-control form-control-capitalize " placeholder="Kode Barang" value="" name="product_code" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control form-control-capitalize " placeholder="Nama Barang" value="" name="product_name" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori Barang</label>
                        <select name="product_category" class="select2 form-control" id="categoryInput">
                            @foreach($categories as $category)
                            <option value="{{$category['category_name']}}">{{$category['category_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga Barang</label>
                        <input type="number" class="form-control form-control-capitalize " placeholder="ex: 100000" value="" name="product_price" required>
                    </div>
                    <div class="form-group">
                        <label>Gambar Barang</label>
                        <img class="img-preview img-fluid mb-3 col-sm-3">
                        <input type="file" class="form-control form-control-capitalize" id="image" name="product_image" style="padding:4px;" onchange="previewImage()" required>
                    </div>
                    <div class="form-group">
                        <label>Stok Barang</label>
                        <input type="number" class="form-control form-control-capitalize " placeholder="ex: 15" value="" name="product_stock" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Barang</label>
                        <textarea name="product_desc" class="form-control html-editor" rows="3" required></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection