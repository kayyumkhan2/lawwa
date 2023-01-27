  <option value="{{ $child_category->id }}" style="margin-left: {{$i=$i+18}}px !important ;">
  	{{ $child_category->name }}</option>

@if ($child_category->categories)
        @foreach ($child_category->categories as $childCategory)
            @include('admin.products.child_category', ['child_category' => $childCategory])
        @endforeach
@endif