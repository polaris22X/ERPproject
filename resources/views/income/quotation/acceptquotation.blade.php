@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')

<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container mt-5 shadow p-3 mb-5 bg-white rounded">
    
        <div class="jumbotron text-center bg-dark text-white">
            <h1>รายการที่ยังไม่ได้อนุมัติ</h1>
            
        </div>
               

        
        <div class="my-2">
            <a href = "{{url('income/quotation/list')}}" class="my-2 ml-5 btn btn-secondary"> <i class="fa fa-arrow-left mx-2"></i> ย้อนกลับ</a>
        </div>

        <div class="my-2">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID ใบเสนอราคา</th>
                    <th scope="col">วันที่สร้าง</th>
                    <th scope="col">ชื่อลูกค้า</th>
                    <th scope="col">ยอดสุทธิ</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    
                    @foreach($quotations as $quotation)
                    <tr>
                    <th scope="row">{{$quotation->quotation_id}}</th>
                    <td>{{$quotation->created_at}}</td>
                    <td>{{$quotation->partner_name}}</td>
                    <td>{{number_format($quotation->sum)}}</td>
                    <td><button class="btn btn-primary mr-2" onclick="location.href='{{url('income/quotation/accept/'.$quotation->income_id.'')}}'">อนุมัติรายการ</button></td>
                    </tr>
                    @endforeach 
                   
                  
                 
                </tbody>
              </table>
        </div>
    </div>

       
@endsection
