@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')
    <div class="container mt-5 shadow p-3 mb-5 bg-dark rounded">
        <div class="card text-dark bg-light mb-3">
            <h1 class="card-header">สินค้า</h1>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="{{ url('product/insert') }}" class="btn btn-dark py-4" style="width: 100%;font-size: 24px">เพิ่มสินค้า</a>
                        <a href="{{ url('product/stock/')}}" class="btn btn-dark mt-3 py-4" style="width: 100%;font-size: 24px">รายการสินค้าคงเหลือ</a>
                    </div>
                    <div class="col">
                        <img src="{{url('/images/product.png')}}" style="width: 100%">
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection
