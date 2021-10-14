@extends('master.app')

@section('cssStyle')
<link rel="stylesheet" href="/style/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
@endsection

@section('jsStyle')
<link rel="stylesheet" href="/style/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
@endsection

@section('iconHeader')
<i class="ik ik-users bg-blue"></i>
@endsection

@section('titleHeader')
User
@endsection

@section('subtitleHeader')
Halaman Data User
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">User</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Data Table</h3>
            </div>
            <div class="card-body">
                <table id="data_table" class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <!-- <th class="nosort">Avatar</th> -->
                            <th>Name</th>
                            <th>Email</th>
                            <th class="nosort">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach($users as $u)
                        <tr>
                            <td>{{$no++}}</td>
                            <!-- <td><img src="../img/users/1.jpg" class="table-user-thumb" alt=""></td> -->
                            <td>{{$u->name}}</td>
                            <td>{{$u->email}}</td>
                            <td>
                                <div class="table-actions">
                                    <a href="#"><i class="ik ik-eye"></i></a>
                                    <a href="#"><i class="ik ik-edit-2"></i></a>
                                    <a href="#"><i class="ik ik-trash-2"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection