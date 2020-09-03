@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')


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

@endsection
