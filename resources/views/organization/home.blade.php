@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')


    <div class="container my-5 shadow p-5 mb-5 bg-white rounded">
        <h1>องค์กร</h1>
        
        <div class="list-group mt-3">
        @if($organizations !== null)
        @foreach($organizations as $organization)
        <a href = "/organization/main/{{$organization->id}}"  class="list-group-item">{{$organization->organization_name}}</a></li>
        @endforeach
        @endif
        <a href="/organization/add" class="list-group-item bg-primary text-white">+ เพิ่มองค์กร</a></li>
        </ul>
    </div>


@endsection
