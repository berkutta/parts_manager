@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
      <form action="/storages" method="POST">
         @csrf
         <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="id">ID</label>
            <div class="col-sm-10">
               <input type="text" class="form-control" name="id" value="{{ $entry->id }}" readonly/>
            </div>
         </div>

         <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="id">Name</label>
            <div class="col-sm-10">
               <input type="text" class="form-control" name="name" value="{{ $entry->name }}" />
            </div>
         </div>
         
         <input type="hidden" name="_method" value="put" />
         <input class="btn btn-primary" type="submit" />
         <br/>
      </form>
  </div>
</div>
@endsection