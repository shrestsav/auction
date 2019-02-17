@extends('backend.layouts.app',['title'=>'Total Sales'])
@push('styles')
	<style type="text/css">
		tr>td, tr>th{
			text-align: center;
		}
	</style>
@endpush
@section('content')

   <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
      	      	<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Sales Report</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<div class="col-md-4">
            		<button type="button" class="btn btn-success" id="toggle_vendor">Vendor</button>
            		<button type="button" class="btn btn-success" id="toggle_buyer">Buyer</button>
            	</div>
            	<br><br><br>
            	<form role="form" method="POST" action="{{route('stocks.store')}}">
            	@csrf
            		<div class="col-md-2 vendor_section" style="display:none;">
		                <div class="form-group">
		                  <label for="ts_vendor_code">Vendor Code</label>
		                  <select name="vendor_id" class="form-control select2" id="ts_vendor_code" style="width: 100%;" required>
			                  <option selected="selected" disabled>Vendor Code</option>
			                  @foreach($vendors as $vendor)
			                  	<option value="{{$vendor->id}}">{{$vendor->vendor_code}}</option>
			                  @endforeach
			                </select>
		                </div>
		            </div>
	              	<div class="col-md-5 vendor_section" style="display:none;">
		                <div class="form-group">
		                  <label for="ts_vendor_name">Vendor</label>
		                  <select class="form-control select2" id="ts_vendor_name" style="width: 100%;" required>
			                  <option selected="selected" disabled>Select Vendor</option>
			                  @foreach($vendors as $vendor)
			                  	<option value="{{$vendor->id}}">{{$vendor->first_name}} {{$vendor->last_name}}</option>
			                  @endforeach
			              </select>
		                </div>
		            </div>
		            <div class="col-md-2 buyer_section" style="display:none;">
		                <div class="form-group">
		                  <label for="ts_buyer_code">Buyer Code</label>
		                  <select name="buyer_id" class="form-control select2" id="ts_buyer_code" style="width: 100%;" required>
			                  <option selected="selected" disabled>Buyer Code</option>
			                  @foreach($buyers as $buyer)
			                  	<option value="{{$buyer->id}}">{{$buyer->buyer_code}}</option>
			                  @endforeach
			                </select>
		                </div>
		            </div>
	              	<div class="col-md-5 buyer_section" style="display:none;">
		                <div class="form-group">
		                  <label for="ts_buyer_name">Buyer</label>
		                  <select class="form-control select2" id="ts_buyer_name" style="width: 100%;" required>
			                  <option selected="selected" disabled>Select Buyer</option>
			                  @foreach($buyers as $buyer)
			                  	<option value="{{$buyer->id}}">{{$buyer->first_name}} {{$buyer->last_name}}</option>
			                  @endforeach
			              </select>
		                </div>
		            </div>
            	</form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">All Sales by Items</h3>

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
              	<thead>
	                <tr>
					  <th>Invoice No</th>
					  <th>Auction No</th>
					  <th>Buyer Code</th>
					  <th>Vendor Code</th>
	                  <th>Form No</th>
	                  <th>Item No</th>
	                  <th>Description</th>
	                  <th>Quantity</th>
	                  <th>Rate</th>
	                  <th>Discount</th>
	                  <th>Buyers Premium Amount</th>
	                  <th>Grand Total</th>
					</tr>
				</thead>
				<tbody>
					@foreach($all_sales as $all_sale)
					<tr>
						<td>{{$all_sale->invoice_id}}</td>
						<td>{{$all_sale->auction_no}}</td>
						<td>{{$all_sale->buyer_code}}</td>
						<td>{{$all_sale->vendor_code}}</td>
						<td>{{$all_sale->form_no}}</td>
						<td>{{$all_sale->item_no}}</td>
						<td>{{$all_sale->description}}</td>
						<td>{{$all_sale->quantity}}</td>
						<td>$ {{$all_sale->rate}}</td>
						<td>$ {{$all_sale->discount}}</td>
						<td>$ <?php echo floatval($all_sale->buyers_premium_amount); ?></td>
						<?php $grand_total = ($all_sale->quantity * $all_sale->rate)-$all_sale->discount+$all_sale->buyers_premium_amount ?>
						<td>$ {{$grand_total}}</td>
					</tr>
					@endforeach
				</tbody>
			  </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->


@endsection
@push('scripts')
	<script type="text/javascript">
		//Toggle Vendor or Buyer
		$('#toggle_vendor').on('click',function(){
			$('.vendor_section').show();
			$('.buyer_section').hide();
		});
		$('#toggle_buyer').on('click',function(){
			$('.buyer_section').show();
			$('.vendor_section').hide();
		})

		//Drop down vendor
		$('#ts_vendor_code').on('change', function() {
			var oldval = $('#ts_vendor_name').val();
			var newval = this.value;
			if(oldval!=newval)
		  		$('#ts_vendor_name').val(this.value).trigger('change');
		});
		$('#ts_vendor_name').on('change', function() {
			var oldval = $('#ts_vendor_code').val();
			var newval = this.value;
			if(oldval!=newval)
		  		$('#ts_vendor_code').val(this.value).trigger('change');
		});
		//Drop down Buyer
		$('#ts_buyer_code').on('change', function() {
			var oldval = $('#ts_buyer_name').val();
			var newval = this.value;
			if(oldval!=newval)
		  		$('#ts_buyer_name').val(this.value).trigger('change');
		});
		$('#ts_buyer_name').on('change', function() {
			var oldval = $('#ts_buyer_code').val();
			var newval = this.value;
			if(oldval!=newval)
		  		$('#ts_buyer_code').val(this.value).trigger('change');
		});


	</script>
@endpush