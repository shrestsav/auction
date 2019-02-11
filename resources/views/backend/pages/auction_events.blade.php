@extends('backend.layouts.app',['title'=>'Auction'])
@push('styles')
	<style type="text/css">
		.add_items:hover{
			cursor: pointer;
			color: green;
		}
		.add_lot{
			margin:23px 10px 0px 10px;
		}
		.sysauction.row{
			margin-left: 0px;
		}
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
              <h3 class="box-title">Auction</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<form role="form" method="POST" action="">
            		@csrf
            		<div class="col-md-2">
		                <div class="form-group">
		                  	<label for="a_auction_id">Auction</label>
		                	<select name="auction_id" class="form-control select2" id="a_auction_id" style="width: 100%;" required>
		                		<option selected="selected" disabled>Select Auction</option>
				                 @foreach ($auctions as $auction)
				                  	<option value="{{$auction->id}}" data-auction-venue="{{$auction->venue}}" data-auction-date="{{$auction->date}}" data-auction-time="{{$auction->time}}">{{$auction->auction_no}}</option>
				                 @endforeach
			                </select>
		                </div>
		            </div>
	              	<div class="col-md-4">
		                <div class="form-group">
		                  <label for="a_venue">Venue</label>
		                  <input type="text" name="first_name" class="form-control" id="a_venue" placeholder="Venue" disabled>
		                </div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                  <label for="a_date">Date</label>
		                  <input type="text" name="last_name" class="form-control" id="a_date" placeholder="Date" disabled>
		                </div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                  <label for="a_time">Time</label>
		                  <input type="text" name="address" class="form-control" id="a_time" placeholder="Address" disabled>
		                </div>
		            </div>
		           	<div class="sysauction row">
			            <div class="col-md-2">
			                <div class="form-group">
			                  <label for="a_buyer_code">Buyer Code</label>
			                  <select name="buyer_code" class="form-control select2" id="a_buyer_code" style="width: 100%;" required>
				                  <option selected="selected" disabled>Buyer Code</option>
				                  @foreach($buyers as $buyer)
				                  	<option value="{{$buyer->id}}">{{$buyer->buyer_code}}</option>
				                  @endforeach
				                </select>
			                </div>
			            </div>
		              	<div class="col-md-4">
			                <div class="form-group">
			                  <label for="s_buyer_name">Buyer</label>
			                  <select name="vendor_name" class="form-control select2" id="s_buyer_name" style="width: 100%;" required>
				                  <option selected="selected" disabled>Select Buyer</option>
				                  @foreach($buyers as $buyer)
				                  	<option value="{{$buyer->id}}">{{$buyer->first_name}} {{$buyer->last_name}}</option>
				                  @endforeach
				              </select>
			                </div>
			            </div>
			        </div>
		            <div class="col-md-12 items_div" style="display: none;">
		                <div class="form-group">
		                  	<label for="a_items">Available Items</label>
		                  	<div class="box-body table-responsive no-padding">
				              <table class="table table-hover items_table">
					                <tr class="items_head">
					                  <th>S.No</th>
					                  <th>Lot No</th>
					                  <th>Vendor Code</th>
					                  <th>Form No</th>
					                  <th>Item No</th>
					                  <th>Description</th>
					                  <th>Quantity</th>
					                  <th>Sold</th>
					                  <th>Action</th>
					                </tr>
				            	{{-- Table Row Filled with Ajax  --}}
				              </table>
				            </div>
		                </div>
		            </div>
		            		            {{-- For Sending Vendor Id not Vendor Code to database --}}
		            <input type="hidden" name="vendor_id" value="test" id="a_vendor_id" >
		            {{-- <div class="col-md-2">
		                <div class="form-group">
		                  <label for="a_vendor_code">Vendor Code</label>
		                  <input type="text" name="vendor_code" class="form-control" id="a_vendor_code" placeholder="Vendor Code" required disabled>
		                </div>
		            </div> --}}
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="a_form_no">Form No</label>
		                  <input type="text" name="form_no" class="form-control" id="a_form_no" placeholder="Form No" required readonly>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="a_item_no">Item No</label>
		                  <input type="text" name="item_no" class="form-control" id="a_item_no" placeholder="Item No" required readonly>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="a_lot_no">Lot No</label>
		                  <input type="number" name="lot_no" class="form-control" id="a_lot_no" placeholder="Lot No" required readonly>
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="a_description">Description</label>
		                  <input type="text" class="form-control" id="a_description" placeholder="Description" required readonly>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="a_quantity">Quantity</label>
		                  <input type="number" name="quantity" class="form-control" id="a_quantity" placeholder="Quantity" required readonly>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="a_rate">Rate</label>
		                  <input type="number" name="rate" class="form-control" id="a_rate" placeholder="Rate" required readonly>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="a_total">Total</label>
		                  <input type="number" class="form-control" id="a_total" placeholder="Total" required readonly>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="a_discount">Discount</label>
		                  <input type="number" name="discount" class="form-control" id="a_discount" placeholder="Discount" required readonly>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="a_net_total">Net Total</label>
		                  <input type="number" class="form-control" id="a_net_total" placeholder="Net Total" required readonly>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="a_buyers_premium">Buyers Premium %</label>
		                  <input type="number" name="buyers_premium" class="form-control" id="a_buyers_premium" placeholder="Buyers Premium" required readonly>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="a_buyers_premium_amount">Buyers Premium Amount</label>
		                  <input type="number" name="buyers_premium_amount" class="form-control" id="a_buyers_premium_amount" placeholder="Buyers Premium Amount" required readonly>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="a_grand_total">Grand Total</label>
		                  <input type="number" class="form-control" id="a_grand_total" placeholder="Grand Total" required readonly>
		                </div>
		            </div>
		            
			        <div class="col-md-12">
			        	<div class="box-footer">
		              		<button type="submit" class="btn btn-primary">Save</button>
		            	</div>
			        </div>    
            	</form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>

    
      </div>
    </section>

    <!-- /.content -->


@endsection
@push('scripts')
	<script type="text/javascript">
		//CSRF TOKEN HAS BEEN SENT IN HEADER FILE IN APP BLADE
		$('body').on('change','#a_auction_id',function(){
			var auction_id = $(this).val();
			var auction_venue = $(this).find('option:selected').data('auction-venue');
			var auction_date = $(this).find('option:selected').data('auction-date');
			var auction_time = $(this).find('option:selected').data('auction-time');
			$('#a_venue').val(auction_venue);
			$('#a_date').val(auction_date);
			$('#a_time').val(auction_time);
			$.ajax({
		       type:'post',
		       url:'/get_auction_stocks',
		       dataType: 'json',
		       data:{
					auction_id:auction_id                 
		      	},
		       success:function(data) {
		       		$(".items_div").show();
		            $(".items_body").remove();
		       	var row_id=1;
		       		data.forEach(rows =>{
		       			console.log(rows);
		       			$('.items_table').append('<tr class="items_body" data-vendor-id="'+rows["vendor_id"]+'"><td data-row-id="'+row_id+'">'+row_id+'</td><td class="lot_no">'+rows["lot_no"]+'</td><td class="vendor_code">'+rows["vendor_code"]+'</td><td class="form_no">'+rows["form_no"]+'</td><td class="item_no">'+rows["item_no"]+'</td><td class="description">'+rows["description"]+'</td><td class="quantity">'+rows["quantity"]+'</td><td class="sold">sold</td><td><div class="add_items"><i class="fa fa-plus-circle" aria-hidden="true"></i></div></td></tr>');
		       			row_id++;
		       		});
		       }
		    });
		});
		$('body').on('click','.add_items',function(){
			const vendor_id = $(this).parents('.stocks_body').data('vendor-id');
	    	const row_id = $(this).parents('.stocks_body td').data('row-id');
	    	const form_no = $(this).closest('tr').children('td.form_no').text();
	    	const item_no = $(this).closest('tr').children('td.item_no').text();
	    	const quantity = $(this).closest('tr').children('td.quantity').text();
	    	const description = $(this).closest('tr').children('td.description').text();
	    	const lot_no = $(this).closest('tr').children('td.lot_no').text();
	    	$('#a_vendor_id').val(vendor_id);
	    	$('#a_form_no').val(form_no);
	    	$('#a_item_no').val(item_no);
	    	$('#a_quantity').val(quantity);
	    	$('#a_description').val(description);
	    	$('#a_lot_no').val(lot_no);
	    	$("#a_quantity").prop("readonly", false); 
	    	$("#a_rate").prop("readonly", false); 
		});

		$('#a_buyer_code').on('change', function() {
			var oldval = $('#s_buyer_name').val();
			var newval = this.value;
			if(oldval!=newval)
		  		$('#s_buyer_name').val(this.value).trigger('change');
		});
		$('#s_buyer_name').on('change', function() {
			var oldval = $('#a_buyer_code').val();
			var newval = this.value;
			if(oldval!=newval)
		  		$('#a_buyer_code').val(this.value).trigger('change');
		});

		// Calculations
		$('#a_rate').on('change',function(){
			const quantity = $('#a_quantity').val();
			const rate =  $('#a_rate').val();
			$('#a_total').val(quantity*rate);
			$("#a_discount").prop("readonly", false); 
		});
		$('#a_discount').on('change',function(){
			const total = $('#a_total').val();
			const discount =  $('#a_discount').val();
			$('#a_net_total').val(total-discount);
			$("#a_buyers_premium").prop("readonly", false); 
		});
		$('#a_buyers_premium').on('change',function(){
			const net_total = $('#a_net_total').val();
			const buyers_premium =  $('#a_buyers_premium').val();
			const buyers_premium_amount = (buyers_premium/100)*net_total;
			$('#a_buyers_premium_amount').val(buyers_premium_amount).trigger('change');
		});
		$('#a_buyers_premium_amount').on('change paste keyup',function(){
			var net_total = $('#a_net_total').val();
			var buyers_premium_amount =  $('#a_buyers_premium_amount').val();
			var grand_total = parseFloat(net_total) + parseFloat(buyers_premium_amount);
			$('#a_grand_total').val(grand_total);
		});
	</script>
@endpush