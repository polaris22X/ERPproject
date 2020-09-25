@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')
    <div class="container mt-5 shadow p-3 mb-5 bg-dark rounded">
        <div class="card text-dark bg-light mb-3">
            <h1 class="card-header">รายจ่าย</h1>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="{{ url('expenses/list') }}" class="btn btn-dark py-4" style="width: 100%;font-size: 24px">รายการรายจ่าย</a>
                        <a href="{{ url('expenses/purchaseorder/list')}}" class="btn btn-dark mt-3 py-4" style="width: 100%;font-size: 24px">ใบสั่งซื้อ
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

@endsection
