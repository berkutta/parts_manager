@extends('layouts.app')

@section('content')

<div class="row">
   @include('pages.sidebar')
         <div class="col-md-9">
      @if (file_exists("preview/part_".$entry->id.".jpg"))
      <br>
      <br>
      <img src="/preview/part_{{ $entry->id }}.jpg" height="200">
      @endif

      <div class="card">
         <div class="card-body">
               <form action="/components/{{ $entry->id }}" method="POST">
                  @csrf
                  <div class="form-group row">
                     <label class="col-sm-2 col-form-label" for="id">ID</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="id" value="{{ $entry->id }}" readonly/>
                     </div>
                  </div>

                  <div class="form-group row">
                     <label class="col-sm-2 col-form-label" for="id">Storage</label>
                     <div class="col-sm-10">
                        <select class="form-control" name="storage">
                           @foreach ($storages as $storage)
                           @if($entry->storage['name'] == $storage->name)
                           <option value="{{ $storage->name }}" selected>{{ $storage->name }}</option>
                           @else
                           <option value="{{ $storage->name }}">{{ $storage->name }}</option>
                           @endif
                           @endforeach
                        </select>
                     </div>
                  </div>

                  <div class="form-group row">
                     <label class="col-sm-2 col-form-label" for="id">Name</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{ $entry->name }}" />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label class="col-sm-2 col-form-label" for="id">Datasheet</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="datasheet" value="{{ $entry->datasheet }}" />
                     </div>
                  </div>

                  <div class="form-group row">
                     <label class="col-sm-2 col-form-label" for="id">Category</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="category" value="{{ $entry->category }}" />
                     </div>
                  </div>

                  <div class="form-group row">
                     <label class="col-sm-2 col-form-label" for="id">Subcategory</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="subcategory" value="{{ $entry->subcategory }}" />
                     </div>
                  </div>

                  <div class="form-group row">
                     <label class="col-sm-2 col-form-label" for="id">Package</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="package" value="{{ $entry->package }}" />
                     </div>
                  </div>

                  <div class="form-group row">
                     <label class="col-sm-2 col-form-label" for="id">Supplier</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="supplier" value="{{ $entry->supplier }}" />
                     </div>
                  </div>

                  <div class="form-group row">
                     <label class="col-sm-2 col-form-label" for="id">Description</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="description" value="{{ $entry->description }}" />
                     </div>
                  </div>

                  <div class="form-group row">
                     <label class="col-sm-2 col-form-label" for="id">Tags</label>
                     <div class="col-sm-10">
                        <input type="text" data-role="tagsinput" class="form-control" name="tags" value="{{ $entry->tags()->pluck('slug')->implode(',') }}" />
                     </div>
                  </div>

                  <div class="form-group row">
                     <label class="col-sm-2 col-form-label" for="id">Stock</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="stock" value="{{ $entry->stock }}" />
                     </div>
                  </div>

                  <div class="form-check">
                     @if ($entry->stock_flag == 1)
                     <input class="form-check-input" type="checkbox" class="form-control" name="stock_flag" checked/>
                     @else
                     <input class="form-check-input" type="checkbox" class="form-control" name="stock_flag" />
                     @endif
                     <label class="form-check-label">
                        Stock Flag
                     </label>
                  </div>

                  <input type="hidden" name="_method" value="put" />
                  <input class="btn btn-primary" type="submit" />
                  <br/>
               </form>
         </div>
      </div>
   </div>
</div>
@endsection