@extends('master.app')

@section('cssStyle')
<!-- <link rel="stylesheet" href="/style/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css"> -->
@endsection

@section('jsStyle')
<!-- <link rel="stylesheet" href="/style/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css"> -->
@endsection

@section('iconHeader')
<i class="ik ik-shopping-cart bg-blue"></i>
@endsection

@section('titleHeader')
Order
@endsection

@section('subtitleHeader')
Detail Order
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Order</a></li>
<li class="breadcrumb-item active" aria-current="page">Detail Order</li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12" style="margin-bottom:20%">
        <div class="card">
            <div class="card-header"><h3 class="d-block w-100">TokoKita<small class="float-right">Date: {{$order['orderDateTime']}}</small></h3></div>
            <div class="card-body">
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>TokoKita</strong><br>Tangerang Selatan Perum PERURI No 29<br>Phone: (123) 123-4567<br>Email: tokokita@mzid.co
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <strong>{{$order['name']}}</strong><br>{{$order['address']}}<br>Phone: {{$order['phone']}}<br>Email: {{$order['userEmail']}}
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b class="text-uppercase">Invoice #{{$order->id()}}</b><br>
                        <br>
                        <b>Status:</b>
                        @if($order['status'] == 'Unconfirmed')
                        <span class="badge badge-warning badge-pill">{{$order['status']}}</span>
                        @elseif($order['status'] == 'Confirmed')
                        <span class="badge badge-primary badge-pill">{{$order['status']}}</span>
                        @elseif($order['status'] == 'Invalid')
                        <span class="badge badge-pill" style="background-color:#ffc107; color:#fff;">{{$order['status']}}</span>
                        @elseif($order['status'] == 'Delivered')
                        <span class="badge badge-info badge-pill">{{$order['status']}}</span>
                        @elseif($order['status'] == 'Success')
                        <span class="badge badge-success badge-pill">{{$order['status']}}</span>
                        @elseif($order['status'] == 'Failed')
                        <span class="badge badge-danger badge-pill">{{$order['status']}}</span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Barang</th>
                                    <th>Kategori</th>
                                    <th>Gambar</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($itemsOrder as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$item['product_code']}}</td>
                                    <td>{{$item['product_name']}}</td>
                                    <td>{{$item['product_category']}}</td>
                                    <td>
                                        @if($item['product_image'])
                                        <img width="50" height="50" src="{{asset($item['product_image'])}}">
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>IDR {{number_format($item['product_price'], 0, "," , ".")}}</td>
                                    <td>{{$item['product_qty']}}</td>
                                    <td>IDR {{number_format($item['product_cost'], 0, "," , ".")}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <!-- <p class="lead">Payment Methods:</p>
                        <img src="../img/credit/visa.png" alt="Visa">
                        <img src="../img/credit/mastercard.png" alt="Mastercard">
                        <img src="../img/credit/american-express.png" alt="American Express">
                        <img src="../img/credit/paypal2.png" alt="Paypal"> -->
                        
                        <div class="alert alert-secondary mt-20">                
                        @if($order['status'] == 'Unconfirmed')
                        Pesanan belum dikonfirmasi
                        @elseif($order['status'] == 'Confirmed')
                        Pesanan telah dikonfirmasi
                        @elseif($order['status'] == 'Invalid')
                        Pembeli belum memenuhi persyaratan
                        @elseif($order['status'] == 'Delivered')
                        Pesanan dalam proses pengiriman
                        @elseif($order['status'] == 'Success')
                        Pesanan sukses. Pesanan telah sampai pada tujuan.
                        @elseif($order['status'] == 'Failed')
                        Pesanan gagal.
                        @endif
                        <br><br>
                        <strong>Catatan:</strong>
                        @if($order['note'] == '-')
                        -
                        @else
                        <br><i>{{$order['note']}}</i>
                        @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Total Harga:</th>
                                    <td>IDR {{number_format($order['totalOrder'], 0, "," , ".")}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row no-print">
                    <div class="col-12">
                        <!-- <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                        <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
@endsection
