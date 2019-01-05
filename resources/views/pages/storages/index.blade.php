@extends('layouts.app')

@section('content')
<table>
   <tr>
      <td>ID</td>
      <td>Name</td>
      <td>Usage</td>
      <td>Date</td>
   </tr>
   @foreach ($entries as $entry)
   <tr>
      <td>{{$entry->id}}</td>
      <td>{{$entry->name}}</td>
      <td>{{$entry->components}}</td>
      <td>{{$entry->Date}}</td>
      <td><a href="/storages/{{ $entry->id }}">Edit</a></td>
   </tr>
   @endforeach
</table>
@endsection
