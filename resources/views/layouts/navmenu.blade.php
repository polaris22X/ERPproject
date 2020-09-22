@foreach($organizations as $organization)


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="{{url('organization')}}">{{$organization->organization_name}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{url('organization/menu')}}">หน้าหลัก</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/income')}}">รายรับ</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{url('/expenses')}}">รายจ่าย</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">รายงาน</a>
        </li>
      </ul>
    </div>
  </nav>
@endforeach