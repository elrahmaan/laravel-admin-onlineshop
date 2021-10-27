@extends('master.app')

@section('cssStyle')
@endsection

@section('jsStyle')
<script src="/style/js/datatables.js"></script>
@endsection

@section('iconHeader')
<i class="ik ik-shopping-cart bg-blue"></i>
@endsection

@section('titleHeader')
Order
@endsection

@section('subtitleHeader')
Halaman Data Transaksi Pemesanan
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Order</li>
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
                                <th>Kode transaksi</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Total Pembelian</th>
                                <th>Waktu</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $no=1; @endphp
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$no++}}</td>
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
                                    <a href="/order/{{$order->id()}}/show" target="_blank" class="btn btn-info" style="width:35px;"><i
                                                class="ik ik-eye"></i></a>

                                    <a href="#" id="showProduct" class="btn btn-warning" style="width:35px; background-color:#ffc107; border:none;"
                                            data-toggle="modal" data-target="#order-edit{{$order->id()}}" ><i class="ik ik-edit"></i></a>
                                            <!-- modal -->
                                </td>
                            </tr>
                            <div class="modal fade" id="order-edit{{$order->id()}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongLabel">Transaksi #{{$order->id()}}</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        </div>
                                        
                                        <div class="modal-body">
                                            <!-- modal content -->
                                            
                                            <div class="form-group">
                                                <label>Kode Transaksi</label>
                                                <input type="text" class="form-control form-control text-uppercase " placeholder="Kode Kategori"
                                                        value="#{{$order->id()}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Pemesan</label>
                                                <input type="text" class="form-control form-control-capitalize " placeholder="Kode Kategori"
                                                        value="{{$order['name']}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>email</label>
                                                <input type="text" class="form-control " placeholder="Kode Kategori"
                                                        value="{{$order['userEmail']}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Total Pembelian</label>
                                                <input type="text" class="form-control form-control-capitalize " placeholder="Kode Kategori"
                                                        value="IDR {{number_format($order['totalOrder'], 0, "," , ".")}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor Telepon</label>
                                                <input type="text" class="form-control form-control-capitalize " placeholder="Kode Kategori"
                                                        value="{{$order['phone']}}" readonly>
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
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
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
@endsection