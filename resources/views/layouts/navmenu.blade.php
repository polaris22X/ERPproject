@foreach($organizations as $organization)


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="{{url('organization')}}">{{$organization->organization_name}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
        <a href="{{url('organization/menu')}}" class="nav-link">หน้าแรก</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
              รายรับ
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{url("income/list")}}">รายการรายรับ</a>
              <a class="dropdown-item" href="{{url("income/quotation/list")}}">ใบเสนอราคา</a>
              <a class="dropdown-item" href="{{url("income/invoice/")}}">ใบวางบิล</a>
              <a class="dropdown-item" href="{{url("income/receipt/")}}">ใบเสร็จ</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
              รายจ่าย
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{url("expenses/list")}}">รายการรายจ่าย</a>
              <a class="dropdown-item" href="{{url("expenses/purchaseorder/list")}}">ใบสั่งซื้อ</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                รายงาน
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{url("report/profit")}}">งบกำไรขาดทุน</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                สินค้า
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{url("product/insert")}}"><i class="fa fa-plus mr-2" aria-hidden="true"></i>เพิ่มสินค้า</a>
                <a class="dropdown-item" href="{{url("product/stock")}}">รายการสินค้า</a>
            </li>
        
      </ul>
    </div>
  </nav>
@endforeach