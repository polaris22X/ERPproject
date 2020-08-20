@extends('layouts.app')
@extends('layouts.checkauth')
@section('content')
<div class="mt-5">
<div class="container">
  
    <form action="/organization" method="POST" >
      @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Organization Name</label>
          <input type="text" class="form-control" id="organization_name" name="organization_name" aria-describedby="emailHelp" placeholder="Enter Organization Name">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Organization Address</label>
          <input type="text" class="form-control" id="organization_address" name="organization_address" placeholder="Enter Organization Address">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
</div>

@endsection
