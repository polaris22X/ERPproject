@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')
    <div class="container mt-5 shadow p-3 mb-5 bg-white rounded">
        <div class="jumbotron text-center bg-dark text-white">
            <h1>รายรับ</h1>
        </div>
        <div class="list-group" style="font-size: 30px">
            <a href="{{ url('income/list') }}" style="color: black;" class="list-group-item list-group-item-action">รายการรายรับ</a></li>
            <a href="{{ url('income/quotation/list')}}" style="color: black" class="list-group-item list-group-item-action">ใบเสนอราคา</a></li>
            <a href="" style="color: black" class="list-group-item list-group-item-action">ใบวางบิล</a></li>
            <a href="" style="color: black" class="list-group-item list-group-item-action">ใบเสร็จ/กำกับภาษี</a></li>
        </div>
    </div>

@endsection
