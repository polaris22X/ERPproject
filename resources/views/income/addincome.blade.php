@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')
<meta name="csrf-token" content="{{ csrf_token() }}">


<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>!-->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <div class="container mt-5 shadow p-3 mb-5 bg-white rounded">
        <div class="jumbotron text-center bg-dark text-white">
            <h1>เพิ่มรายการรายรับ</h1>
        </div>
        
      <a href = "{{url('income/list')}}" class="my-2 ml-5 btn btn-secondary"> <i class="fa fa-arrow-left mx-2"></i> ย้อนกลับ</a>

      <form class="mx-5 my-5" method="POST" action="{{url('income/insert')}}">
        @csrf

          <div class="row my-2">
              <div class="col"><h5>ชื่อลูกค้า</h5></div><div class="col"></div>
          </div>
          <div class="row my-2">
              <div class="col-5">
                <select name="partner_id" class="form-control selectpicker" data-live-search="true" title="กรุณาเลือกผู้ติดต่อ" id="partnerid">
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
            <div class="col"><textarea class="form-control" id="address" rows="8" name="partner_address" id="address"></textarea></div><div class="col"></div>
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
                      <select name="product_id[]"  class="form-control" data-live-search="true" title="กรุณาเลือกสินค้า" id="productid">
                        <option value="" disabled selected hidden>กรุณาเลือกสินค้า</option>
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
                  <td><input type="number" name="product_amount[]" class="form-control" id="productamount1"></td>
                  <td><input type="number" name="product_price[]"  class="form-control" id="productprice1"></td>
                  <td><p id="sum1" class="mt-2"></p></td>
                </tr>

              </tbody>
             
            </table>
            <button id="add" type="button" class="btn btn-dark btn-lg btn-block">เพิ่มรายการ</button>
            </div>
            <div class="d-flex justify-content-end">
              <input type="submit" name="submit" class="my-2 btn btn-success" value="ยืนยัน">
              <a href = "{{url('income/list')}}" class="my-2 btn btn-danger ml-3">ยกเลิก</a>
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
                  <input type="hidden" name="page" value="insert">
                  <label>ชื่อผู้ติดต่อ</label>
                  <input type="text" class="form-control" name="partner_name" id="partnername">
                  <label>ที่อยู่</label>
                  <textarea class="form-control" rows="8" name="partner_address" id="partneraddress"></textarea>
                  <label>เบอร์โทร</label>
                  <input type="text" class="form-control" name="partner_tel" id="partnertel">
                  <label>อีเมล์ติดต่อ</label>
                  <input type="text" class="form-control" name="partner_email" id="partneremail">
                
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            <button type="button" class="btn btn-primary" id="addpartner">เพิ่มผู้ติดต่อ</button>
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
                  <input type="hidden" name="page" value="insert">
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
      var number = 1;
      $(document).ready(function(){
        $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
      $("#partnerid").change(function(){
        var partner_id = $("#partnerid").val();
        getaddress(partner_id);
      });
      $("#addpartner").click(function(){
        var partnername = $("#partnername").val();
        var partneraddress = $("#partneraddress").val();
        var partnertel = $("#partnertel").val();
        var partneremail = $("#partneremail").val();
        
        addpartner(partnername,partneraddress,partnertel,partneremail);
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
      $("#add").click(function(){
        number++;
        $("tbody").append("<tr><th scope=\"row\" style=\"width: 10%\">"+number+"</th><td style=\"width: 40%\"><div class=\"row\"><div class=\"col-8\" ><select name=\"product_id[]\"  class=\"form-control\" data-live-search=\"true\" title=\"กรุณาเลือกสินค้า\"><option value=\"\" disabled selected hidden>กรุณาเลือกสินค้า</option> @foreach($products as $product)<option value=\"{{$product->product_id}}\">{{$product->product_name}}</option>@endforeach </select></div><div class=\"col-4\"><a href=\"\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#ModalAddProduct\">+ เพิ่มสินค้า</a> </div></div></td><td><input type=\"number\" name=\"product_amount[]\" class=\"form-control\" id=\"productamount"+number+"\"></td><td><input type=\"number\" name=\"product_price[]\"  class=\"form-control\" id=\"productprice"+number+"\"></td><td><p id=\"sum"+number+"\" class=\"mt-2\"></p></td></tr>");
        $("#productamount"+number+",#productprice"+number).change(function(){
        var productamount = $("#productamount"+number).val();
        var productprice = $("#productprice"+number).val();
        var total = parseFloat(productamount) * parseFloat(productprice);
        $("#sum"+number).text(numberWithCommas(total));
      });
        
     }); 
    });
    function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    function getaddress(partner_id) {
           
            $.ajax({
               type:'POST',
               url:'{{url("getpartner")}}',
               data: {'partner_id': partner_id},
               success:function(data) {
                  $("#address").val(data.msg);
               }
            });
         }
    function addpartner(partnername,partneraddress,partnertel,partneremail){
          $.ajax({
               type:'POST',
               url:'{{ url("income/partner") }}',
               data: {'partner_name': partnername , 'partner_address' : partneraddress ,'partner_tel' : partnertel, 'partner_email' : partneremail},
               success:function(data) {
                  alert("Add partner is succes.");
                  $("#partnerid").append("<option selected value='"+ data.msg +"'>"+partnername+"</option>");
                  $('#partnerid').selectpicker('refresh');
               }
            });
    } 
    function addproduct(productname,productdescription){
          $.ajax({
               type:'POST',
               url:"{{ url('income/product') }}" ,
               data: {'product_name': productname , 'product_description' : productdescription},
               success:function(data) {
                  alert("Add product is succes.");
                  $("#productid").append("<option value='"+ data.msg +"'>"+productname+"</option>");
                  $('#productid').selectpicker('refresh');
               }
            });
    } 
    </script>

@endsection

