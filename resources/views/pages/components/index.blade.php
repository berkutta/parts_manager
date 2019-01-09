@extends('layouts.app')

@section('content')
<div class="row">
   @include('pages.sidebar')
   <div class="col-md-9">
   <a class="btn btn-success create-btn" href="/components/create" role="button">Create</a>
      <table class="table table-hover">
         <thead>
            <tr>
               <th scope="col"></th>
               <th scope="col">Storage</th>
               <th scope="col">Name</th>
               <th scope="col">Datasheet</th>
               <th scope="col">Category</th>
               <th scope="col">Subcategory</th>
               <th scope="col">Package</th>
               <th scope="col">Tags</th>
               <th scope="col">Stock</th>
               <th scope="col"></th>
               <th scope="col"></th>
               <th scope="col"></th>
               <th scope="col"></th>
            </tr>
         </thead>

         <tbody>
            @foreach ($entries as $entry)
            <tr>
               @if (file_exists("preview/part_".$entry->id.".jpg"))
               <td><img src="/preview/part_{{ $entry->id }}.jpg" height="42"></td>
               @else
               <td></td>
               @endif
               <td>{{ $entry->storage['name'] }}</td>
               <td>{{ $entry->name }}</td>
               @empty($entry->datasheet)
               <td></td>
               @else
               <td><a class="btn btn-primary" href="{{ $entry->datasheet }}">Link</a></td>
               @endempty
               <td>{{ $entry->category }}</td>
               <td>{{ $entry->subcategory }}</td>
               <td>{{ $entry->package }}</td>
               <td>
               @foreach ($entry->tags as $tag)
                  <span class="badge badge-primary">{{ $tag->slug }}</span>
               @endforeach
               <td>{{ $entry->stock }}</td>
               @if ($entry->stock_flag == 1)
               <td>
                  <form action="/components/{{ $entry->id }}" method="POST">
                     @csrf
                     <input type="hidden" name="stock" value="+1" />
                     <input type="hidden" name="_method" value="put" />
                     <input class="btn btn-primary" type="submit" value="+" />
                     <br/>
                  </form>
               </td>
               <td>
                  <form action="/components/{{ $entry->id }}" method="POST">
                     @csrf
                     <input type="hidden" name="stock" value="-1" />
                     <input type="hidden" name="_method" value="put" />
                     <input class="btn btn-primary" type="submit" value="-" />
                     <br/>
                  </form>
               </td>
               @else
               <td></td>
               <td></td>
               @endif
               <td><a class="btn btn-primary" href="/components/{{ $entry->id }}">Edit</a></td>
               <td>
                  <form onsubmit="return confirm('Do you really want to delete {{ $entry->name }}?');" action="/components/{{ $entry->id }}" method="POST">
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

      <div class="text-xs-center">
         {!! $entries->appends(request()->except('page'))->links() !!}
      </div>
   </div>
</div>
@endsection
