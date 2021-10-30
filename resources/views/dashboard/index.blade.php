@extends('master.app')

@section('iconHeader')
<i class="ik ik-home bg-blue"></i>
@endsection

@section('titleHeader')
Home
@endsection

@section('subtitleHeader')
Halaman Dashboard
@endsection

@section('breadcrumb')

@endsection

@section('content')

<div class="row clearfix">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="widget">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h6>Product</h6>
                        <h2>1,410</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-award"></i>
                    </div>
                </div>
                <small class="text-small mt-10 d-block">6% higher than last month</small>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="widget">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h6>Likes</h6>
                        <h2>41,410</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-thumbs-up"></i>
                    </div>
                </div>
                <small class="text-small mt-10 d-block">61% higher than last month</small>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="widget">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h6>Events</h6>
                        <h2>410</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-calendar"></i>
                    </div>
                </div>
                <small class="text-small mt-10 d-block">Total Events</small>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100" style="width: 31%;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="widget">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h6>Comments</h6>
                        <h2>41,410</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-message-square"></i>
                    </div>
                </div>
                <small class="text-small mt-10 d-block">Total Comments</small>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
            </div>
        </div>
    </div>
    @if(Auth::check())
    <?php
    $user_login = DB::table('users')->where('id', Auth::id())->first();
    ?>
    @endif
    <!-- <div class="container">
        <img src="{{asset('storage/'.$user_login->image)}}" alt="" class="profile-img">

        <div class="content">
            <div class="sub-content">
                <h1>{{$user_login->name}}</h1>
                <span>{{$user_login->role}}</span>
                <p>Professional tennis player</p>
                <span class="location"><i class="fa fa-map-marker" aria-hidden="true"></i>Switzerland</span>
                <a href="http://www.rogerfederer.com/">rogerfederer.com</a>
            </div>
            <div class="data">
                <div class="inner-data">
                    <span><i class="fa fa-users" aria-hidden="true"></i></span>
                    <p>11M</p>
                </div>
                <div class="inner-data">
                    <span><i class="fa fa-twitter-square" aria-hidden="true"></i></span>
                    <p>1,470</p>
                </div>
                <div class="inner-data">
                    <span><i class="fa fa-user-plus" aria-hidden="true"></i></span>
                    <p>80</p>
                </div>
            </div>
            <div class="btn">follow me</div>
        </div>
    </div> -->
    <div class="col-lg-3 ">
        <div class="card-pro" data-state="#about">
            <div class="card-header-pro">
                <div class="card-cover-pro" style="background-image: url('https://images.unsplash.com/photo-1549068106-b024baf5062d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=934&q=80')"></div>
                <img class="card-avatar-pro" src="{{asset('storage/'.$user_login->image)}}" alt="avatar" />
                <h1 class="card-fullname-pro">{{$user_login->name}}</h1>
                <h2 class="card-jobtitle-pro">{{$user_login->role}}</h2>
            </div>
            <div class="card-main-pro">
                <div class="card-content-pro">
                    <div class="card-subtitle">Created on</div>
                    <p class="card-desc-pro">{{ date('F d, Y', strtotime($user_login->created_at)) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class=" lol">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap dataTables_wrapper dt-bootstrap4 data-table">
                                <thead>
                                    <tr>
                                        <th>Kode transaksi</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Total Pembelian</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td class="text-uppercase">#{{$order->id()}}</td>
                                        <td>{{$order['name']}}</td>
                                        <td>{{$order['userEmail']}}</td>
                                        <td>IDR {{number_format($order['totalOrder'], 0, "," , ".")}}</td>
                                        <td>{{$order['orderDateTime']}}</td>
                                        <td>
                                            @if($order['status'] == 'Unconfirmed')
                                            <span class="badge badge-warning badge-pill">{{$order['status']}}</span>
                                            @elseif($order['status'] == 'Confirmed')
                                            <span class="badge badge-primary badge-pill">{{$order['status']}}</span>
                                            @elseif($order['status'] == 'Delivered')
                                            <span class="badge badge-info badge-pill">{{$order['status']}}</span>
                                            @elseif($order['status'] == 'Success')
                                            <span class="badge badge-success badge-pill">{{$order['status']}}</span>
                                            @elseif($order['status'] == 'Failed')
                                            <span class="badge badge-danger badge-pill">{{$order['status']}}</span>
                                            @endif
                                        </td>
                                        <td align="center">
                                            <a href="/order/{{$order->id()}}/show" target="_blank" class="btn btn-info" style="width:35px;"><i class="ik ik-eye"></i></a>

                                            <a href="#" id="showProduct" class="btn btn-warning" style="width:35px; background-color:#ffc107; border:none;" data-toggle="modal" data-target="#order-edit{{$order->id()}}"><i class="ik ik-edit"></i></a>
                                            <!-- modal -->
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="order-edit{{$order->id()}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongLabel">Transaksi #{{$order->id()}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>

                                                <div class="modal-body">
                                                    <!-- modal content -->

                                                    <div class="form-group">
                                                        <label>Kode Transaksi</label>
                                                        <input type="text" class="form-control form-control text-uppercase " placeholder="Kode Kategori" value="#{{$order->id()}}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pemesan</label>
                                                        <input type="text" class="form-control form-control-capitalize " placeholder="Kode Kategori" value="{{$order['name']}}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>email</label>
                                                        <input type="text" class="form-control " placeholder="Kode Kategori" value="{{$order['userEmail']}}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Total Pembelian</label>
                                                        <input type="text" class="form-control form-control-capitalize " placeholder="Kode Kategori" value="IDR {{number_format($order['totalOrder'], 0, "," , ".")}}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nomor Telepon</label>
                                                        <input type="text" class="form-control form-control-capitalize " placeholder="Kode Kategori" value="{{$order['phone']}}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <textarea class="form-control html-editor" rows="2" readonly>{{$order['address']}}</textarea>
                                                    </div>
                                                    <h4 class="sub-title">Status</h4>
                                                    <div class="form-radio mb-30">
                                                        <form style="margin:0px; padding:0px;" action="{{route('order.update', $order->id())}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="radio radiofill radio-warning radio-inline">
                                                                <label>
                                                                    <input type="radio" name="status" value="Unconfirmed" {{$order['status'] == 'Unconfirmed' ? 'checked' : ' '}}>
                                                                    <i class="helper"></i>Unconfirmed
                                                                </label>
                                                            </div>
                                                            <div class="radio radiofill radio-primary radio-inline">
                                                                <label>
                                                                    <input type="radio" name="status" value="Confirmed" {{$order['status'] == 'Confirmed' ? 'checked' : ' '}}>
                                                                    <i class="helper"></i>Confirmed
                                                                </label>
                                                            </div>
                                                            <div class="radio radiofill radio-info radio-inline">
                                                                <label>
                                                                    <input type="radio" name="status" value="Delivered" {{$order['status'] == 'Delivered' ? 'checked' : ' '}}>
                                                                    <i class="helper"></i>Delivered
                                                                </label>
                                                            </div>
                                                            <div class="radio radiofill radio-success radio-inline">
                                                                <label>
                                                                    <input type="radio" name="status" value="Success" {{$order['status'] == 'Success' ? 'checked' : ' '}}>
                                                                    <i class="helper"></i>Success
                                                                </label>
                                                            </div>
                                                            <div class="radio radiofill radio-danger radio-inline">
                                                                <label>
                                                                    <input type="radio" name="status" value="Failed" {{$order['status'] == 'Failed' ? 'checked' : ' '}}>
                                                                    <i class="helper"></i>Failed
                                                                </label>
                                                            </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Catatan (Opsional)</label>
                                                        @if($order['note'] == '-')
                                                        <textarea class="form-control html-editor" name="note" rows="2" placeholder="Masukkan catatan keterangan berdasarkan status dari pembeli"></textarea>
                                                        @else
                                                        <textarea class="form-control html-editor" name="note" rows="2" placeholder="Masukkan catatan keterangan berdasarkan status dari pembeli">{{$order['note']}}</textarea>
                                                        @endif


                                                    </div>
                                                </div>
                                                </form>
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
    </div>
</div>
<script>
    const buttons = document.querySelectorAll(".card-buttons button");
    const sections = document.querySelectorAll(".card-section");
    const card = document.querySelector(".card");

    const handleButtonClick = (e) => {
        const targetSection = e.target.getAttribute("data-section");
        const section = document.querySelector(targetSection);
        targetSection !== "#about" ?
            card.classList.add("is-active") :
            card.classList.remove("is-active");
        card.setAttribute("data-state", targetSection);
        sections.forEach((s) => s.classList.remove("is-active"));
        buttons.forEach((b) => b.classList.remove("is-active"));
        e.target.classList.add("is-active");
        section.classList.add("is-active");
    };

    buttons.forEach((btn) => {
        btn.addEventListener("click", handleButtonClick);
    });
</script>
@endsection