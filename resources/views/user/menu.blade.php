@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')
    <div class="container mt-5 shadow p-3 mb-5 bg-dark rounded">
        <div class="card text-dark bg-light mb-3">
            <h1 class="card-header"><a href = "{{url('organization/menu')}}" class="my-2 mr-4 btn btn-secondary p-3"> <i class="fa fa-arrow-left mx-2"></i></a>จัดการ</h1>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="{{ url('user/list') }}" class="btn btn-dark py-4" style="width: 100%;font-size: 24px">จัดการผู้ใช้งาน</a>
                        <a href="{{ url('organization/settings')}}" class="btn btn-dark mt-3 py-4" style="width: 100%;font-size: 24px">จัดการองค์กร</a>
                    </div>
                    <div class="col">
                        <img src="{{url('/images/user.png')}}" style="width: 100%">
                    </div>
                </div>
            </div>
        </div> 
    </div>

@endsection
