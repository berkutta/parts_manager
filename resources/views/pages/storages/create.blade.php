@extends('layouts.app')

@section('content')
<form action="/storages" method="POST">
   @csrf
   <br>Name:
   <br>
   <input type="text" name="name" />
   <br>
   <input type="submit" />
   <br/>
</form>
@endsection