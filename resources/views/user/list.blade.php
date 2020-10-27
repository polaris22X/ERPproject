@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')


    <div class="container mt-5 shadow p-3 mb-5 bg-white rounded">
    
        <div class="jumbotron text-center bg-dark text-white">
            <h1>รายชื่อผู้ใช้งาน</h1>
        </div>


        
        <div class="my-2">
            <a href = "{{url('user/')}}" class="my-2 mr-2 btn btn-secondary"> <i class="fa fa-arrow-left mx-2"></i> ย้อนกลับ</a>
            <a href="{{url('user/insert')}}" style="color: white" class="btn btn-primary mr-2">+ เพิ่มผู้ใช้งาน</a> 
            
        </div>

        <div class="my-2">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    
                    <th scope="col">ชื่อ - นามสกุล</th>
                    <th scope="col">อีเมล</th>
                    <th scope="col">ตำแหน่ง</th>
                    <th scope="col">ลบผู้ใช้</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->level_name}}</td>
                    <td></td>
                    </tr>
                    @endforeach 
                </tbody>
              </table>
        </div>

        

        
    </div>

    <script>
        $(document).ready(function() {
          $('#example').DataTable({
                "ordering": false 
              });
        } );
        </script>
@endsection
