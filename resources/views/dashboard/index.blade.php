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
                        <h6>Bookmarks</h6>
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
</div>
@endsection