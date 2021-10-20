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
                                    <a href="#" class="btn btn-info" style="width:35px;" data-toggle="modal" id="showCategory" data-target="#categoryModal" data-code="{{$cat['category_code']}}" data-name="{{$cat['category_name']}}" data-image="{{$cat['category_icon']}}" data-desc="{{$cat['category_desc']}}"><i class="ik ik-eye"></i></a>
                                    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongLabel">Data Kategori</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- modal content -->
                                                    <p id="categoryCode"></p>
                                                    <p id="categoryName"></p>
                                                    <img src="" id="categoryIcon">
                                                    <p id="categoryClass"></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="/category/{{$cat->id()}}/edit"><button type="button" class="btn btn-warning" style="background-color:#ffc107; border:none; width:35px;"><i class="ik ik-edit iconT"></i></button></a>
                                    <a href="/category/{{$cat->id()}}/delete"><button type="button" class="btn btn-danger" style="width:35px;"><i class="ik ik-trash-2 iconT"></i></button></a>
                                </td>
                            </tr>
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
<script type="text/javascript">
    $(document).on('click', '#showCategory', function (event) {
        let category_code = $(this).attr('data-code');
        let category_name = $(this).attr('data-name');
        let category_icon = $(this).attr('data-icon');
        let category_desc = $(this).attr('data-desc');

        // set nilai
        document.getElementById('categoryCode').innerHTML = category_code;
        document.getElementById('categoryName').innerHTML = category_name;
        $('#categoryIcon').attr('src', 'http://127.0.0.1:8000/' + category_icon);
        document.getElementById('categoryDesc').innerHTML = category_desc;
    });

</script>
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