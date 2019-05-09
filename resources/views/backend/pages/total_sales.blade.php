@extends('backend.layouts.app',['title'=>'Total Sales'])
@push('styles')
	<style type="text/css">
		tr>td, tr>th{
			text-align: center;
		}
		.remove_item:hover{
			cursor: pointer;
			color: red;
		}
	</style>
@endpush
@section('content')

    <section class="content">
      <div class="row">
       	<div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Sales Report</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
            	<div class="col-md-6">
            		<button type="button" class="btn bg-olive btn-flat margin btn-lg" id="toggle_auction">Auction</button>
            		<button type="button" class="btn bg-olive btn-flat margin btn-lg" id="toggle_vendor">Vendor</button>
            		<button type="button" class="btn bg-olive btn-flat margin btn-lg" id="toggle_buyer">Buyer</button>
            	</div>
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
              	<div class="col-md-3 vendor_section" style="display:none;">
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
	            <div class="col-md-3 auction_section" style="display:none;">
	                <div class="form-group">
	                  <label for="ts_auction_no">Auction</label>
	                  <select class="form-control select2" id="ts_auction_no" style="width: 100%;" required>
		                  <option selected="selected" disabled>Select Auction</option>
		                  @foreach($auctions as $auction)
		                  	<option value="{{$auction->id}}">{{$auction->auction_no}}</option>
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
              	<div class="col-md-3 buyer_section" style="display:none;">
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
            </div>
          </div>
        </div>
{{-- 
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">All Sales by Items</h3>
            </div>
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
						<td>$ {{floatval($all_sale->buyers_premium_amount)}}</td>
						@php 
							$grand_total = ($all_sale->quantity * $all_sale->rate)-$all_sale->discount+$all_sale->buyers_premium_amount; 
						@endphp
						<td>$ {{$grand_total}}</td>
					</tr>
					@endforeach
				</tbody>
			  </table>
            </div>
          </div>
        </div>
 --}}
        <div class="col-xs-12 reports_container" style="display: none;">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Individual Report Generation</h3>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover ajax_report_table">
              	<thead>
	                <tr>
					  <th>Invoice No</th>
					  <th>Vendor Code</th>
					  <th>Auction No</th>
					  <th>Buyer Code</th>
	                  <th>Form No</th>
	                  <th>Item No</th>
	                  <th>Description</th>
	                  <th>Quantity</th>
	                  <th>Rate</th>
	                  <th>Discount</th>
	                  <th>Stock Commission</th>
	                  <th>Buyers Premium Amount</th>
	                  <th>Grand Total</th>
	                  <th>Action</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			  </table>
            </div>
          </div>
        </div>
      </div>
    </section>


@endsection
@push('scripts')
	<script type="text/javascript">
		
		//Toggle Vendor or Buyer
		$('#toggle_vendor').on('click',function(){
			$('.vendor_section').show();
			$('.buyer_section, .auction_section').hide();
			$(this).removeClass('bg-olive').addClass('bg-purple');
			$('#toggle_buyer, #toggle_auction').removeClass('bg-purple').addClass('bg-olive');
		});
		$('#toggle_buyer').on('click',function(){
			$('.buyer_section').show();
			$('.vendor_section, .auction_section').hide();
			$(this).removeClass('bg-olive').addClass('bg-purple');
			$('#toggle_vendor, #toggle_auction').removeClass('bg-purple').addClass('bg-olive');
		});
		$('#toggle_auction').on('click',function(){
			$('.auction_section').show();
			$('.vendor_section, .buyer_section').hide();
			$(this).removeClass('bg-olive').addClass('bg-purple');
			$('#toggle_buyer, #toggle_vendor').removeClass('bg-purple').addClass('bg-olive');
		});
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

		  	$.ajax({
		       type:'post',
		       url:'{{ route("reports.ajax_invoice_report") }}',
		       dataType: 'json',
		       data:{
		       	 	type: 'vendor_report',
					vendor_id: newval              
		      	},
		       success:function(response) {
		       		showReport(response);
 				},
				error: function(response){
					console.log(response);
				}
		    });
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

		  	$.ajax({
		       type:'post',
		       url:'{{ route("reports.ajax_invoice_report") }}',
		       dataType: 'json',
		       data:{
		       	 	type: 'buyer_report',
					buyer_id: newval              
		      	},
		       success:function(response) {
		       		showReport(response);
 				},
				error: function(response){
					console.log(response);
				}
		    });

		});

		$('#ts_auction_no').on('change', function() {
			var newval = this.value;

		  	$.ajax({
		       type:'post',
		       url:'{{ route("reports.ajax_invoice_report") }}',
		       dataType: 'json',
		       data:{
		       	 	type: 'auction_report',
					auction_id: newval              
		      	},
		       success:function(response) {
		       		showReport(response);
               		console.log(response);
 				},
				error: function(response){
					console.log(response);
				}
		    });
		});

		$('body').on('click','.remove_item',function(e){
			e.preventDefault();
			swal({
			  title: "Are you sure?",
			  text: "Once deleted, this item will be removed from the invoice",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
		  		const current_row = $(this).closest('tr');
		  		const sale_id = $(this).parents('tr').data('sale-id');
				$.ajax({
			       type:'post',
			       url:'{{ url("/remove_sale") }}',
			       dataType: 'json',
			       data:{
						sale_id: sale_id,    
			      	},
			       success:function(data) {
				       	swal("Deleted!", {
					      icon: "success",
					    });
			       		console.log(data);
			       		$('#a_auction_id').trigger('change');
			       		current_row.remove();
			       		$('.added_items_table').sumtr({sumCells : '.price'});
	 				},
					error: function(response){
						$.each(response.responseJSON, function(index, val){
							console.log(index+":"+val);	
						});
					}
			    });
			  } 
			});
		});

		function showReport(data){
			$('.ajax_report_table tbody').html('');
			var content = '';
			if(data && data.length){
				data.forEach(function(report){
	       			content += '<tr data-sale-id="'+report.id+'">';
	       			content += '<td>'+report.invoice_id+'</td>';
	       			content += '<td>'+report.vendor_code+'</td>';
					content += '<td>'+report.auction_no+'</td>';
					content += '<td>'+report.buyer_code+'</td>';
					content += '<td>'+report.form_no+'</td>';
					content += '<td>'+report.item_no+'</td>';
					content += '<td>'+report.description+'</td>';
					content += '<td>'+report.quantity+'</td>';
					content += '<td>$ '+report.rate+'</td>';
					content += '<td>$ '+report.discount+'</td>';
					content += '<td>'+report.commission+' %</td>';
					content += '<td>$ '+parseFloat(report.buyers_premium_amount)+'</td>';

					var grand_total = (Number(report.quantity) * Number(report.rate))-Number(report.discount)+Number(report.buyers_premium_amount); 
				
					content += '<td>$ '+grand_total+'</td>';
					content += '<td><div class="remove_item"><i class="fa fa-window-close text-red" aria-hidden="true"></i></div></td>';
					content += '</tr>';
	       		});
			}
			else{
				content += '<tr><td>No sales record found</td></tr>';
			}

       		$('.ajax_report_table tbody').append(content);
       		$('.reports_container').show();
		}
		
	</script>
@endpush