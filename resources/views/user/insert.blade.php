@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')


    <div class="container mt-5 shadow p-3 mb-5 bg-white rounded">
    
        <div class="jumbotron text-center bg-dark text-white">
            <h1>เพิ่มผู้ใช้งาน</h1>
        </div>


        
        <div class="my-2">
            <a href = "{{url()->previous()}}" class="my-2 ml-5 btn btn-secondary"> <i class="fa fa-arrow-left mx-2"></i> ย้อนกลับ</a>
            <div class="card my-4" style="margin-left: 10%;margin-right: 10%;">
            <form action="{{url('user/insert')}}" method="POST">
            @csrf
            <div class="card-header">
                เพิ่มผู้ใช้งาน
              </div>
            <div class="card-body">
            <div class="row">
            <div class="col-auto">
            <label for="inlineFormInput">อีเมลผู้ใช้งาน</label>
            </div>
            <div class="col-auto">
            <input type="email" name="user_email" class="form-control">
            </div>
            
            <div class="col-auto">
                <label>ตำแหน่ง</label> 
                </div>
            <div class="col-auto">
            <select class="form-control" name="userlevel_id">
            @foreach ($levels as $level)
            <option value="{{$level->id}}">{{$level->level_name}}</option>    
            @endforeach
            </select>
            </div>
            <div class="col-auto">
            <input type="submit" value="ยืนยัน" class="btn btn-primary">
            </div>
            </form>
            </div>
        </div>
        </div>
        </div>

        <div class="my-2">
            
        </div>

        

        
    </div>

    
@endsection
