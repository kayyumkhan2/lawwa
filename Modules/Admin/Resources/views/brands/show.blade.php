@extends('admin::layouts.master')
@section('admin::content')
<div class="main-content">
    <div class="page-title col-sm-12">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1>Single Brand</h1>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('brands')}}">Brand Manager</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Brand</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12 mb-4">
                <div class="box bg-white">
                    <div class="box-row">
                        <div class="box-content">
                            <table id="dataTable" class="table table-striped table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th> Brand Name:</th>
                                        <td>
                                            {{$brand['brand_name']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Brand Image:</th>
                                        <td>
                                            <?php
                                            if (!empty($brand->brand_logo)) {
                                                $img = $brand->brand_logo;
                                            } else {
                                                $img = 'uploads/dummy.png';
                                            }
                                            ?>
                                            <img src="{{ asset('/storage/'.$img)}}" height="50" width="50" alt="img">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> SEO Title:</th>
                                        <td>
                                            @php echo (!empty($brand['title']))?$brand['title']:"N/A"; @endphp
                                        </td>
                                    </tr>

                                    <tr>
                                        <th> SEO Key Works:</th>
                                        <td>
                                            @php echo (!empty($brand['key_words']))?$brand['key_words']:"N/A"; @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> SEO Description:</th>
                                        <td>
                                            @php echo (!empty($brand['description']))?$brand['description']:"N/A"; @endphp
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

