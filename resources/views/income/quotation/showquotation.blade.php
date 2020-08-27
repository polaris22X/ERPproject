@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
@include('layouts.navmenu')
<div class="container mt-5 shadow p-5 mb-5 bg-white rounded">
    @foreach ($details as $detail)
    <a href="{{url('income/quotation/show/pdf/'.$detail->quotation_id)}}" class="btn btn-primary">สร้างเอกสาร PDF</a>
    @endforeach
    
    @foreach ($organizations as $organization)
    <h1 style="text-align: center;" class="mt-5">{{$organization->organization_name}}</h1>
    <p style="text-align: center;font-size: 18px" >{{$organization->organization_address}}</p>
    @endforeach
    <h2 class="mt-5" style="text-align: center">ใบเสนอราคา</h2>
    <div class="row" class="mx-3 mt-2" >
        <div class="col-9 border border-dark">
            <div class="ml-2 my-4">
                @foreach ($details as $detail)
                    <p style="font-size: 16px">ชื่อลูกค้า : {{$detail->partner_name}} </p>
                    <p style="font-size: 16px">ที่อยู่ : {{$detail->address}}
                @endforeach
            </div>
        </div>
        <div class="col-3 border border-dark ">
            <div class="ml-2 my-4">
                @foreach ($details as $detail)
                <p style="font-size: 16px">หมายเลขใบสั่งซื้อ : {{$detail->quotation_id}} </p>
                <p style="font-size: 16px">วันที่ : {{date('d-m-Y', strtotime($detail->created_at))}} </p>
                @endforeach
            </div>
        </div>
    </div>
    
    <table class="table table-bordered mt-5" style="font-size: 16px">
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
        <?php $i = 0; ?>
        @foreach ($quotations as $quotation)
        <?php $i++?>
          <tr>
          <th scope="row" style="width: 10%">{{$i}}</th>
          <td style="width: 40%">{{$quotation->product_name}}</td>
          <td>{{$quotation->amount}}</td>
          <td>{{$quotation->saleprice}}</td>
          <td>{{$quotation->saleprice * $quotation->amount}}</td>
          </tr>
          @endforeach
          @foreach ($sums as $sum)
          <tr>
          <td rowspan="3" colspan="3">หมายเหตุ : </td><td>VATABLE</td><td>{{$sum->sum - ($sum->sum * 7/100)}}</td>
          </tr>
          <tr>
              <td>VAT 7%</td><td>{{$sum->sum * 7/100}}</td>
          </tr>
          <tr>
            <td>ราคารวมทั้งสิ้น</td><td>{{$sum->sum}}</td>
        </tr>
          @endforeach
        </tbody>
       
      </table>
</div>
    
@endsection




   


