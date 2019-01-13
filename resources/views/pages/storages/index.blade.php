@extends('layouts.app')

@section('content')

<div class="row">
   @include('pages.sidebar')
   <div class="col-md-9">
      <a class="btn btn-success create-btn" href="/storages/create" role="button">Create</a>
      <div class="table-responsive-md">
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
                  <td><a class="btn btn-primary" href="/storages/{{ $entry->id }}/edit"><i class="fas fa-edit"></i></a></td>
               <td>
                  <form onsubmit="return confirm('Do you really want to delete {{ $entry->name }} with its {{ $entry->components }} components?');" action="/storages/{{ $entry->id }}" method="POST">
                     @csrf
                     <input type="hidden" name="_method" value="delete" />
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                     <br/>
                  </form>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
      <div class="text-xs-center">
         {!! $entries->appends(request()->except('page'))->links() !!}
      </div>
</div>
</div>
@endsection
