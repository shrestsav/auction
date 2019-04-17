@extends('backend.layouts.app',['title'=>'Adjustments'])
@push('styles')
<style type="text/css">
	.modal-title{
		text-align: center;
	}
  .show_states a:hover h5{
    color: green !important;
    cursor: pointer;
  }
</style>
@endpush
@section('content')


@php 
    $adjustment_modules = 
              [
                'State' => [
                              'example' => 'New York',
                              'modal_id' => 'show_states',
                              'route' => 'adjustments.set_state',
                              'passed_variable' => 'states',
                              'icon' => 'state.png'
                           ],
                'Payment Method' => 
                            [
                              'example' => 'Cash',
                              'modal_id' => 'show_payment_methods',
                              'route' => 'adjustments.set_payment_method',
                              'passed_variable' => 'payment_methods',
                              'icon' => 'payment.png'
                            ],
              ];
@endphp


    <!-- Main content -->
    <section class="content">
      <div class="row">
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
        @if (\Session::has('message'))
          <div class="alert alert-success custom_success_msg">
              {{ \Session::get('message') }}
          </div>
        @endif

        @foreach($adjustment_modules as $module_name => $module)
        	<div class="col-md-4">
            <div class="box box-widget widget-user-2">
              <div class="widget-user-header bg-purple">
                <div class="widget-user-image">
                  <img class="img-circle" src="{{ asset('backend/img/'.$module["icon"]) }}" alt="User Avatar">
                </div>
                <div class="show_states"> 
                  <a data-toggle="modal" data-target="#{{$module['modal_id']}}"><h5 class="pull-right" style="float: left; color: white;">Show All</h5></a>
                </div>
                <h3 class="widget-user-username">{{$module_name}}</h3>

                <h5 class="widget-user-desc">Add New</h5>
              </div>
              <div class="box-footer no-padding">
                 <form class="form-horizontal" action="{{route($module['route'])}}" method="post">
                 		@csrf
  	              <div class="box-body">
  	                <div class="form-group">
  	                  <label for="state" class="col-sm-4 control-label">{{$module_name}}</label>
  	                  <div class="col-sm-6">
  	                    <input type="text" name="name" class="form-control" id="state" placeholder="Eg: {{$module['example']}}">
  	                  </div>
  	                </div>
  	              </div>
  	              <div class="box-footer">
  	                <button type="button" class="btn btn-default">Cancel</button>
  	                <button type="submit" class="btn btn-info pull-right">Save</button>
  	              </div>
  	            </form>
              </div>
            </div>
          </div>

          <div class="modal fade" id="{{$module['modal_id']}}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Available {{$module_name}}</h4>
                </div>
                <div class="modal-body">
                  <table class="table table-hover">
                    <tr>
                      <th>S.No</th>
                      <th>{{$module_name}}</th>
                      <th>Action</th>
                    </tr>
                  @foreach(${$module['passed_variable']} as $data)
                    <tr>
                      <td>{{$data->id}}</td>
                      <td>{{$data->name}}</td>
                      <td><i class="fa fa-pencil"></i> &nbsp; &nbsp; <i class="fa fa-remove"></i></td>
                    </tr>
                  @endforeach
                </table>
                </div>
              </div>
            </div>
          </div>

        @endforeach
       
      </div>
    </section>

@endsection

@push('scripts')
@endpush