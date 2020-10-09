@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')

  <div class="container my-5 shadow p-5 mb-5 bg-white rounded">
    <div class="my-2">
      <a href = "{{url('organization/menu')}}" class="my-2 btn btn-secondary"> <i class="fa fa-arrow-left mx-2"></i> ย้อนกลับ</a>
    </div>
    <h1 class="my-3">เพิ่มข้อมูลองค์กร</h1>
    <form action="/organization" method="POST" >
      @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">ชื่อองค์กร</label>
          <input type="text" class="form-control" id="organization_name" name="organization_name" aria-describedby="emailHelp" >
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">ที่อยู่</label>
          <input type="text" class="form-control" id="organization_address" name="organization_address">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">เบอร์โทรติดต่อ</label>
          <input type="text" class="form-control" id="organization_tel" name="organization_tel" >
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">อีเมล์ติดต่อ</label>
          <input type="text" class="form-control" id="organization_email" name="organization_email" >
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">หมายเลขผู้เสียภาษีอากร</label>
          <input type="text" class="form-control" id="organization_taxid" name="organization_taxid">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

</div>

@endsection
