<span class="mr-5"><option value="{{$child_category->id}}" > @for($k = 0; $k <= $i; $k++) &nbsp;&nbsp;&nbsp;&nbsp;  @endfor @php $i++; @endphp {{$child_category->name}}</option></span>	
@if ($child_category->subcategory)
        @foreach ($child_category->subcategory as $childCategory)
            @include('admin.categories.child_option', ['child_category' => $childCategory])
        @endforeach
       
@endif
