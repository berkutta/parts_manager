@extends('layouts.app')

@section('content')

<form action="/components" method="POST">
   @csrf
   <br>Storage:
   <br>
   <select name="storage">
      @foreach ($storages as $storage)
      <option value="{{ $storage->name }}">{{ $storage->name }}</option>
      @endforeach
   </select> 
   <br>Description:
   <br>
   <input type="text" name="description" />
   <br>Datasheet:
   <br>
   <input type="text" name="datasheet" />
   <br>Category:
   <br>
   <input type="text" name="category" />
   <br>Package:
   <br>
   <input type="text" name="package" />
   <br>Type:
   <br>
   <input type="text" name="type" />
   <br>Supplier:
   <br>
   <input type="text" name="supplier" />
   <br>Text:
   <br>
   <input type="text" name="text" />
   <br>Stock:
   <br>
   <input type="text" name="stock" />
   <br>Stock Flag:
   <br>
   <input type="checkbox" name="stock_flag" />
   <br>
   <input type="submit" />
   <br/>
</form>
@endsection