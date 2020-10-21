@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')


    <div class="container mt-5 shadow p-3 mb-5 bg-white rounded">
        <div class="jumbotron text-center bg-dark text-white">
            <h1>แก้ไขสินค้า</h1>
            
        </div>
        
        <div class="my-2">
            <a href = "{{url()->previous()}}" class="my-2 ml-5 btn btn-secondary"> <i class="fa fa-arrow-left mx-2"></i> ย้อนกลับ</a> 
        </div>

      <form method="POST" action="{{url('product/update')}}" class="mx-5"  id="accept">
        @csrf
        @foreach ($products as $product)
        
        <input type="hidden" value="{{$product->product_id}}" name="product_id">
        <label>ชื่อสินค้า</label>
        <input type="text" name="product_name" class="form-control my-2" value="{{$product->product_name}}"> 
        <label>รายละเอียดสินค้า</label>
        <textarea name="product_description" class="form-control my-2" rows="5">{{$product->product_description}}</textarea> 
        <input type="submit"  value="ยืนยัน" class="btn btn-primary my-3" ><a href = "{{url()->previous()}}" class="my-2 ml-2 btn btn-secondary">ยกเลิก</a>
        </form>
        @endforeach

    </div>
    <script>
      $(document).ready(function(){
        $("#accept").submit(function(){
        return accept();
      }); 
      function accept(){
      var txt;
      var r = confirm("ยืนยันการแก้ไข");
      if (r == true) {
        txt = "ยืนยัน";
        return true;
      } else {
       txt = "ยกเลิก";
        return false;
      }
      document.getElementById("demo").innerHTML = txt;
    }
    }); 
    </script>
@endsection
