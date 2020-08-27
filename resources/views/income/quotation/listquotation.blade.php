@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')
    <div class="container mt-5 shadow p-3 mb-5 bg-white rounded">
    
        <div class="jumbotron text-center bg-dark text-white">
            <h1>ใบเสนอราคา</h1>
            
        </div>
                @foreach ($readytoquotation as $amount)
                    @if($amount->readytoquotation > 0)
                    <div class="alert alert-primary" role="alert">
                    <p>มีเอกสารที่ยังไม่ได้ออกใบเสนอราคาทั้งหมด {{$amount->readytoquotation}} รายการ</p>
                    </div> 
                    @endif
                @endforeach

        
        <div class="my-2">
            <a style="color: white" class="btn btn-primary mr-2"  data-toggle="modal" data-target="#ModalMakeQuotation">+ สร้างใบเสนอราคา</a> 
            <a href="{{url('income/list')}}" type="button" class="btn btn-secondary mr-2">+ แก้ไขรายการรายรับ</a>  
        </div>

        <div class="my-2">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID ใบเสนอราคา</th>
                    <th scope="col">วันที่สร้าง</th>
                    <th scope="col">ชื่อลูกค้า</th>
                    <th scope="col">ยอดสุทธิ</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    
                    @foreach($quotations as $quotation)
                    <tr>
                    <th scope="row">{{$quotation->quotation_id}}</th>
                    <td>{{$quotation->created_at}}</td>
                    <td>{{$quotation->partner_name}}</td>
                    <td>{{$quotation->sum}}</td>
                    <td><button class="btn btn-primary mr-2" onclick="location.href='{{url('income/quotation/show/'.$quotation->quotation_id.'')}}'">ดูใบเสนอราคา</button></td>
                    </tr>
                    @endforeach 
                   
                  
                 
                </tbody>
              </table>
        </div>

        

        
    </div>

        <!-- Modal_Add_quotation -->
        <div class="modal fade bd-example-modal-lg" id="ModalMakeQuotation" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">รายการรายรับ</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">วันที่สร้าง</th>
                            <th scope="col">ชื่อลูกค้า</th>
                            <th scope="col">ยอดสุทธิ</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($incomes as $income)
                            
                            <tr>
                            <th scope="row">{{$income->income_id}}</th>
                            <td>{{$income->created_at}}</td>
                            <td>{{$income->partner_name}}</td>
                            <td>{{$income->sum}}</td>
                            <td><a href="{{url('income/quotation/'.$income->income_id)}}" class="btn btn-secondary mr-2">สร้างใบเสนอราคา</a><button class="btn btn-danger">ยกเลิก</button></td>
                            </tr>
                            
                            @endforeach 
                           
                        </tbody>
                      </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                </form>
                </div>
              </div>
            </div>
          </div>
          <!-- End_Modal_Add_product -->

@endsection
