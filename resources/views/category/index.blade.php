@extends('master.app')

@section('cssStyle')
@endsection

@section('jsStyle')
<script src="/style/js/datatables.js"></script>
@endsection

@section('iconHeader')
<i class="ik ik-list bg-blue"></i>
@endsection

@section('titleHeader')
Category
@endsection

@section('subtitleHeader')
Halaman Data Kategori Barang
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Category</li>
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
                                <th>Category Code</th>
                                <!-- <th class="nosort">Avatar</th> -->
                                <th>Category Name</th>
                                <th>Category Desc</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $no=1; @endphp
                            @foreach($category as $cat)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$cat['category_code']}}</td>
                                <td>{{$cat['category_name']}}</td>
                                <td>{{$cat['category_desc']}}</td>
                                <td align="center">
                                    <a href="#" class="btn btn-info" style="width:35px;" data-toggle="modal" id="showCategory" data-target="#categoryModal{{$cat->id()}}"><i class="ik ik-eye"></i></a>
                                    <a href="/category/{{$cat->id()}}/edit"><button type="button" class="btn btn-warning" style="background-color:#ffc107; border:none; width:35px;"><i class="ik ik-edit iconT"></i></button></a>
                                    <a href="/category/{{$cat->id()}}/delete"><button type="button" class="btn btn-danger" style="width:35px;"><i class="ik ik-trash-2 iconT"></i></button></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="categoryModal{{$cat->id()}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongLabel">Data Kategori</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- modal content -->
                                            <div class="form-group">
                                                <label>Kode Kategori</label>
                                                <input type="text" class="form-control form-control text-uppercase " placeholder="Kode Kategori"
                                                        value="{{$cat['category_code']}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Kategori</label>
                                                <input type="text" class="form-control form-control-capitalize " placeholder="Kode Kategori"
                                                        value="{{$cat['category_name']}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Icon Kategori</label>
                                                <img src="{{asset($cat['category_icon'])}}" class="img-preview img-fluid mb-3 col-sm-3 d-block">
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi Kategori</label>
                                                <textarea class="form-control html-editor" rows="5" readonly>{{$cat['category_desc']}}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
@endsection
@section('fixedButton')
<a class="fixedButtonRefresh">
    <button data-toggle="tooltip" data-placement="top" title="" type="" class="btn btn-icon btn-secondary " onclick="window.location.reload();" data-original-title="Refresh">
        <i class="ik ik-refresh-ccw"></i>
    </button>
</a>
<a class="fixedButtonAdd" href="{{route('category.create')}}">
    <button data-toggle="tooltip" data-placement="top" title="" href="" class="btn btn-icon btn-info" data-original-title="Tambah">
        <i class="ik ik-plus"></i>
    </button>
</a>
@endsection