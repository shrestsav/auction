@extends('backend.layouts.app',['title'=>'Vendors'])

@section('content')

    <section class="content">
      <div class="row">
      	<div class="col-md-12">
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
          <div class="box box-success collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Add Vendor</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<form role="form" method="POST" action="{{route('vendors.store')}}">
            	@csrf
	              	<div class="col-md-2">
		                <div class="form-group">
		                  <label for="v_vendor_code">Vendor Code *</label>
		                  <input type="text" name="vendor_code" class="form-control" id="v_vendor_code" placeholder="Enter Vendor Code" required>
		                </div>
		            </div>
		            <div class="col-md-5">
		                <div class="form-group">
		                  <label for="v_first_name">First Name *</label>
		                  <input type="text" name="first_name" class="form-control" id="v_first_name" placeholder="Enter First Name" required>
		                </div>
		            </div>
		            <div class="col-md-5">
		                <div class="form-group">
		                  <label for="v_last_name">Last Name *</label>
		                  <input type="text" name="last_name" class="form-control" id="v_last_name" placeholder="Enter Last Name" required>
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="v_address">Address *</label>
		                  <input type="text" name="address" class="form-control" id="v_address" placeholder="Address" required>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="v_suburb">Suburb *</label>
		                  <input type="text" name="suburb" class="form-control" id="v_suburb" placeholder="Suburb" required>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  	<label for="v_state">State *</label>
		                	<select name="state" class="form-control select2" id="v_state" style="width: 100%;" required>
			                  <option hidden disabled selected value>Select State</option>
			                  @foreach($states as $state)
				                  <option value="{{$state->name}}">{{$state->name}}</option>
				              @endforeach
			                </select>
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="v_postcode">Postcode *</label>
		                  <input type="number" name="postcode" class="form-control" id="v_postcode" placeholder="Postcode" required>
		                </div>
		            </div>
		           	<div class="col-md-4">
		                <div class="form-group">
		                  <label for="v_telephone_home">Telephone Home </label>
		                  <input type="text" name="telephone_home" class="form-control" id="v_telephone_home" placeholder="Telephone Home ">
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="v_telephone_work">Telephone Work </label>
		                  <input type="text" name="telephone_work" class="form-control" id="v_telephone_work" placeholder="Telephone Work ">
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="v_mobile">Mobile </label>
		                  <input type="text" name="mobile" class="form-control" id="v_mobile" placeholder="Mobile">
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="v_email">Email </label>
		                  <input type="email" name="email" class="form-control" id="v_email" placeholder="Email">
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="v_joined_date">Joined Date </label>
		                  <input type="date" name="joined_date" class="form-control" id="v_joined_date" placeholder="Joined Date" required>
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="form-group">
		                  <label for="v_account_no">A/C No </label>
		                  <input type="text" name="a/c_no" class="form-control" id="v_account_no" placeholder="A/C Number">
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="form-group">
		                  <label for="v_bsb_no">BSB No </label>
		                  <input type="text" name="bsb_no" class="form-control" id="v_bsb_no" placeholder="BSB Number">
		                </div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                  <label for="v_abn">ABN</label>
		                  <input type="text" name="abn" class="form-control" id="v_abn" placeholder="ABN">
		                </div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                	<label for="v_gst_status">GST Status *</label>
		                  	<select class="form-control" name="gst_status" id="v_gst_status" required>
			                  <option selected="selected" value="inclusive">Inclusive</option>
			                  <option value="exclusive">Exclusive</option>
			                </select>
		                </div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                  <label for="v_payment_method">Payment Method *</label>
		                  <select class="form-control" name="payment_method" id="v_payment_method" required>
			                  <option selected="selected" disabled> </option>
			                  @foreach($payment_methods as $payment_method)
				                  <option value="{{$payment_method}}">{{$payment_method}}</option>
				              @endforeach
			              </select>
		                </div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                  <label for="v_commission">Commission *</label>
		                  <input type="number" name="commission" class="form-control" id="v_commission" placeholder="Commission" required>
		                </div>
		            </div>
		            <div class="col-md-12">
		                <div class="form-group">
		                  <label for="v_comments">Comments</label>
		                  <textarea type="text" name="comments" class="form-control" id="v_comments" placeholder="Comments"></textarea>
		                </div>
		            </div>
			        <div class="col-md-12">
			        	<div class="box-footer">
		              		<button type="submit" class="btn btn-primary">Submit</button>
		            	</div>
			        </div>    
            	</form>
            </div>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">List of Vendors</h3>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
	                <tr>
	                  <th>Vendor Code</th>
	                  <th>Vendor Name</th>
	                  <th>Mobile</th>
	                  <th>Joined Date</th>
	                  <th>Address</th>
	                  <th>Action</th>
	                </tr>
                  @foreach($vendors as $vendor)
	                <tr>
	                  <td>{{$vendor->vendor_code}}</td>
	                  <td>{{$vendor->first_name}} {{$vendor->last_name}}</td>
	                  <td>{{$vendor->mobile}}</td>
	                  <td><span class="label label-success">{{$vendor->joined_date}}</span></td>
	                  <td>{{$vendor->address}}</td>
	                  <td>
	                  	@if(count($vendor->stock))
	                  		<a href="#" data-toggle="modal" data-target="#vendor_stocks_{{$vendor->id}}">
			                  	<i class="fa fa-dot-circle-o"></i>
			                </a>
							<div class="modal fade vendor_stocks_modal" id="vendor_stocks_{{$vendor->id}}">
						      <div class="modal-dialog">
						        <div class="modal-content">
						          <div class="modal-header">
						            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						              <span aria-hidden="true">&times;</span></button>
						            <h4 class="modal-title">Stocks</h4>
						          </div>
						          <div class="modal-body">
						            <table class="table table-hover">
						                <tr>
						                	<th>S.No</th>
							                <th>Form No</th>
							                <th>Item No</th>
							                <th>Description</th>
							                <th>Quantity</th>
							                <th>Left</th>
							                <th>Reserve</th>
							                <th>Sold</th>
						                </tr>
						            @php 
						            	$count = 1; 
						            @endphp
						            @foreach($vendor->stock as $stock)
						            	@php 
						            		$total_sales = 0; 
							            	if(count($stock->lotting)){
							            		foreach($stock->lotting as $lotting){
							            			if(count($lotting->sale)){
							            				foreach($lotting->sale as $sale){
							            					$total_sales += $sale->quantity;
							            				}
							            			}
							            		}
							            	}
							            @endphp
						                <tr>
						                  <td>{{$count}}</td>
						                  <td>{{$stock->form_no}}</td>
						                  <td>{{$stock->item_no}}</td>
						                  <td>{{$stock->description}}</td>
						                  <td>{{$stock->quantity}}</td>
						                  <td>{{$stock->quantity - $total_sales}}</td>
						                  <td>{{$stock->reserve}}</td>
						                  <td>{{$total_sales}}</td>
						                </tr>
								        @php  
								        	$count++; 
								        @endphp
						            @endforeach
						          </table>
						          </div>
						        </div>
						      </div>
						    </div>
	                  	@endif
	                  </td>
	                </tr>
                  @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection