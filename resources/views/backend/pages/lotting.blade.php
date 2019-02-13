@extends('backend.layouts.app',['title'=>'Lotting'])
@push('styles')
	<style type="text/css">
		.add_stock:hover{
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
	      	<div class="alert alert-danger" style="display: none;"></div>
	      	<div class="alert alert-success" style="display: none;"></div>
	    </div>
      	<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Add Lotting</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<form >
            		@csrf
            		<div class="col-md-2">
		                <div class="form-group">
		                  	<label for="l_auction_id">Auction</label>
		                	<select class="form-control select2" id="l_auction_id" style="width: 100%;" required>
		                		<option hidden disabled selected value>Select Auction</option>
				                 @foreach ($auctions as $auction)
				                  	<option value="{{$auction->id}}" data-auction-venue="{{$auction->venue}}" data-auction-date="{{$auction->date}}" data-auction-time="{{$auction->time}}">{{$auction->auction_no}}</option>
				                 @endforeach
			                </select>
		                </div>
		            </div>
	              	<div class="col-md-4">
		                <div class="form-group">
		                  <label for="l_venue">Venue</label>
		                  <input type="text" class="form-control" id="l_venue" placeholder="Venue" disabled>
		                </div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                  <label for="l_date">Date</label>
		                  <input type="text" class="form-control" id="l_date" placeholder="Date" disabled>
		                </div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                  <label for="l_time">Time</label>
		                  <input type="text" class="form-control" id="l_time" placeholder="Address" disabled>
		                </div>
		            </div>
		            <div class="sysauction row">
			            <div class="col-md-2">
			                <div class="form-group">
			                  <label for="s_vendor_code">Vendor Code</label>
			                  <select class="form-control select2" id="s_vendor_code" style="width: 100%;" required>
				                  <option selected="selected" disabled>Vendor Code</option>
				                  @foreach($vendors_with_stocks as $vendor)
				                  	<option value="{{$vendor->id}}">{{$vendor->vendor_code}}</option>
				                  @endforeach
				                </select>
			                </div>

			            </div>
		              	<div class="col-md-4">
			                <div class="form-group">
			                  <label for="s_vendor_name">Vendor</label>
			                  <select class="form-control select2" id="s_vendor_name" style="width: 100%;" required>
				                  <option hidden disabled selected value>Select Vendor</option>
				                  @foreach($vendors_with_stocks as $vendor)
				                  	<option value="{{$vendor->id}}">{{$vendor->first_name}} {{$vendor->last_name}}</option>
				                  @endforeach
				              </select>
			                </div>
			            </div>
			        </div>
		            <div class="col-md-12 l_stocks" style="display: none;">
		                <div class="form-group">
		                  	<label for="l_stocks">STOCKS</label>
		                  	<div class="box-body table-responsive no-padding">
				              <table class="table table-hover stocks_table">
					                <tr class="stocks_head">
					                  <th>S.No</th>
					                  <th>Form No</th>
					                  <th>Item No</th>
					                  <th>Quantity</th>
					                  <th>Description</th>
					                  <th>Commission</th>
					                  <th>Reserve</th>
					                  <th>Action</th>
					                </tr>
				            	{{-- Table Row Filled with Ajax  --}}
				              </table>
				            </div>
		                </div>
		            </div>
		            <hr>
		            {{-- For Storing Temporary Vendor Id not Vendor Code to database --}}
		            <input type="hidden" id="l_vendor_id" >
		            <input type="hidden" id="l_vendor_name" >
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="l_vendor_code">Vendor Code</label>
		                  <input type="text" class="form-control" id="l_vendor_code" placeholder="Vendor Code" required disabled>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="l_form_no">Form No</label>
		                  <input type="text" class="form-control" id="l_form_no" placeholder="Form No" required readonly>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="l_item_no">Item No</label>
		                  <input type="text" class="form-control" id="l_item_no" placeholder="Item No" required readonly>
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="l_description">Description</label>
		                  <input type="text" class="form-control" id="l_description" placeholder="Description" required readonly>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="l_quantity">Quantity</label>
		                  <input type="number" class="form-control" id="l_quantity" placeholder="Quantity" required disabled>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="l_reserve">Reserve</label>
		                  <input type="number" class="form-control" id="l_reserve" placeholder="Reserve" required disabled>
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="l_lot_no">Lot No</label>
		                  <input type="number" class="form-control" id="l_lot_no" placeholder="Lot No" required disabled>
		                </div>
		            </div>
		            <div class="col-md-2">
			            <div class="btn-group-vertical">
			            	<button type="button" class="btn bg-olive btn-flat margin add_lot" disabled>Add</button>
			            </div>
			        </div>
		            <div class="col-md-12 lot_div" style="display: none;">
		                <div class="form-group">
		                  	<label for="l_lot">LOT</label>
		                  	<div class="box-body table-responsive no-padding">
				              <table class="table table-hover lot_table">
					                <tr class="lot_head">
					                  <th>V.Code</th>
					                  <th>Vendor Name</th>
					                  <th>Lot No</th>
					                  <th>Form No</th>
					                  <th>Item No</th>
					                  <th>Description</th>
					                  <th>Quantity</th>
					                  <th>Reserve</th>
					                </tr>
				            	{{-- Table Row Filled with Ajax  --}}
				              </table>
				            </div>
		                </div>
		            </div>
			        {{-- <div class="col-md-12">
			        	<div class="box-footer">
		              		<button type="submit" class="btn btn-primary">Save</button>
		            	</div>
			        </div>    --}} 
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
		$('#l_auction_id').on('change', function() {
			var auction_id = $(this).val();
			var auction_venue = $(this).find('option:selected').data('auction-venue');
			var auction_date = $(this).find('option:selected').data('auction-date');
			var auction_time = $(this).find('option:selected').data('auction-time');
			$('#l_venue').val(auction_venue);
			$('#l_date').val(auction_date);
			$('#l_time').val(auction_time);
			$.ajax({
		       type:'post',
		       url:'/get_auction_stocks',
		       dataType: 'json',
		       data:{
					auction_id:auction_id                 
		      	},
		       success:function(data) {
		       		$(".lot_div").show();
		            $(".lotting_body").remove();
		       	var row_id=1;
		       		data.forEach(rows =>{
		       			console.log(rows);
		       			$('.lot_table').append('<tr class="lotting_body" data-vendor-id="'+rows["vendor_id"]+'"><td class="vendor_code" data-row-id="'+row_id+'">'+rows["vendor_code"]+'</td><td class="vendor_name">'+rows["first_name"]+' '+rows["last_name"]+'</td><td class="lot_no">'+rows["lot_no"]+'</td><td class="form_no">'+rows["form_no"]+'</td><td class="item_no">'+rows["item_no"]+'</td><td class="description">'+rows["description"]+'</td><td class="quantity">'+rows["quantity"]+'</td><td class="reserve">'+rows["reserve"]+'</td></tr>');
		       			row_id++;
		       		});
		       }
		    });
		});

		$('body').on('change','#s_vendor_code',function(){
			var oldval = $('#s_vendor_name').val();
			var newval = this.value;
			if(oldval!=newval)
		  		$('#s_vendor_name').val(this.value).trigger('change');
			$.ajax({
               type:'post',
               url:'/get_vendor_stocks',
               dataType: 'json',
               data:{
					id:newval                 
              	},
               success:function(data) {
               		console.log(data);

               		$(".l_stocks").show();
               		$(".stocks_body").remove();
               		var length = data.length;
               		for(i=0; i<length;i++){
               			var row_id = i+1;
               			$('.stocks_table').append('<tr class="stocks_body" data-vendor-id="'+data[i]["vendor_id"]+'"><td data-row-id="'+row_id+'">'+row_id+'</td><td class="form_no">'+data[i]["form_no"]+'</td><td class="item_no">'+data[i]["item_no"]+'</td><td class="quantity">'+data[i]["quantity"]+'</td><td class="description">'+data[i]["description"]+'</td><td class="commission">'+data[i]["commission"]+'</td><td class="reserve">'+data[i]["reserve"]+'</td><td><div class="add_stock"><i class="fa fa-plus-circle" aria-hidden="true"></i></div></td></tr>');
               		}
               }
            });
		});

		$('#s_vendor_name').on('change', function() {
			var oldval = $('#s_vendor_code').val();
			var newval = this.value;
			if(oldval!=newval)
		  		$('#s_vendor_code').val(this.value).trigger('change');
		});

		$('.add_lot').on('click',function(){
			var auction_id = $('#l_auction_id').val();
			var vendor_id = $('#l_vendor_id').val();
	    	var vendor_code = $('#l_vendor_code').val();
	    	var vendor_name = $('#l_vendor_name').val();
	    	var lot_no = $('#l_lot_no').val();
	    	var form_no = $('#l_form_no').val();
	    	var item_no = $('#l_item_no').val();
	    	var description = $('#l_description').val();
	    	var quantity = $('#l_quantity').val();
	    	var reserve = $('#l_reserve').val();
	    	$.ajax({
               type:'post',
               url:'/save_new_lot',
               dataType: 'json',
               data:{
					auction_id: auction_id,
					vendor_id: vendor_id,
					lot_no: lot_no,
					form_no: form_no,
					item_no: item_no,
					description: description,
					quantity: quantity,
					reserve: reserve                
              	},
               success:function(response) {
               		console.log(response);
               		$('.alert-danger').hide();
               		$('.alert-success').show().html('LOT ADDED SUCCESSFULLY');
               		$('.lot_table').append('<tr class="lotting_body"><td class="vendor_code">'+vendor_code+'</td><td class="vendor_name">'+vendor_name+'</td><td class="lot_no">'+lot_no+'</td><td class="form_no">'+form_no+'</td><td class="item_no">'+item_no+'</td><td class="description">'+description+'</td><td class="quantity">'+quantity+'</td><td class="reserve">'+reserve+'</td></tr>');
				},
				error: function(response){
					$.each(response.responseJSON, function(index, val){
						console.log(index+":"+val);
						$('.alert-success').hide();
						$('.alert-danger').show().html(val);
						
					});
					// console.log(response);
				}
            });	
			
		});
		$('#l_quantity').on('change',function(e){
			e.preventDefault();
			$('#l_lot_no').prop("disabled", false);

		});
		$('#l_lot_no').on('change keyup',function(e){
			e.preventDefault();
			$('.add_lot').prop("disabled", false);

		});
	  	$('body').on('click','.add_stock',function(){
	    	const vendor_id = $(this).parents('.stocks_body').data('vendor-id');
	    	const vendor_code = $('#s_vendor_code option[value="'+vendor_id+'"]').text();
	    	const vendor_name = $('#s_vendor_name option[value="'+vendor_id+'"]').text();
	    	const row_id = $(this).parents('.stocks_body td').data('row-id');
	    	const form_no = $(this).closest('tr').children('td.form_no').text();
	    	const item_no = $(this).closest('tr').children('td.item_no').text();
	    	const quantity = $(this).closest('tr').children('td.quantity').text();
	    	const description = $(this).closest('tr').children('td.description').text();
	    	const reserve = $(this).closest('tr').children('td.reserve').text();
	    	$('#l_vendor_id').val(vendor_id);
	    	$('#l_vendor_code').val(vendor_code);
	    	$('#l_vendor_name').val(vendor_name);
	    	$('#l_form_no').val(form_no);
	    	$('#l_item_no').val(item_no);
	    	$('#l_quantity').val(quantity);
	    	$('#l_description').val(description);
	    	$('#l_reserve').val(reserve);

	    	$('#l_quantity').prop("disabled", false).trigger('change');
	    	$('#l_reserve').prop("disabled", false);

		});
	</script>
@endpush