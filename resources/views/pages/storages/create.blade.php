@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
      <form action="/storages" method="POST">
         @csrf
         <div class="form-group">
            <label for="id">Name</label>
            <input type="text" class="form-control" name="name" />
         </div>
         
         <input class="btn btn-primary" type="submit" />
         <br/>
      </form>
  </div>
</div>
@endsection