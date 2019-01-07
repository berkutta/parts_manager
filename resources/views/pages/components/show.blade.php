@extends('layouts.app')

@section('content')

@if (file_exists("preview/part_".$entry->id.".jpg"))
<br>
<br>
<img src="/preview/part_{{ $entry->id }}.jpg" height="200">
@endif


<form action="/components/{{ $entry->id }}" method="POST">
   @csrf
   <br>ID:
   <br>
   <input type="text" name="id" value="{{ $entry->id }}" />
   <br>Storage:
   <br>
   <select name="storage">
      @foreach ($storages as $storage)
      @if($entry->storage['name'] == $storage->name)
      <option value="{{ $storage->name }}" selected>{{ $storage->name }}</option>
      @else
      <option value="{{ $storage->name }}">{{ $storage->name }}</option>
      @endif
      @endforeach
   </select> 
   <br>Name:
   <br>
   <input type="text" name="name" value="{{ $entry->name }}" />
   <br>Datasheet:
   <br>
   <input type="text" name="datasheet" value="{{ $entry->datasheet }}" />
   <br>Category:
   <br>
   <input type="text" name="category" value="{{ $entry->category }}" />
   <br>Subcategory:
   <br>
   <input type="text" name="subcategory" value="{{ $entry->subcategory }}" />
   <br>Package:
   <br>
   <input type="text" name="package" value="{{ $entry->package }}" />
   <br>Supplier:
   <br>
   <input type="text" name="supplier" value="{{ $entry->supplier }}" />
   <br>Description:
   <br>
   <input type="text" name="description" value="{{ $entry->description }}" />
   <br>Tags:
   <br>
   <input type="text" name="tags" value="{{ implode(',', $entry->tags()->pluck('slug')->toArray()) }}" />
   <br>Stock:
   <br>
   <input type="text" name="stock" value="{{ $entry->stock }}" />
   <br>Stock Flag:
   <br>
   @if ($entry->stock_flag == 1)
   <input type="checkbox" name="stock_flag" checked/>
   @else
   <input type="checkbox" name="stock_flag" />
   @endif
   <br>
   <input type="hidden" name="_method" value="put" />
   <input type="submit" />
   <br/>
</form>
@endsection