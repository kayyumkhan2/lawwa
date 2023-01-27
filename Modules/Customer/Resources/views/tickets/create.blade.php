@extends('front::layouts.master')
@section('title') Create Ticket @endsection
@section('content')
<section class="my-order">
  <div class="container">
    <div class="row">
        @include('customer::includes.sidebar')
        <div class="col-lg-9">
            <div class="right-content content">
              <div class="right-header">
                <div class="row align-items-center">
                  <div class="col-sm-12">
                    <h6>Create Ticket</h6>
                  </div>
                </div>
              </div>
              <div class ="ticket-right-content">
                @include('beautician::includes.flash')
                <form class="form-horizontal" role="form" method="POST" name="ticket" action="{{ route('customer.ticket.store') }}">
                    {!! csrf_field() !!}
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                          <label for="title" class="control-label">Title</label>
                          <input id="title" type="text" placeholder="Title..."  class="form-control" name="title" value="{{ old('title') }}">
                          @if ($errors->has('title'))
                          <span class="help-block error">
                            <strong>{{ $errors->first('title') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                          <label for="category" class="control-label">Category</label>
                          <select id="category" type="category" class="form-control" name="category">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('category'))
                            <span class="help-block error">
                              <strong>{{ $errors->first('category') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                          <label for="priority" class="control-label">Priority</label>
                          <select id="priority" type="" class="form-control" name="priority">
                            <option value="">Select Priority</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                          </select>
                          @if ($errors->has('priority'))
                            <span class="help-block error">
                              <strong>{{ $errors->first('priority') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                          <label for="message" class="control-label">Message</label>
                          <textarea rows="10" id="message" required="" class="form-control" name="message" placeholder="Message..."></textarea>
                            @if ($errors->has('message'))
                            <span class="help-block error">
                              <strong>{{ $errors->first('message') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="btn-block">
                          <button type="submit" class="lawwa-btn"><i class="fa fa-btn fa-ticket"></i> Open Ticket</button>
                        </div>
                      </div>
                  </form>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script type="text/javascript">
          $(function() {
            $("form[name='ticket']").validate({
              rules: {
                title: {
                  required: true,
                },
                category: {
                  required: true,
                },
                priority: {
                  required: true,
                }
              },
              messages: {
                title: {
                  required: "Please provide a title",
                },
                category: {
                  required: "Please select category",
                },
                priority: {
                  required: "Please select priority",
                },
                
              },
              submitHandler: function(form) {
                form.submit();
              }
            });
          });
      </script>
@endsection
