@extends('front::layouts.master')
@section('title') Dashboard @endsection
@section('content')
<!-- Lawwa My Account -->
<section class="my-order">
  <div class="container">
    <div class="row">
      @include('beautician::includes.sidebar')
      <div class="col-lg-9">
        <div class="right-content content">
           <div class="my-account-header">
            <h6>Bank Detail</h6>
            <form action="{{route('beautician.bankdetail.store')}}" method="post">
              @csrf
              <div class="back-details show-block" style="">
                <div class="form-group">
                  <select class="form-control @error('bank_name') is-invalid @enderror" name="bank_name">
                    <option value="">Select Bank</option>
                    @foreach($Banks as $Bank) 
                      <option value="{{$Bank->name}}">{{$Bank->name}}</option>
                    @endforeach  
                  </select>
                  @error('bank_name')
                    <div class="error text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="text" placeholder="Holder Name" value="{{old('account_name')}}" name="account_name" class="form-control @error('account_name') is-invalid @enderror">
                  @error('account_name')
                    <div class="error text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="text" placeholder="Account Number" value="{{old('account_number')}}" name="account_number" class="form-control @error('account_number') is-invalid @enderror">
                  @error('account_number')
                    <div class="error text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="text" placeholder="Confirm Account Number" value="{{old('confirm_account_number')}}" name="confirm_account_number" class="form-control @error('account_number') is-invalid @enderror">
                  @error('confirm_account_number')
                    <span class="error text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="btn-block">
                  <button type="submit" class="lawwa-btn w-100 d-block">Save</button>
                </div>
              </div>
            </form>
          </div>
          <div class="table-responsive">
              <table class="table">
                <thead>
                <tr>
                  <th scope="col">Bank Name</th>
                  <th scope="col">Account Holder Name</th>
                  <th scope="col">Account Number</th>
                  <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
               @foreach($BankDetails as $Details)   
                <tr>
                  <th scope="row">{{$Details->bank_name}}</th>
                  <td>{{$Details->account_name}}</td>
                  <td>{{$Details->account_number}}</td>
                  <td class="edit-text"><a href="{{route('beautician.bankdetail.edit',$Details->id)}}">Edit</a></td>
                </tr>
                @endforeach
                </tbody>
                </table>
           </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection