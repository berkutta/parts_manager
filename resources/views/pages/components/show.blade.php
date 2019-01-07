@extends('layouts.app')

@section('content')

@if (file_exists("preview/part_".$entry->id.".jpg"))
<br>
<br>
<img src="/preview/part_{{ $entry->id }}.jpg" height="200">
@endif

<div class="card">
  <div class="card-body">
      <form action="/components/{{ $entry->id }}" method="POST">
         @csrf
         <div class="form-group">
            <label for="id">ID</label>
            <input type="text" class="form-control" name="id" value="{{ $entry->id }}" readonly>
         </div>

         <div class="form-group">
            <label for="id">Storage</label>
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

         <div class="form-group">
            <label for="id">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $entry->name }}" />
         </div>


         <div class="form-group">
            <label for="id">Datasheet</label>
            <input type="text" class="form-control" name="datasheet" value="{{ $entry->datasheet }}" />
         </div>

         <div class="form-group">
            <label for="id">Category</label>
            <input type="text" class="form-control" name="category" value="{{ $entry->category }}" />
         </div>

         <div class="form-group">
            <label for="id">Subcategory</label>
            <input type="text" class="form-control" name="subcategory" value="{{ $entry->subcategory }}" />
         </div>

         <div class="form-group">
            <label for="id">Package</label>
            <input type="text" class="form-control" name="package" value="{{ $entry->package }}" />
         </div>

         <div class="form-group">
            <label for="id">Supplier</label>
            <input type="text" class="form-control" name="supplier" value="{{ $entry->supplier }}" />
         </div>

         <div class="form-group">
            <label for="id">Description</label>
            <input type="text" class="form-control" name="description" value="{{ $entry->description }}" />
         </div>

         <div class="form-group">
            <label for="id">Tags</label>
            <input type="text" class="form-control" name="description" value="{{ $entry->tags()->pluck('slug')->implode(',') }}" />
         </div>

         <div class="form-group">
            <label for="id">Stock</label>
            <input type="text" class="form-control" name="stock" value="{{ $entry->stock }}" />
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
@endsection