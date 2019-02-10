@extends('backend.layouts.app',['title'=>'Stocks'])

@section('content')

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">

      	<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success ">
            <div class="box-header with-border">
              <h3 class="box-title">Add Stock</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<form role="form" method="POST" action="{{route('stocks.store')}}">
            	@csrf
            		<div class="col-md-2">
		                <div class="form-group">
		                  <label for="s_vendor_code">Vendor Code</label>
		                  <select name="vendor_code" class="form-control select2" id="s_vendor_code" style="width: 100%;" required>
			                  <option selected="selected" disabled>Vendor Code</option>
			                  @foreach($vendors as $vendor)
			                  	<option value="{{$vendor->id}}">{{$vendor->vendor_code}}</option>
			                  @endforeach
			                </select>
		                </div>

		            </div>
	              	<div class="col-md-5">
		                <div class="form-group">
		                  <label for="s_vendor_name">Vendor</label>
		                  <select name="vendor_name" class="form-control select2" id="s_vendor_name" style="width: 100%;" required>
			                  <option selected="selected" disabled>Select Vendor</option>
			                  @foreach($vendors as $vendor)
			                  	<option value="{{$vendor->id}}">{{$vendor->first_name}} {{$vendor->last_name}}</option>
			                  @endforeach
			              </select>
		                </div>
		            </div>

		            <div class="col-md-5">
		                <div class="form-group">
		                  <label for="s_date"> Date </label>
		                  <input type="date" name="date" class="form-control" id="s_date" placeholder="Date" required>
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="s_form_no">Form No *</label>
		                  <input type="text" name="form_no" class="form-control" id="s_form_no" placeholder="Form No" required>
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="s_commission">Commission *</label>
		                  <input type="number" name="commission" class="form-control" id="s_commission" placeholder="Commission" required>
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="s_item_no">Item Number *</label>
		                  <input type="text" name="item_no" class="form-control" id="s_item_no" placeholder="Item Number" required>
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="form-group">
		                  <label for="s_quantity">Quantity </label>
		                  <input type="number" name="quantity" class="form-control" id="s_quantity" placeholder="Quantity" required>
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="form-group">
		                  <label for="s_description">Description</label>
		                  <textarea type="text" name="description" class="form-control" id="s_description" placeholder="Description" required></textarea> 
		                </div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                  <label for="s_reserve">Reserve</label>
		                  <input type="number" name="reserve" class="form-control" id="s_reserve" placeholder="Reserve">
		                </div>
		            </div>
			        <div class="col-md-12">
			        	<div class="box-footer">
		              		<button type="submit" class="btn btn-primary">Submit</button>
		            	</div>
			        </div>    
            	</form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
{{--         <div class="col-xs-12">
          <div class="box box-primary">
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
        </div> --}}
      </div>
    </section>
    <!-- /.content -->


@endsection
@push('scripts')
	<script type="text/javascript">
		$('#s_vendor_code').on('change', function() {
			var oldval = $('#s_vendor_name').val();
			var newval = this.value;
			if(oldval!=newval)
		  		$('#s_vendor_name').val(this.value).trigger('change');
		});
		$('#s_vendor_name').on('change', function() {
			var oldval = $('#s_vendor_code').val();
			var newval = this.value;
			if(oldval!=newval)
		  		$('#s_vendor_code').val(this.value).trigger('change');
		});
	</script>
@endpush