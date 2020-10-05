@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')


    <div class="container mt-5 shadow p-3 mb-5 bg-white rounded">
        <div class="jumbotron text-center bg-dark text-white">
            <h1>สินค้าคงเหลือ</h1>
            
        </div>
        
        <div class="my-2">
          <a href = "{{url('product')}}" class="mr-2 btn btn-secondary"> <i class="fa fa-arrow-left mx-2"></i> ย้อนกลับ</a> <a href="#" class="btn btn-primary mr-2" data-toggle="modal" data-target="#ModalAddProduct"> + เพิ่มสินค้า</a> 
        </div>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">ชื่อสินค้า</th>
                <th scope="col">จำนวนสินค้าคงเหลือ</th>
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

     <!-- Modal_Add_product -->
     <div class="modal fade" id="ModalAddProduct" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">รายการสินค้า</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <form action="{{ url('income/product') }}" method="POST">
                    @csrf
                    <label for="exampleInputEmail1">ชื่อสินค้า</label>
                    <input type="text" class="form-control" name="product_name" id="productname">
                    <label for="exampleInputEmail1">รายละเอียด</label>
                    <textarea class="form-control" rows="8" name="product_description" id="productdescription"></textarea>
                  
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="exitmodal">ยกเลิก</button>
              <button type="button" class="btn btn-primary" id="addproduct">เพิ่มรายการสินค้า</button>
            </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End_Modal_Add_product -->
    <script>
        $(document).ready(function(){
        $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
      $("#addproduct").click(function(){
        var productname = $("#productname").val();
        var productdescription = $("#productdescription").val();
        addproduct(productname,productdescription);
      });
      $("#productamount1,#productprice1").change(function(){
        var productamount = $("#productamount1").val();
        var productprice = $("#productprice1").val();
        var total = parseFloat(productamount) * parseFloat(productprice);
        $("#sum1").text(numberWithCommas(total));
      });

     function addproduct(productname,productdescription){
           $.ajax({
                type:'POST',
                url:"{{ url('income/product') }}" ,
                data: {'product_name': productname , 'product_description' : productdescription},
                success:function(data) {
                    $("tbody").append("<tr><td><b>"+data.msg+"</b></td><td>"+productname+"</td><td>0</td><td><button class=\"btn btn-secondary mr-2\" onclick=\"location.href='{{url('product/update/')}}/"+data.msg+"\">แก้ไข</button></td></tr>");
                    $('.modal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                }
             });
     } 
  });
    </script>
@endsection
