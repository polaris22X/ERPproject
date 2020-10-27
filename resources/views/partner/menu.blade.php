@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')
    <div class="container mt-5 shadow p-3 mb-5 bg-dark rounded">
        <div class="card text-dark bg-light mb-3">
            <h1 class="card-header">ผู้ติดต่อ</h1>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="{{ url('partner/insert') }}" class="btn btn-dark py-4" style="width: 100%;font-size: 24px">เพิ่มผู้ติดต่อ</a>
                        <a href="{{ url('partner/list/')}}" class="btn btn-dark mt-3 py-4" style="width: 100%;font-size: 24px">รายชื่อผู้ติดต่อ</a>
                    </div>
                    <div class="col">
                        <img src="{{url('/images/partner.png')}}" style="width: 100%">
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection
