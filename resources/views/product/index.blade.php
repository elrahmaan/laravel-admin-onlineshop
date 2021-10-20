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
                                            data-toggle="modal" data-target="#productModal{{$product->id()}}"><i class="ik ik-eye"></i></a>
                                    <a href="/product/{{$product->id()}}/edit"><button type="button"
                                            class="btn btn-warning"
                                            style="background-color:#ffc107; border:none; width:35px;"><i
                                                class="ik ik-edit iconT"></i></button></a>
                                    <a href="/product/{{$product->id()}}/delete"><button type="button"
                                            class="btn btn-danger" style="width:35px;"><i
                                                class="ik ik-trash-2 iconT"></i></button></a>
                                </td>
                            </tr>
                            <!-- modal -->
                            <div class="modal fade" id="productModal{{$product->id()}}" tabindex="-1" role="dialog"
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
                                            <p>{{$product['product_code']}}</p>
                                            <p>{{$product['product_name']}}</p>
                                            <p><img src="{{asset($product['product_image'])}}"></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">OK</button>
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
