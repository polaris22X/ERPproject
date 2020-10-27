@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')


    <div class="container mt-5 shadow p-3 mb-5 bg-white rounded">
        <div class="jumbotron text-center bg-dark text-white">
            <h1>ผู้ติดต่อ</h1>
            
        </div>
        
        <div class="my-2">
          <a href = "{{url('partner')}}" class="mr-2 btn btn-secondary"> <i class="fa fa-arrow-left mx-2"></i> ย้อนกลับ</a> 
        </div>

        <table id="example" class="table table-striped table-bordered">
            <thead>
              <tr>
                
                <th scope="col" style="width: 15%">รหัสผู้ติดต่อ</th>
                <th scope="col" style="width: 20%">ชื่อ-นามสกุลผู้ติดต่อ</th>
                <th scope="col">ที่อยู่</th>
                <th scope="col" style="width: 15%">เบอร์โทร</th>
                <th scope="col" style="width: 15%">อีเมล</th>
                <th scope="col">แก้ไข</th>
              </tr>
            </thead>
            <tbody>
                
                @foreach($partners as $partner)
                <tr>
                <th scope="row" >{{$partner->partner_id}}</th>
                <td>{{$partner->partner_name}}</td>
                <td>{{$partner->partner_address}}</td>
                <td>{{$partner->partner_tel}}</td>
                <td>{{$partner->partner_email}}</td>
                <td><button class="btn btn-secondary mr-2" onclick="location.href='{{url('partner/update/'.$partner->partner_id.'')}}'">แก้ไข</button></td>
                </tr>
                @endforeach 
               
              
             
            </tbody>
          </table>

    </div> 
    <script>
      $(document).ready(function(){
        $('#example').DataTable();
     
      });
   
  </script>

     

   
@endsection
