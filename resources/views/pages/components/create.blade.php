@extends('layouts.app')

@section('content')

<div class="row">
   @include('pages.sidebar')
   <div class="col-md-9">
      <div class="card">
         <div class="card-body">
               <form action="/components" method="POST">
                  @csrf
                  <div class="form-group">
                     <label for="id">Storage</label>
                     <select class="form-control" name="storage">
                        @foreach ($storages as $storage)
                        <option value="{{ $storage->name }}">{{ $storage->name }}</option>
                        @endforeach
                     </select> 
                  </div>

                  <div class="form-group">
                     <label for="id">Name</label>
                     <input type="text" class="form-control" name="name" />
                  </div>

                  <div class="form-group">
                     <label for="id">Datasheet</label>
                     <input type="text" class="form-control" name="datasheet" />
                  </div>

                  <div class="form-group">
                     <label for="id">Category</label>
                     <input type="text" class="form-control" name="category" />
                  </div>

                  <div class="form-group">
                     <label for="id">Subcategory</label>
                     <input type="text" class="form-control" name="subcategory" />
                  </div>

                  <div class="form-group">
                     <label for="id">Package</label>
                     <input type="text" class="form-control" name="package" />
                  </div>

                  <div class="form-group">
                     <label for="id">Supplier</label>
                     <input type="text" class="form-control" name="supplier" />
                  </div>

                  <div class="form-group">
                     <label for="id">Description</label>
                     <input type="text" class="form-control" name="description" />
                  </div>

                   <div class="form-group">
                     <label for="id">Tags</label>
                     <input type="text" class="form-control" name="tags" />
                  </div>
 
                  <div class="form-group">
                     <label for="id">Stock</label>
                     <input type="text" class="form-control" name="stock" />
                  </div>

                  <div class="form-check">
                     <input class="form-check-input" type="checkbox" class="form-control" name="stock_flag" checked/>
                     <label class="form-check-label">
                        Stock Flag
                     </label>
                  </div>

                  <input class="btn btn-primary" type="submit" />
                  <br/>
               </form>
         </div>
      </div>
   </div>
</div>
@endsection