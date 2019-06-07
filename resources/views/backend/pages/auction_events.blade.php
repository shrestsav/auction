@extends('backend.layouts.app',['title'=>'Auction'])

@push('styles')
	<style type="text/css">
	.add_items:hover, .generate_invoice:hover{
		cursor: pointer;
		color: green;
	}
	.remove_item:hover{
		cursor: pointer;
		color: red;
	}
	.add_lot{
		margin:23px 10px 0px 10px;
	}
	.sysauction.row{
		margin-left: 0px;
	}

	.invoice_table tr>td{
		text-align: unset;
	}
	</style>
@endpush

@section('content')

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-danger" style="display: none;"></div>
			<div class="alert alert-success" style="display: none;"></div>
		</div>
		<div class="col-md-12">
			<div class="box box-purple box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Auction</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="box-body">
					<form>
						@csrf
						<div class="col-md-2">
							<div class="form-group">
								<label for="a_auction_id">Auction</label>
								<select class="form-control select2" id="a_auction_id" style="width: 100%;" required>
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
								<input type="text" class="form-control" id="a_venue" placeholder="Venue" disabled>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="a_date">Date</label>
								<input type="text" class="form-control" id="a_date" placeholder="Date" disabled>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="a_time">Time</label>
								<input type="text" class="form-control" id="a_time" placeholder="Address" disabled>
							</div>
						</div>
						<div class="sysauction row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="a_invoice_no">Invoice No</label>
									<input type="number" class="form-control" id="a_invoice_no" placeholder="Invoice No" required readonly>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="a_buyer_code">Buyer Code</label>
									<select class="form-control select2" id="a_buyer_code" style="width: 100%;" required>
										<option selected="selected" disabled>Buyer Code</option>
										@foreach($buyers as $buyer)
										<option value="{{$buyer->id}}">{{$buyer->buyer_code}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="a_buyer_name">Buyer</label>
									<select class="form-control select2" id="a_buyer_name" style="width: 100%;" required>
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
											<th>Available</th>
											<th>Action</th>
										</tr>
										{{-- Table Row Filled with Ajax  --}}
									</table>
								</div>
							</div>
						</div>
						{{-- For Sending Vendor Id not Vendor Code to database --}}
						<input type="hidden" id="a_vendor_id" class="confirm_input">
						<input type="hidden" id="a_lotting_id" class="confirm_input">
						<input type="hidden" id="a_vendor_code" class="confirm_input">
						<div class="col-md-2">
							<div class="form-group">
								<label for="a_form_no">Form No</label>
								<input type="text" class="form-control confirm_input" id="a_form_no" placeholder="Form No" required readonly>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="a_item_no">Item No</label>
								<input type="text" class="form-control confirm_input" id="a_item_no" placeholder="Item No" required readonly>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="a_lot_no">Lot No</label>
								<input type="number" class="form-control confirm_input" id="a_lot_no" placeholder="Lot No" required readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="a_description">Description</label>
								<input type="text" class="form-control confirm_input" id="a_description" placeholder="Description" required readonly>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="a_quantity">Quantity</label>
								<input type="number" class="form-control confirm_input" id="a_quantity" placeholder="Quantity" required readonly>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="a_rate">Price</label>
								<input type="number" class="form-control confirm_input" id="a_rate" placeholder="Price" required readonly>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="a_total">Total</label>
								<input type="number" class="form-control confirm_input" id="a_total" placeholder="Total" required readonly>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="a_discount">Discount</label>
								<input type="number" class="form-control confirm_input" id="a_discount" placeholder="Discount" required readonly>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="a_net_total">Net Total</label>
								<input type="number" class="form-control confirm_input" id="a_net_total" placeholder="Net Total" required readonly>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="a_buyers_premium">Buyers Premium %</label>
								<input type="number" class="form-control confirm_input" id="a_buyers_premium" placeholder="Buyers Premium" required readonly>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="a_buyers_premium_amount">BP Amount</label>
								<input type="number" class="form-control confirm_input" id="a_buyers_premium_amount" placeholder="Buyers Premium Amount" required readonly>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="a_grand_total">Grand Total</label>
								<input type="number" class="form-control confirm_input" id="a_grand_total" placeholder="Grand Total" required readonly>
							</div>
						</div>
						<div class="col-md-12">
							<div class="box-footer">
								<button type="button" class="btn btn-purple sale_button" disabled>Add Item</button>
							</div>
						</div> 
						<div class="col-md-12 added_items_div" style="display: none; margin-top: 70px;">
							<div class="form-group">
								<label for="a_items">Added Items</label>
								<div class="box-body table-responsive no-padding">
									<table class="table table-hover added_items_table">
										<thead>
											<tr class="items_head">
												<th>S.No</th>
												<th>Invoice</th>
												<th>Vendor Code</th>
												<th>Item No</th>
												<th>Form No</th>
												<th>Description</th>
												<th>Rate</th>
												<th>Quantity</th>
												<th>Total</th>
												<th>Discount</th>
												<th>Net Total</th>
												<th>BP Amount</th>
												<th>Grand Total</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											{{-- Table Row Filled with Ajax  --}}
										</tbody>
										<tfoot>
											{{-- Table Row Filled with Ajax  --}}
											<tr class="added_items_foot summary">
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>TOTAL</td>
												<td class="total_total"></td>
												<td class="total_discount"></td>
												<td class="total_net_total"></td>
												<td class="total_buyers_premium_amount"></td>
												<td class="total_grand_total"></td>
												<td><a class="generate_invoice">PROCEED</a></td>
											</tr>
										</tfoot>

									</table>
								</div>
							</div>
						</div>

					</form>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
		<div class="col-md-12" style="text-align: center;">
			<a class="btn btn-app" onclick="location.reload();">
				<i class="fa fa-repeat" style="font-size: 30px;"></i> 
			</a>
		</div>


	</div>
</section>
<!-- /.content -->


@endsection

@push('scripts')

<script src="{{ asset('backend/js/jquery.sumtr.js') }}"></script>
<script type="text/javascript">

		//CSRF TOKEN HAS BEEN SENT IN HEADER FILE IN APP BLADE

		$('body').on('click','.generate_invoice',function(e){
			e.preventDefault();
			var g_invoice_no = $('#a_invoice_no').val();
			window.open("{{route('reports.print_invoice')}}?invoice_id="+g_invoice_no,"_blank","toolbar,scrollbars,resizable,top=60,left=100,width=950,height=600");
		});


		$('body').on('change','#a_auction_id',function(e){
			e.preventDefault();
			var auction_id = $(this).val();
			var auction_venue = $(this).find('option:selected').data('auction-venue');
			var auction_date = $(this).find('option:selected').data('auction-date');
			var auction_time = $(this).find('option:selected').data('auction-time');
			$('#a_venue').val(auction_venue);
			$('#a_date').val(auction_date);
			$('#a_time').val(auction_time);
			$.ajax({
				type:'post',
				url:'{{ url("/get_auction_stocks") }}',
				dataType: 'json',
				data:{
					auction_id:auction_id                 
				},
				success:function(data) {
					console.log(data);
					$(".items_div").show();
					$(".items_body").remove();
					var row_id=1;
					var content = '';
					data.forEach(rows =>{

						var total_sale = 0;
						if (Array.isArray(rows['sale']) || rows['sale'].length) {
							rows['sale'].forEach(sale =>{
								total_sale += sale['quantity'];
							});
						}
						var available_quantity = rows["quantity"] - total_sale;
						content += '<tr class="items_body" data-vendor-id="'+rows["vendor_id"]+'">';
						content += '<input type="hidden" class="lotting_id" value="'+rows["id"]+'"></input>';
						content += '<td data-row-id="'+row_id+'">'+row_id+'</td>';
						content += '<td class="lot_no">'+rows["lot_no"]+'</td>';
						content += '<td class="vendor_code">'+rows["vendor_code"]+'</td>';
						content += '<td class="form_no">'+rows["form_no"]+'</td>';
						content += '<td class="item_no">'+rows["item_no"]+'</td>';
						content += '<td class="description">'+rows["description"]+'</td>';
						content += '<td class="quantity">'+rows["quantity"]+'</td>';
						content += '<td class="sold">' + total_sale +'</td>';
						content += '<td class="available_quantity">'+available_quantity+'</td>';
						content += '<td><div class="add_items"><i class="fa fa-plus-circle" aria-hidden="true"></i></div></td>';
						content += '</tr>';
						row_id++;
					});
					$('.items_table').append(content);
				},
				error: function(response){
					$(".items_body").remove();
					$.each(response.responseJSON, function(index, val){
						console.log(index+":"+val);	
					});
				}
			});
		});

		$('body').on('click','.add_items',function(e){
			e.preventDefault();
			const vendor_id = $(this).parents('.items_body').data('vendor-id');
			const row_id = $(this).parents('.items_body td').data('row-id');
			const form_no = $(this).closest('tr').children('td.form_no').text();
			const vendor_code = $(this).closest('tr').children('td.vendor_code').text();
			const item_no = $(this).closest('tr').children('td.item_no').text();
			const quantity = $(this).closest('tr').children('td.available_quantity').text();
			const description = $(this).closest('tr').children('td.description').text();
			const lot_no = $(this).closest('tr').children('td.lot_no').text();
			const lotting_id = $(this).closest('tr').children('.lotting_id').val();

			$('#a_vendor_id').val(vendor_id);
			$('#a_vendor_code').val(vendor_code);
			$('#a_lotting_id').val(lotting_id);
			$('#a_form_no').val(form_no);
			$('#a_item_no').val(item_no);
			$('#a_lot_no').val(lot_no);
			$('#a_description').val(description);
			$('#a_quantity').val(quantity);

			$("#a_quantity").prop("readonly", false); 
			$("#a_rate").prop("readonly", false); 
		});

		$('#a_buyer_code').on('change', function(e) {
			e.preventDefault();
			var oldval = $('#a_buyer_name').val();
			var newval = this.value;
			if(oldval!=newval)
				$('#a_buyer_name').val(this.value).trigger('change');
			$("#a_invoice_no").prop("readonly", false);
		});

		$('#a_buyer_name').on('change', function(e) {
			e.preventDefault();
			var oldval = $('#a_buyer_code').val();
			var newval = this.value;
			if(oldval!=newval)
				$('#a_buyer_code').val(this.value).trigger('change');
		});

		//Check if Invoice Number already exists in database
		$("#a_invoice_no").on('change',function(e){
			e.preventDefault();
			var buyer_id = $('#a_buyer_code').val();
			var invoice_id = $(this).val();
			$.ajax({
				type:'post',
				url:'{{ url("/check_invoice") }}',
				dataType: 'json',
				data:{
					buyer_id: buyer_id,
					invoice_id: invoice_id
				},
				success:function(data) {
					console.log(data['success']);
					if(data['success']){
						$('.alert-danger').hide();
						$('.alert-success').show().html(data['success']);
					}
					if(data==false){
						$('.alert-success').hide();
						$('.alert-danger').hide();
					}	
				},
				error: function(response){
					$.each(response.responseJSON, function(index, val){
						$('.alert-success').hide();
						$('.alert-danger').show().html(val);	
					});
				}
			});
		});

		// Calculations
		$('body').on('change','#a_quantity',function(e){
			e.preventDefault();
			$('#a_rate').trigger('change');
		});
		$('body').on('change','#a_rate',function(e){
			e.preventDefault();
			const quantity = $('#a_quantity').val();
			const rate =  $('#a_rate').val();
			$('#a_total').val(quantity*rate);
			$("#a_discount").prop("readonly", false); 
			$('#a_discount').trigger('change');
		});
		$('body').on('change','#a_discount',function(e){
			e.preventDefault();
			const total = $('#a_total').val();
			const discount =  $('#a_discount').val();
			$('#a_net_total').val(total-discount);
			$("#a_buyers_premium").prop("readonly", false); 
			$('#a_buyers_premium').trigger('change');
		});
		$('body').on('change','#a_buyers_premium',function(e){
			e.preventDefault();
			const net_total = $('#a_net_total').val();
			const buyers_premium =  $('#a_buyers_premium').val();
			const buyers_premium_amount = (buyers_premium/100)*net_total;
			$('#a_buyers_premium_amount').val(buyers_premium_amount).trigger('change');
		});
		$('#a_buyers_premium_amount').on('change paste keyup',function(e){
			e.preventDefault();
			var net_total = $('#a_net_total').val();
			var buyers_premium_amount =  $('#a_buyers_premium_amount').val();
			var grand_total = parseFloat(net_total) + parseFloat(buyers_premium_amount);
			$('#a_grand_total').val(grand_total);
			$(".sale_button").prop("disabled", false); 
		});

		$('body').on('click','.sale_button',function(e){
			e.preventDefault();
			swal({
				title: "Are you sure?",
				text: "Have a second look if not sure !",
				icon: "warning",
				buttons: true,
			})
			.then((willSale) => {
				if (willSale) {

				// TO BE SUBMITTED FOR SAVE 
				var lotting_id = $('#a_lotting_id').val();
				var auction_id = $('#a_auction_id').val();
				var vendor_id = $('#a_vendor_id').val();
				var vendor_code = $('#a_vendor_code').val();
				var buyer_id = $('#a_buyer_code').val();
				var invoice_id = $('#a_invoice_no').val(); 
				var form_no = $('#a_form_no').val();
				var item_no = $('#a_item_no').val();
				var lot_no = $('#a_lot_no').val();
				var rate = $('#a_rate').val();
				var quantity = $('#a_quantity').val();
				var discount = $('#a_discount').val();
				var buyers_premium_amount = $('#a_buyers_premium_amount').val();
				var grand_total = $('#a_grand_total').val();

				// NO NEED TO SUBMIT
				var description = $('#a_description').val();
				var total = $('#a_total').val();
				var buyers_premium_amount = $('#a_buyers_premium_amount').val();
				var net_total = $('#a_net_total').val();
				var form_no = $('#a_form_no').val();

				$.ajax({
					type:'post',
					url:'{{ url("/save_new_sale") }}',
					dataType: 'json',
					data:{
						lotting_id: lotting_id,
						auction_id: auction_id,
						vendor_id: vendor_id,
						buyer_id: buyer_id,
						invoice_id: invoice_id,
						form_no: form_no,
						item_no: item_no,
						lot_no: lot_no,
						rate: rate,
						quantity: quantity,
						discount: discount,
						buyers_premium_amount: buyers_premium_amount              
					},
					success:function(data) {
						$('.alert-danger').hide();
						$('.confirm_input').val('');
						$('#a_auction_id').trigger('change');

						$('.added_items_div').show();
						$('.alert-success').show().html('ITEM ADDED SUCCESSFULLY');
						console.log(data['sale_id']);
						var row = '';
						row += '<tr class="added_items_body" data-sale-id="'+data['sale_id']+'" data-buyer-id="'+buyer_id+'" data-vendor-id="'+vendor_id+'" data-invoice-id="'+invoice_id+'">';
						row += '<td class="vendor_code"></td>';
						row += '<td class="invoice_id">'+invoice_id+'</td>';
						row += '<td class="vendor_code">'+vendor_code+'</td>';
						row += '<td class="item_no">'+item_no+'</td>';
						row += '<td class="form_no">'+form_no+'</td>';
						row += '<td class="description">'+description+'</td>';
						row += '<td class="rate">'+rate+'</td>';
						row += '<td class="quantity">'+quantity+'</td>';
						row += '<td class="total price">'+total+'</td>';
						row += '<td class="discount price">'+discount+'</td>';
						row += '<td class="net_total price">'+net_total+'</td>';
						row += '<td class="buyers_premium_amount price">'+buyers_premium_amount+'</td>';
						row += '<td class="grand_total price">'+grand_total+'</td>';
						row += '<td><div class="remove_item"><i class="fa fa-window-close text-red" aria-hidden="true"></i></div></td>';
						row += '</tr>';
						$('.added_items_table tbody').append(row);
						$('.added_items_table').sumtr({sumCells : '.price'});
					},
					error: function(response){
						$.each(response.responseJSON, function(index, val){
							console.log(index+":"+val);
							$('.alert-success').hide();
							$('.alert-danger').show().html(val);	
						});
					}
				});
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
					const sale_id = $(this).parents('.added_items_body').data('sale-id');
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
	</script>
	@endpush