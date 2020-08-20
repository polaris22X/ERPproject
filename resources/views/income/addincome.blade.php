@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<script>
  var number = 1;
  $(document).ready(function(){
  $("#add").click(function(){
    number++;
    $("tbody").append("<tr><th scope=\"row\" style=\"width: 10%\">"+ number +"</th><td style=\"width: 40%\"><div class=\"row\"><div class=\"col-8\"><select name=\"product_id[]\" class=\"form-control\"><option value=\"0\">-- รายการสินค้า --</option>@foreach($products as $product)<option value=\"{{$product->product_id}}\">{{$product->product_name}}</option>@endforeach</select></div><div class=\"col-4\"><a href=\"\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#ModalAddProduct\">+ เพิ่มสินค้า</a></div></div></td><td><input type=\"number\" name=\"product_amount[]\" class=\"form-control\" ng-model=\"product_amount1\"></td><td><input type=\"number\" name=\"product_price[]\"  class=\"form-control\" ng-model=\"product_price1\"></td></tr>");
  });
});
</script>
    <div class="container mt-5 shadow p-3 mb-5 bg-white rounded">
        <div class="jumbotron text-center bg-dark text-white">
            <h1>เพิ่มรายการรายรับ</h1>
        </div>
      <form class="mx-5 my-5" method="POST" action="{{url('income/insert')}}">
        @csrf
          <div class="row my-2">
              <div class="col"><h5>ชื่อลูกค้า</h5></div><div class="col"></div>
          </div>
          <div class="row my-2">
              <div class="col-5">
                <select name="partner_id" class="form-control" id="partner">
                  <option value="0">-- รายชื่อผู้ติดต่อ --</option>
                  @foreach($partners as $partner)
                  <option value="{{$partner->partner_id}}">{{$partner->partner_name}}</option>
                  @endforeach 
                 </select>
              </div>
              <div class="col-2">
                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#ModalAddPartner">+ เพิ่มลูกค้า</a> 
              </div>
            <div class="col-6">

            </div>
          </div>
          <div class="row my-2">
            <div class="col"><h5>ที่อยู่</h5></div><div class="col"></div>
          </div>
          <div class="row my-2">
            <div class="col"><textarea class="form-control" id="address" rows="8" name="partner_address"></textarea></div><div class="col"></div>
          </div>
          
          <div class="row my-2">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">ลำดับ</th>
                  <th scope="col">รายการ</th>
                  <th scope="col">จำนวน</th>
                  <th scope="col">ราคา/หน่วย</th>
                  <th scope="col">ราคารวม</th>
                </tr>
              </thead>
              <tbody>
                
                <tr>
                  <th scope="row" style="width: 10%">1</th>
                  <td style="width: 40%">
                    <div class="row">
                      <div class="col-8" >
                      <select name="product_id[]" class="form-control">
                      <option value="0">-- รายการสินค้า --</option>
                      @foreach($products as $product)
                      <option value="{{$product->product_id}}">{{$product->product_name}}</option>
                      @endforeach 
                      </select>
                      </div>
                      <div class="col-4">
                      <a href="" class="btn btn-primary" data-toggle="modal" data-target="#ModalAddProduct">+ เพิ่มสินค้า</a> 
                      </div>
                    </div>
                  </td>
                  <td><input type="number" name="product_amount[]" class="form-control" ng-model="product_price1"></td>
                  <td><input type="number" name="product_price[]"  class="form-control" ng-model="product_amount1"></td>
                  
                </tr>
              </tbody>
             
            </table>
            <button id="add" type="button" class="btn btn-dark btn-lg btn-block">เพิ่มรายการ</button>
            </div>
            <div class="d-flex justify-content-end">
              <input type="submit" name="submit" class="my-2 btn btn-success" value="ยืนยัน">
              <a href = "" class="my-2 btn btn-danger ml-3">ยกเลิก</a>
              </div>
          </div>
        </form>

    </div>

 
    <!-- Modal_Add_Partner -->
    <div class="modal fade" id="ModalAddPartner" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">รายชื่อผู้ติดต่อ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
              <form action="{{ url('income/partner') }}" method="POST">
                @csrf
                  <label>ชื่อผู้ติดต่อ</label>
                  <input type="text" class="form-control" name="partner_name">
                  <label>ที่อยู่</label>
                  <textarea class="form-control" id="address" rows="8" name="partner_address"></textarea>
                
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            <button class="btn btn-primary">เพิ่มผู้ติดต่อ</button>
          </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End_Modal_Add_partner -->
  
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
                  <input type="text" class="form-control" name="product_name">
                  <label for="exampleInputEmail1">รายละเอียด</label>
                  <textarea class="form-control" id="address" rows="8" name="product_description"></textarea>
                
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            <button class="btn btn-primary">เพิ่มรายการสินค้า</button>
          </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End_Modal_Add_product -->


@endsection
