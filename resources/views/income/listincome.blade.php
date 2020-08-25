@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')
    <div class="container mt-5 shadow p-3 mb-5 bg-white rounded">
        <div class="jumbotron text-center bg-dark text-white">
            <h1>รายรับ</h1>
            
        </div>
        
        <div class="my-2">
            <a href="{{url('income/insert')}}" class="btn btn-primary mr-2">+ เพิ่มรายการรายรับ</a> 
        </div>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">วันที่สร้าง</th>
                <th scope="col">ชื่อลูกค้า</th>
                <th scope="col">ยอดสุทธิ</th>
              </tr>
            </thead>
            <tbody>
                
                @foreach($incomes as $income)
                <tr>
                <th scope="row">{{$income->income_id}}</th>
                <td>{{$income->created_at}}</td>
                <td>{{$income->partner_name}}</td>
                <td>{{$income->sum}}</td>
                </tr>
                @endforeach 
               
              
             
            </tbody>
          </table>

    </div>

@endsection
