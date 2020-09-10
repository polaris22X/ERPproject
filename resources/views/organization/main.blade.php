@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')

<!--
    <div class="container">
        <div class="shadow-none p-3 mb-5 bg-dark mt-5 p-1 rounded">
            <div class="row mx-auto mt-5 justify-content-center">
            <div class="col-3 mx-2 my-2 border border-dark" id="menu" onclick="window.location='{{ url('/income') }}'" onmousemove="this.style.background = '#33312c'" onmouseout="this.style.background = '#343A40'" style="cursor: pointer">
                        <img src="{{url('/images/income.png')}}" style="width: 100%"><br>
                        <h2 style="text-align: center;color: white;">รายรับ</h2>
                    </div>
                    <div class="col-3 mx-2 my-2 border border-dark"  id="menu"onmousemove="this.style.background = '#33312c'" onmouseout="this.style.background = '#343A40'" style="cursor: pointer">
                        <img src="{{url('/images/pay.png')}}" style="width: 100%">
                        <h2 style="text-align: center;color: white;">รายจ่าย</h2>
                    </div>
                    <div class="col-3 mx-2 my-2 border border-dark"  id="menu" onmousemove="this.style.background = '#33312c'" onmouseout="this.style.background = '#343A40'" style="cursor: pointer">
                        <img src="{{url('/images/report.png')}}" style="width: 100%">
                        <h2 style="text-align: center;color: white;">รายงาน</h2>
                    </div>
            </div>
        </div>
    </div>
    </div>

!-->
    
    
    

    <div class="container mt-5 shadow p-3 mb-5 bg-dark rounded">
        
        <!--<div class="jumbotron text-center bg-dark text-white">
            <h1>รายรับ</h1>
        </div>!-->
        <div class="row">
            <div class="col">
                <div class="card text-dark bg-light mb-3">
                    <h3 class="card-header">รายรับ</h3>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a href="{{ url('income/list') }}" class="btn btn-dark" style="width: 100%">รายการรายรับ</a>
                                <a href="{{ url('income/quotation/list')}}" class="btn btn-dark mt-3" style="width: 100%">ใบเสนอราคา 
                                    @foreach ($readytoquotation as $amountquotation)
                                    @foreach ($readytoaccept as $amountaccept)
                                    @if($amountquotation->readytoquotation > 0 || $amountaccept->readytoaccept > 0)
                                    <span class="badge badge-danger"> {{$amountquotation->readytoquotation + $amountaccept->readytoaccept}} </span>
                                    @endif
                                    @endforeach
                                @endforeach
                               </a>
                            <a href="{{url('income/invoice')}}"  class="btn btn-dark mt-3" style="width: 100%">ใบวางบิล</a>
                            </div>
                            <div class="col">
                                <img src="{{url('/images/income.png')}}" style="width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-dark bg-light mb-3">
                    <h3 class="card-header">รายจ่าย</h3>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                ...
                            </div>
                            <div class="col">
                                <img src="{{url('/images/outcome.png')}}" style="width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card text-dark bg-light mb-3">
                    <h3 class="card-header">รายงาน</h3>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                ...
                            </div>
                            <div class="col">
                                <img src="{{url('/images/report.png')}}" style="width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-dark bg-light mb-3">
                    <h3 class="card-header">จัดการผู้ใช้งาน</h3>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                ...
                            </div>
                            <div class="col">
                                <img src="{{url('/images/user.png')}}" style="width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
           
           <!-- <a href="{{ url('income/quotation/list')}}" style="color: black" class="list-group-item list-group-item-action">ใบเสนอราคา</a></li>
            <a href="" style="color: black" class="list-group-item list-group-item-action">ใบวางบิล</a></li>
            <a href="" style="color: black" class="list-group-item list-group-item-action">ใบเสร็จ/กำกับภาษี</a></li>!-->
 

@endsection

    
