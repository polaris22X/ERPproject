@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')


    <div class="container mt-5 shadow p-3 mb-5 bg-white rounded">
        <div class="jumbotron text-center bg-dark text-white">
            <h1>แก้ไขข้อมูลองค์กร</h1>
            
        </div>
        
        <div class="my-2">
            <a href = "{{url('settings')}}" class="my-2 ml-5 btn btn-secondary"> <i class="fa fa-arrow-left mx-2"></i> ย้อนกลับ</a> 
        </div>

      <form method="POST" action="{{url('organization/settings/edit')}}" class="mx-5"  id="accept">
        @csrf
        @foreach ($organizations as $organization)
        
        <input type="hidden" value="{{$organization->id}}" name="organization_id">
        <label>ชื่อองค์กร</label>
        <input type="text" name="organization_name" class="form-control my-2 col-5" value="{{$organization->organization_name}}"> 
        <label>ที่อยู่องค์กร</label>
        <textarea name="organization_address" class="form-control my-2 col-5" rows="5">{{$organization->organization_address}}</textarea> 
        <label>เบอร์ติดต่อ</label>
        <input type="text" name="organization_tel" class="form-control my-2 col-5" value="{{$organization->organization_tel}}"> 
        <label>อีเมล์</label>
        <input type="text" name="organization_email" class="form-control my-2 col-5" value="{{$organization->organization_email}}"> 
        <label>หมายเลขเสียภาษีอากร</label>
        <input type="text" name="organization_taxid" class="form-control my-2 col-5" value="{{$organization->organization_taxid}}"> 
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
