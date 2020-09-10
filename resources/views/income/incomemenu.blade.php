@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')
    <div class="container mt-5 shadow p-3 mb-5 bg-dark rounded">
        <div class="card text-dark bg-light mb-3">
            <h1 class="card-header">รายรับ</h1>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="{{ url('income/list') }}" class="btn btn-dark py-4" style="width: 100%;font-size: 24px">รายการรายรับ</a>
                        <a href="{{ url('income/quotation/list')}}" class="btn btn-dark mt-3 py-4" style="width: 100%;font-size: 24px">ใบเสนอราคา 
                            @foreach ($readytoquotation as $amountquotation)
                            @foreach ($readytoaccept as $amountaccept)
                            @if($amountquotation->readytoquotation > 0 || $amountaccept->readytoaccept > 0)
                            <span class="badge badge-danger"> {{$amountquotation->readytoquotation + $amountaccept->readytoaccept}} </span>
                            @endif
                            @endforeach
                        @endforeach
                       </a>
                       <a href="{{ url('income/invoice') }}" class="btn btn-dark py-4 mt-3" style="width: 100%;font-size: 24px">ใบวางบิล</a>
                    </div>
                    <div class="col">
                        <img src="{{url('/images/income.png')}}" style="width: 100%">
                    </div>
                </div>
            </div>
        </div> 
    </div>

@endsection
