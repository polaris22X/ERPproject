@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')

    <div class="container mt-5 shadow p-3 mb-5 bg-dark rounded">
        
        <div class="row">
            <div class="col">
                <div class="card text-dark bg-light mb-3">
                    <h3 class="card-header">รายรับ</h3>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a href="{{ url('income/list') }}" class="btn btn-dark" style="width: 100%;">รายการรายรับ</a>
                                <a href="{{ url('income/quotation/list')}}" class="btn btn-dark mt-3" style="width: 100%">ใบเสนอราคา 
                                    @foreach ($readytoquotation as $amountquotation)
                                    @foreach ($readytoaccept as $amountaccept)
                                    @if($amountquotation->readytoquotation > 0 || $amountaccept->readytoaccept > 0)
                                    <span class="badge badge-danger"> {{$amountquotation->readytoquotation + $amountaccept->readytoaccept}} </span>
                                    @endif
                                    @endforeach
                                @endforeach
                               </a>
                            <a href="{{url('income/invoice')}}"  class="btn btn-dark mt-3" style="width: 100%">ใบวางบิล
                                @foreach ($readytoinvoice as $amount)
                                @if($amount->readytoinvoice > 0)
                                  <span class="badge badge-danger"> {{$amount->readytoinvoice}} </span>
                                @endif
                                 @endforeach
                            </a>
                            <a href="{{ url('income/receipt') }}" class="btn btn-dark mt-3" style="width: 100%">ใบเสร็จ
                                @foreach ($readytoreceipt as $amount)
                                @if($amount->readytoreceipt > 0)
                                  <span class="badge badge-danger"> {{$amount->readytoreceipt}} </span>
                                @endif
                                 @endforeach
                            </a>
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
                                <a href="{{ url('expenses/list') }}" class="btn btn-dark" style="width: 100%;">รายการรายจ่าย</a>
                                <a href="{{ url('expenses/purchaseorder/list')}}" class="btn btn-dark mt-3" style="width: 100%">ใบสั่งซื้อ
                                    @foreach ($readytopurchaseorder as $amountpurchaseorder)
                                    @foreach ($readytoacceptpurchaseorder as $amountaccept)
                                    @if($amountpurchaseorder->readytopurchaseorder > 0 || $amountaccept->readytoaccept > 0)
                                    <span class="badge badge-danger"> {{$amountpurchaseorder->readytopurchaseorder + $amountaccept->readytoaccept}} </span>
                                    @endif
                                    @endforeach
                                @endforeach
                                </a>
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

    
