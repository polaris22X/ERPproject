@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')


    <div class="container mt-5 shadow p-3 mb-5 bg-white rounded">
        <div class="jumbotron text-center bg-dark text-white">
            <h1>สินค้าคงเหลือ</h1>
            
        </div>
        
        <div class="my-2">
          <a href = "{{url('product')}}" class="mr-2 btn btn-secondary"> <i class="fa fa-arrow-left mx-2"></i> ย้อนกลับ</a> 
        </div>

        <table id="example" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">ชื่อสินค้า</th>
                <th scope="col">จำนวนสินค้า</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                
                @foreach($products as $product)
                <tr>
                <th scope="row">{{$product->product_id}}</th>
                <td>{{$product->product_name}}</td>
                <td>{{number_format($product->stock)}}</td>
                <td><button class="btn btn-secondary mr-2" onclick="location.href='{{url('product/update/'.$product->product_id.'')}}'">แก้ไข</button></td>
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
