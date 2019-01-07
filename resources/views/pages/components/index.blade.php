@extends('layouts.app')

@section('content')
<table>
   <tr>
      <td></td>
      <td>ID</td>
      <td>Storage</td>
      <td>Name</td>
      <td>Datasheet</td>
      <td>Category</td>
      <td>Subcategory</td>
      <td>Package</td>
      <td>Tags</td>
      <td>Stock</td>
    </tr>

   @foreach ($entries as $entry)
    <tr>
      <td>{{ $entry->id }}</td>
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
      <td><a href="{{ $entry->datasheet }}">Link</a></td>
      @endempty
      <td>{{ $entry->category }}</td>
      <td>{{ $entry->subcategory }}</td>
      <td>{{ $entry->package }}</td>
      <td>{{ implode(',', $entry->tags()->pluck('slug')->toArray()) }}</td>
      <td>{{ $entry->stock }}</td>
      @if ($entry->stock_flag == 1)
      <td>
         <form action="/components/{{ $entry->id }}" method="POST">
            @csrf
            <input type="hidden" name="stock" value="+1" />
            <input type="hidden" name="_method" value="put" />
            <input type="submit" value="+" />
            <br/>
         </form>
      </td>
      <td>
         <form action="/components/{{ $entry->id }}" method="POST">
            @csrf
            <input type="hidden" name="stock" value="-1" />
            <input type="hidden" name="_method" value="put" />
            <input type="submit" value="-" />
            <br/>
         </form>
      </td>
      @else
      <td></td>
      <td></td>
      @endif
      <td><a href="/components/{{ $entry->id }}">Edit</a></td>
   </tr>
   @endforeach

</table>
@endsection
