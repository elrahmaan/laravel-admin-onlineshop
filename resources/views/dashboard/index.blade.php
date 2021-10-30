@extends('master.app')

@section('iconHeader')
<i class="ik ik-bar-chart-2 bg-blue"></i>
@endsection

@section('titleHeader')
Dashboard
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
                        <h6>Kategori Produk</h6>
                        <h2>{{$countCategories}}</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-list"></i>
                    </div>
                </div>
                <!-- <small class="text-small mt-10 d-block">6% higher than last month</small> -->
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="widget">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h6>Produk</h6>
                        <h2>{{$countProducts}}</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-box"></i>
                    </div>
                </div>
                <!-- <small class="text-small mt-10 d-block">61% higher than last month</small> -->
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="widget">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h6>User Customer</h6>
                        <h2>{{$countUsers}}</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-users"></i>
                    </div>
                </div>
                <!-- <small class="text-small mt-10 d-block">Total Events</small> -->
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="widget">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h6>Order & Transaksi</h6>
                        <h2>{{$countOrders}}</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-shopping-cart"></i>
                    </div>
                </div>
                <!-- <small class="text-small mt-10 d-block">Total Comments</small> -->
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-3 ">
        <div class="card-pro" data-state="#about">
        
            <h5 class="pt-3 pl-3" style="z-index:1; color:#000;"><strong>Glad to see you! </strong></h5>
            <div class="card-header-pro mb-2">
                <div class="card-cover-pro" style="background-image: url('https://images.unsplash.com/photo-1549068106-b024baf5062d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=934&q=80')"></div>
                <img class="card-avatar-pro" src="{{url('images/user.png')}}" alt="avatar" />
                <h1 class="card-fullname-pro">{{Auth::user()->name}}</h1>
                <h2 class="card-jobtitle-pro">{{Auth::user()->role}}</h2>
            </div>
            <!-- <div class="card-main-pro"> -->
                <!-- <div class="card-content-pro"> -->
            <div class="div px-3">
                <div class="card-subtitle">Aktif sejak <span class="badge badge-pill badge-success">Online</span></div>
                <p class="card-desc-pro">{{ date('F d, Y', strtotime(Auth::user()->created_at)) }}
                </p>
            </div>
                <!-- </div> -->
            <!-- </div> -->
        </div>
    </div>
    <div class="col-sm-5 px-2">
        <div class="widget">
            <div class="widget-body">
                <h4 class="mb-0"><strong>Total Penjualan</strong></h5>
                <small><p>Per {{$requestYear}}</p></small>
                <br><br>
                <div class="row align-items-center mt-4">
                    <div class="col-8">
                        <h3 class="fw-700 text-blue">IDR {{number_format($totalOrder, 0, "," , ".")}}</h3>
                        <small class="mb-0">Dihitung berdasarkan transaksi yang sukses</small>
                    </div>
                    <div class="col-4 text-right">
                        <img src="{{ url('images/trophy.png') }}" class="header-brand-img"
                            alt="lavalite" width="100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 md-2 px-2">
        <div class="card mb-3">
            <div class="card-body text-center">
                <i class="ik ik-check-circle" style="font-size: 50px; color: #2ecc71;"></i><br>
                <!-- <img src="{{ url('assets/admin/images/money.png') }}" width="25%" class="mb-2"><br> -->
                <a style="">Pesanan Sukses</a>
                <p class="mb-0" style=""><b>{{$orderSuccess}}</b></p>
            </div>
        </div>
        <div class="card">
            <div class="card-body text-center"> 
            <i class="ik ik-truck" style="font-size: 50px; color: #3498db;"></i><br>
                <!-- <img src="{{ url('assets/admin/images/group-icon.png') }}" width="25%" class="mb-2"><br> -->
                <a style="">Pesanan dikirim</a>
                <p class="mb-0" style=""><b>{{$orderDelivered}}</b></p>
                
            </div>
        </div>
    </div>
    <div class="col-lg-2 px-2">
        <div class="card mb-3">
            <div class="card-body text-center">
                <i class="ik ik-alert-circle" style="font-size: 50px; color:#ffc107;"></i><br>
                <!-- <img src="{{ url('assets/admin/images/money.png') }}" width="25%" class="mb-2"><br> -->
                <a style="font-size: 0.7rem">Belum dikonfirmasi</a>
                <p class="mb-0" style=""><b>{{$orderUnconfirmed}}</b></p>
            </div>
        </div>
        <div class="card">
            <div class="card-body text-center">
            <i class="ik ik-gift" style="font-size: 50px;"></i><br>
                <!-- <img src="{{ url('assets/admin/images/label-icon.jpg') }}" width="25%" class="mb-2"><br> -->
                <a style="">Pesanan Diproses</a>
                <p class="mb-0" style=""><b>{{$orderConfirmed}}</b></p>
            </div>
        </div>
    </div>
</div>
@endsection