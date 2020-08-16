@extends('layouts.app')

@section('content')
<div class="mt-5">
    <div class="container">
  <h1>องค์กร</h1>
    
        <div class="list-group mt-3">
        @if($organizations !== null)
        @foreach($organizations as $organization)
        <a href = "/organization/main/{{$organization->id}}"  class="list-group-item">{{$organization->organization_name}}</a></li>
        @endforeach
        @endif
        <a href="/organization/add" class="list-group-item">+ เพิ่มองค์กร</a></li>
        </ul>
    </div>
</div>

@endsection
