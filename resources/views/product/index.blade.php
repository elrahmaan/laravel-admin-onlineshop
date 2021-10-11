@extends('master.app')

@section('cssStyle')
<link rel="stylesheet" href="/style/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
@endsection

@section('jsStyle')
<link rel="stylesheet" href="/style/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h3>Data Table</h3></div>
            <div class="card-body">
                <table id="data_table" class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th class="nosort">Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="nosort">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>001</td>
                            <td><img src="../img/users/1.jpg" class="table-user-thumb" alt=""></td>
                            <td>Erich Heaney</td>
                            <td>erich@example.com</td>
                            <td>
                                <div class="table-actions">
                                    <a href="#"><i class="ik ik-eye"></i></a>
                                    <a href="#"><i class="ik ik-edit-2"></i></a>
                                    <a href="#"><i class="ik ik-trash-2"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>002</td>
                            <td><img src="../img/users/2.jpg" class="table-user-thumb" alt=""></td>
                            <td>Abraham Douglas</td>
                            <td>jgraham@example.com</td>
                            <td>
                                <div class="table-actions">
                                    <a href="#"><i class="ik ik-eye"></i></a>
                                    <a href="#"><i class="ik ik-edit-2"></i></a>
                                    <a href="#"><i class="ik ik-trash-2"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>003</td>
                            <td><img src="../img/users/3.jpg" class="table-user-thumb" alt=""></td>
                            <td>Roderick Simonis</td>
                            <td>grant.simonis@example.com</td>
                            <td>
                                <div class="table-actions">
                                    <a href="#"><i class="ik ik-eye"></i></a>
                                    <a href="#"><i class="ik ik-edit-2"></i></a>
                                    <a href="#"><i class="ik ik-trash-2"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>004</td>
                            <td><img src="../img/users/4.jpg" class="table-user-thumb" alt=""></td>
                            <td>Christopher Henry</td>
                            <td>henry.chris@example.com</td>
                            <td>
                                <div class="table-actions">
                                    <a href="#"><i class="ik ik-eye"></i></a>
                                    <a href="#"><i class="ik ik-edit-2"></i></a>
                                    <a href="#"><i class="ik ik-trash-2"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>005</td>
                            <td><img src="../img/users/5.jpg" class="table-user-thumb" alt=""></td>
                            <td>Sonia Wilkinson</td>
                            <td>boyle.aglea@example.com</td>
                            <td>
                                <div class="table-actions">
                                    <a href="#"><i class="ik ik-eye"></i></a>
                                    <a href="#"><i class="ik ik-edit-2"></i></a>
                                    <a href="#"><i class="ik ik-trash-2"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection