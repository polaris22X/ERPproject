@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')
    <div class="container mt-5 shadow p-3 mb-5 bg-white rounded">
        <div class="jumbotron text-center bg-dark text-white">
            <h1>รายรับ</h1>
        </div>
        <ul style="font-size: 30px">
            <li><a href="{{ url('income/insert') }}" style="color: black;">เพิ่มรายการรายรับ</a></li>
            <li><a href="" style="color: black">ออกใบเสนอราคา</a></li>
            <li><a href="" style="color: black">ออกใบวางบิล</a></li>
            <li><a href="" style="color: black">ออกใบเสร็จ/กำกับภาษี</a></li>
          </ul>
    </div>

@endsection
