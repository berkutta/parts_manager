@extends('layouts.app')

@section('content')

<div class="row">
   @include('pages.sidebar')
   <div class="col-md-9">
      <a class="btn btn-success create-btn" href="/storages/create" role="button">Create</a>
      <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th scope="col">Name</th>
               <th scope="col">Usage</th>
               <th scope="col">Date</th>
               <th scope="col"></th>
               <th scope="col"></th>
            </tr>
         </thead>
         <tbody>
            @foreach ($entries as $entry)
            <tr>
               <td>{{$entry->name}}</td>
               <td>{{$entry->components}}</td>
               <td>{{$entry->created_at}}</td>
               <td><a class="btn btn-primary" href="/storages/{{ $entry->id }}">Edit</a></td>
               <td>
                  <form onsubmit="return confirm('Do you really want to delete {{ $entry->name }} with its {{ $entry->components }} components?');" action="/storages/{{ $entry->id }}" method="POST">
                     @csrf
                     <input type="hidden" name="_method" value="delete" />
                     <input class="btn btn-danger" type="submit" value="Delete" />
                     <br/>
                  </form>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
</div>
@endsection
