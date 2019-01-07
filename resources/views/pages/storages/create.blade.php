@extends('layouts.app')

@section('content')
<div class="row">
   @include('pages.sidebar')
   <div class="col-md-9">
      <div class="card">
         <div class="card-body">
               <form action="/storages" method="POST">
                  @csrf
                  <div class="form-group row">
                     <label class="col-sm-2 col-form-label" for="id">Name</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" />
                     </div>
                  </div>
                  
                  <input class="btn btn-primary" type="submit" />
                  <br/>
               </form>
         </div>
      </div>
   </div>
</div>
@endsection