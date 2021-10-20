@extends('master.app')

@section('cssStyle')
@endsection

@section('jsStyle')
<script src="/style/js/datatables.js"></script>
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
                    <table id="multi-colum-dt"
                        class="table table-striped table-bordered nowrap dataTables_wrapper dt-bootstrap4 data-table">
                        
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
                                    <a href="#" data-productName="{{$product['product_name']}}" id="showProduct" class="btn btn-info" style="width:35px;"
                                            data-toggle="modal" data-target="#productModal" data-code="{{$product['product_code']}}" data-name="{{$product['product_name']}}" data-category="{{$category['category_name']}}" data-image="{{$product['product_image']}}" data-price="IDR {{$product['product_price']}}" data-desc="{{$product['product_desc']}}" data-stock="{{$product['product_stock']}}"><i class="ik ik-eye"></i></a>
                                            <!-- modal -->
                                    <div class="modal fade" id="productModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLongLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongLabel">Data barang</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- modal content -->
                                                    <p id="productCode"></p>
                                                    <p id="productName"></p>
                                                    <img src="" id="productImage">
                                                    <p id="productCategory"></p>
                                                    <p id="productPrice"></p>
                                                    <p id="productDesc"></p>
                                                    <p id="productStock"></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary"
                                                        data-dismiss="modal">OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="/product/{{$product->id()}}/edit"><button type="button"
                                            class="btn btn-warning"
                                            style="background-color:#ffc107; border:none; width:35px;"><i
                                                class="ik ik-edit iconT"></i></button></a>
                                    <a href="/product/{{$product->id()}}/delete"><button type="button"
                                            class="btn btn-danger" style="width:35px;"><i
                                                class="ik ik-trash-2 iconT"></i></button></a>
                                </td>
                            </tr>
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
@section('script')
<script type="text/javascript">
    $(document).on('click', '#showProduct', function (event) {
        let product_code = $(this).attr('data-code');
        let product_name = $(this).attr('data-name');
        let product_image = $(this).attr('data-image');
        let product_category = $(this).attr('data-category');
        let product_price = $(this).attr('data-price');
        let product_desc = $(this).attr('data-desc');
        let product_stock = $(this).attr('data-stock');

        // set nilai
        document.getElementById('productCode').innerHTML = product_code;
        document.getElementById('productName').innerHTML = product_name;
        $('#productImage').attr('src', 'http://127.0.0.1:8000/' + product_image);
        document.getElementById('productCategory').innerHTML = product_category;
        document.getElementById('productPrice').innerHTML = product_price;
        document.getElementById('productDesc').innerHTML = product_desc;
        document.getElementById('productStock').innerHTML = product_stock;
    });

</script>
@endsection

@endsection
@section('fixedButton')
<a class="fixedButtonRefresh">
    <button data-toggle="tooltip" data-placement="top" title="" type="" class="btn btn-icon btn-secondary "
        onclick="window.location.reload();" data-original-title="Refresh">
        <i class="ik ik-refresh-ccw"></i>
    </button>
</a>
<a class="fixedButtonAdd" href="{{route('product.create')}}">
    <button data-toggle="tooltip" data-placement="top" title="" href="" class="btn btn-icon btn-info"
        data-original-title="Tambah">
        <i class="ik ik-plus"></i>
    </button>
</a>
@endsection
