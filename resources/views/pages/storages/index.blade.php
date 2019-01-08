@extends('layouts.app')

@section('content')

<div class="row">
   @include('pages.sidebar')
   <div class="col-md-9">
      <a class="btn btn-success create-btn" href="/storages/create" role="button">Create</a>
      <table class="table table-hover">
         <thead>
            <tr>
               <th scope="col">ID</th>
               <th scope="col">Name</th>
               <th scope="col">Usage</th>
               <th scope="col">Date</th>
               <th scope="col"></th>
            </tr>
         </thead>
         <tbody>
            @foreach ($entries as $entry)
            <tr>
               <th scope="row">{{$entry->id}}</td>
               <td>{{$entry->name}}</td>
               <td>{{$entry->components}}</td>
               <td>{{$entry->created_at}}</td>
               <td><a class="btn btn-primary" href="/storages/{{ $entry->id }}">Edit</a></td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
@endsection
