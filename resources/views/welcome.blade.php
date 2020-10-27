@extends('layouts.app')

@section('content')


<div class="d-flex justify-content-center">
<div class="card bg-dark d-flex my-5 p-2" style="width: 80%">
  <div class="jumbotron mt-2 mx-2">
    <h2 class="display-4 text-center">ระบบบริหารบัญชีงบกำไร - ขาดทุนสำหรับธุรกิจพาณิชยกรรม</h2>
  </div>
 
  <div class="row">
  
   <div class="col-6">แจ้งการชำระเงิน</div>
   <div class="col-6">แจ้งปัญหาการใช้งาน</div>
  </div>
  <div id="demo" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
    </ul>
    
    <!-- The slideshow -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{url("images/wallpaper1.jpg")}}" alt="Los Angeles" width="100%" height="650">
      </div>
      <div class="carousel-item">
        <img src="{{url("images/wallpaper2.jpg")}}" alt="Chicago" width="100%" height="650">
      </div>
      <div class="carousel-item">
        <img src="{{url("images/wallpaper3.jpg")}}" alt="New York" width="100%" height="650">
      </div>
    </div>
    
    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
  <div class="row my-4" >
  
    <div class="col-4"></div>
    <div class="col-4"><a class="btn btn-primary btn-block " style="font-size: 20px;width 100%;" href="{{url('organization')}}">เข้าสู่ระบบ</a></div>
    <div class="col-4"></div>
   </div>
  
</div>

</div>





@endsection
