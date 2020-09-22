@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')

<script>
  function alertshow(){
    alert("ไม่สามารถแก้ไขได้เนื่องจากอนุมัติไปแล้ว");
  }
</script>
    <div class="container mt-5 shadow p-3 mb-5 bg-white rounded">
        <div class="jumbotron text-center bg-dark text-white">
            <h1>รายจ่าย</h1>
            
        </div>
        
        <div class="my-2">
          <a href = "{{url('expenses')}}" class="mr-2 btn btn-secondary"> <i class="fa fa-arrow-left mx-2"></i> ย้อนกลับ</a> <a href="{{url('expenses/insert')}}" class="btn btn-primary mr-2">+ เพิ่มรายการรายจ่าย</a> 
        </div>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">วันที่สร้าง</th>
                <th scope="col">ชื่อลูกค้า</th>
                <th scope="col">ยอดสุทธิ</th>
                <th scope="col">สถานะ</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                
               
               
              
             
            </tbody>
          </table>

    </div>

@endsection
