@extends('backend.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vendors
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
      	<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Vendor</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{route('vendors.store')}}">
            	@csrf
	            <div class="box-body">
	              	<div class="col-md-6">
		                <div class="form-group">
		                  <label for="v_first_name">First Name</label>
		                  <input type="text" name="first_name" class="form-control" id="v_first_name" placeholder="Enter First Name" required>
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="form-group">
		                  <label for="v_last_name">Last Name</label>
		                  <input type="text" name="last_name" class="form-control" id="v_last_name" placeholder="Enter Last Name" required>
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="v_address">Address *</label>
		                  <input type="text" name="address" class="form-control" id="v_address" placeholder="Address" required>
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="v_suburb">Suburb *</label>
		                  <input type="text" name="suburb" class="form-control" id="v_suburb" placeholder="Suburb" required>
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="v_state">State *</label>
		                  <input type="text" name="state" class="form-control" id="v_state" placeholder="State" required>
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
		                  <input type="text" name="gst_status" class="form-control" id="v_gst_status" placeholder="GST Status" required>
		                </div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                  <label for="v_payment_method">Payment Method *</label>
		                  <input type="text" name="payment_method" class="form-control" id="v_payment_method" placeholder="Payment Method" required>
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
	            </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Vendors</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
	                <tr>
	                  <th>Vendor Code</th>
	                  <th>Vendor Name</th>
	                  <th>Mobile</th>
	                  <th>Joined Date</th>
	                  <th>Reason</th>
	                </tr>
                @foreach($vendors as $vendor)
	                <tr>
	                  <td>{{$vendor->vendor_code}}</td>
	                  <td>{{$vendor->first_name}} {{$vendor->last_name}}</td>
	                  <td>{{$vendor->mobile}}</td>
	                  <td><span class="label label-success">{{$vendor->joined_date}}</span></td>
	                  <td>{{$vendor->address}}</td>
	                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->


  </div>
  <!-- /.content-wrapper -->

@endsection