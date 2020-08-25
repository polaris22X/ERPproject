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
            <button type="button" class="btn btn-primary mr-2"  data-toggle="modal" data-target="#ModalMakeQuotation">+ สร้างใบเสนอราคา</a> 
            <button type="button" class="btn btn-secondary mr-2"  data-toggle="modal" data-target="#ModalMakeQuotation">+ แก้ไขรายการรายรับ</a> 
            <button type="button" class="btn btn-danger mr-2"  data-toggle="modal" data-target="#ModalMakeQuotation">+ ลบใบเสนอราคา</a> 
        </div>

        
    </div>

@endsection
