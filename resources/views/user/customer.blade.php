@extends('master.app')

@section('cssStyle')

@endsection

@section('jsStyle')
<script src="/style/js/datatables.js"></script>
@endsection

@section('iconHeader')
<i class="ik ik-users bg-blue"></i>
@endsection

@section('titleHeader')
User Customer
@endsection

@section('subtitleHeader')
Halaman Data User Customer
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Customer</li>
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>No. Hp</th>
                                <th>Level order</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $no=1; @endphp
                            @foreach($users as $user)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$user['username']}}</td>
                                <td>{{$user['userEmail']}}</td>
                                <td>{{$user['userAddress']}}</td>
                                <td>{{$user['userNumber']}}</td>
                                <td>{{$user['levelOrder']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.delete').click(function() {
        var userid = $(this).attr('data-id');
        var username = $(this).attr('data-name');
        Swal.fire({
            title: 'Are you sure?',
            text: "Want to delete username " + username + " ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: 'User has been removed'
                })
                window.location = "/user/" + userid + "/delete"
            }
        })
    })
</script>

<script type="text/javascript">
    $(document).ready(function() {

        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            "initComplete": function(settings, json) {
                $("#dataTable").wrap(
                    "<div class='scroll' style='overflow:auto; width:100%;position:relative;padding-left:20px;padding-bottom:20px'></div>"
                );
            },
            ajax: "{{ route('user.index') }}",
            columns: [{
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        table.columns().eq(0).each(function(colIdx) {
            $('input', table.column(colIdx).footer()).on('keyup change', function() {
                console.log(colIdx + '-' + this.value);
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });
        });
    });
</script>

@endsection
@section('fixedButton')
<a class="fixedButtonRefresh">
    <button data-toggle="tooltip" data-placement="top" title="" type="" class="btn btn-icon btn-secondary " onclick="window.location.reload();" data-original-title="Refresh">
        <i class="ik ik-refresh-ccw"></i>
    </button>
</a>
<!-- <a class="fixedButtonAdd" href="{{route('user.create')}}">
    <button data-toggle="tooltip" data-placement="top" title="" href="" class="btn btn-icon btn-info" data-original-title="Tambah">
        <i class="ik ik-plus"></i>
    </button>
</a> -->
@endsection