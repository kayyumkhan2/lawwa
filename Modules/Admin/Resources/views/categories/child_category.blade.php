    <li class="notification{{$category->id}}">
	<input type="" name="" data-id="{{$child_category->id}}" value="{{$child_category->name}}" class="mt-2 update">  <span class="icon-btn edit dataclass " data-toggle="modal" 
                                                                data-id="{{ $child_category->id }}" 
                                                                data-name="{{ $child_category->name }}"  
                                                                data-title="{{ $child_category->title}}" 
                                                                data-categorey_type="{{ $child_category->categorey_type }}"   
                                                                data-description="{{ $child_category->description }}"   
                                                                data-category_image="{{ asset('public/images/categoriesimages/'.$child_category->image)}}" 
                                                                 data-target="#myModal"><i class="fal fa-edit btn btn-outline-primary btn-sm rounded-circle" id="show-edit" ></i></span> <a class="icon-btn delete remove-category " href="javascript:void(0);" data-status="0" data-id="{{ $child_category->id}}"  data-model="Category" id="notification{{$child_category->id}}" ><i class="fal fa-trash-alt btn btn-outline-danger btn-sm rounded-circle" id="delete-btn" ></i></a>    </li>	
		@if ($child_category->subcategory)
		   <ul>
		        @foreach ($child_category->subcategory as $childCategory)
		            @include('admin.categories.child_category', ['child_category' => $childCategory])
		        @endforeach
		  </ul>
		@endif