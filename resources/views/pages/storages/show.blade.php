@extends('layouts.app')

@section('content')
<form action="/storages/{{ $entry->id }}" method="POST">
   @csrf
   <br>ID:
   <br>
   <input type="text" name="id" value="{{ $entry->id }}" />
   <br>Name:
   <br>
   <input type="text" name="name" value="{{ $entry->name }}" />
   <br>
   <input type="hidden" name="_method" value="put" />
   <input type="submit" />
   <br/>
</form>
@endsection