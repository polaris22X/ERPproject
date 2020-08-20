@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
<div class="container">
    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header">แจ้งเตือน</div>
        <div class="card-body">
          <h5 class="card-title">สร้างธุรกิจสำเร็จแล้ว</h5>
             <p class="card-text">การสร้างธุรกิจของคุณสำเร็จแล้ว<br>
             <a href="{{ url('organization') }}">กลับสู่หน้าเลือกองค์กร</a>
            </p>
        </div>
      </div>
</div>

@endsection
