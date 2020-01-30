@extends('layouts.app')

@section('content')
<div class="row">
   @include('pages.sidebar')
   <div class="col-md-9">
   <a class="btn btn-success create-btn" href="/components/create" role="button">Create</a>
      <div class="table-responsive-md d-none d-md-block">
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
                  @empty($entry->extra_attributes['datasheet'])
                  <td></td>
                  @else
                  <td><a class="btn btn-primary" href="{{ $entry->extra_attributes['datasheet'] }}">Link</a></td>
                  @endempty
                  <td>{{ $entry->category }}</td>
                  <td>{{ $entry->extra_attributes['subcategory'] }}</td>
                  <td>{{ $entry->extra_attributes['package'] }}</td>
                  <td>
                  @foreach ($entry->tags as $tag)
                     <span class="badge badge-primary">{{ $tag->slug }}</span>
                  @endforeach
                  <td>{{ $entry->stock }}</td>
                  @if ($entry->stock_flag == 1)
                  <td class="control-element">
                     <form action="/components/{{ $entry->id }}" method="POST">
                        @csrf
                        <input type="hidden" name="stock" value="+1" />
                        <input type="hidden" name="_method" value="put" />
                        <input class="btn btn-primary" type="submit" value="+" />
                        <br/>
                     </form>
                  </td>
                  <td class="control-element">
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
                     <td class="control-element"><a class="btn btn-primary" href="/components/{{ $entry->id }}/edit"><i class="fas fa-edit"></i></a></td>
                  <td class="control-element">
                     <form onsubmit="return confirm('Do you really want to delete {{ $entry->name }}?');" action="/components/{{ $entry->id }}" method="POST">
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

      <div class="d-md-none">
         @foreach ($entries as $entry)
         <div class="card card-margin">
            <div class="card-body">
               <h5 class="card-title">{{ $entry->name }}</h5>
               <p class="card-text">Category: {{ $entry->category }}</p>
               @if ($entry->stock_flag == 1)
               <p class="card-text">Stock: {{ $entry->stock }}</p>
               @endif
               @foreach ($entry->tags as $tag)
               <span class="badge badge-primary tag-margin">{{ $tag->slug }}</span>
               @endforeach
                  <div class="form-row">
                  @if ($entry->stock_flag == 1)
                     <div class="control-element">
                        <form action="/components/{{ $entry->id }}" method="POST">
                           @csrf
                           <input type="hidden" name="stock" value="+1" />
                           <input type="hidden" name="_method" value="put" />
                           <input class="btn btn-primary" type="submit" value="+" />
                           <br/>
                        </form>
                     </div>
                     <div class="control-element">
                        <form action="/components/{{ $entry->id }}" method="POST">
                           @csrf
                           <input type="hidden" name="stock" value="-1" />
                           <input type="hidden" name="_method" value="put" />
                           <input class="btn btn-primary" type="submit" value="-" />
                           <br/>
                        </form>
                     </div>
                  @else
                  @endif
                     @empty($entry->extra_attributes['datasheet'])

                     @else
                     <div class="control-element">
                        <a class="btn btn-primary" href="{{ $entry->extra_attributes['datasheet'] }}"><i class="fas fa-info"></i></a>
                     </div>
                     @endempty

                     <div class="control-element">
                        <a class="btn btn-primary" href="/components/{{ $entry->id }}/edit"><i class="fas fa-edit"></i></a>
                     </div>
                     <div class="control-element">
                        <form onsubmit="return confirm('Do you really want to delete {{ $entry->name }}?');" action="/components/{{ $entry->id }}" method="POST">
                           @csrf
                           <input type="hidden" name="_method" value="delete" />
                           <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                           <br/>
                        </form>
                     </div>
                  </div>
            </div>
         </div>
         @endforeach
      </div>

      <div class="text-xs-center">
         {!! str_replace("pagination", "pagination flex-wrap", $entries->appends(request()->except('page'))->links()) !!}
      </div>
   </div>
</div>
@endsection
