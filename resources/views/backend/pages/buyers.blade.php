@extends('backend.layouts.app',['title'=>'Buyers'])

@section('content')

@php
$fields = [
	'Buyer Code *' => [
		'name'	=> 'buyer_code',
		'id'		=> 'b_buyer_code',
		'type'	=> 'text',
		'col' 	=> '2',
		'req' 	=> true,
	],
	'First Name *' => [
		'name'	=> 'first_name',
		'id'		=> 'b_first_name',
		'type'	=> 'text',
		'col' 	=> '3',
		'req' 	=> true,
	],
	'Last Name *' => [
		'name'	=> 'last_name',
		'id'		=> 'b_last_name',
		'type'	=> 'text',
		'col' 	=> '4',
		'req' 	=> true,
	],
	'Company Name' => [
		'name'	=> 'company',
		'id'		=> 'b_company',
		'type'	=> 'text',
		'col' 	=> '3',
		'req' 	=> false,
	],
	// 'Contact Type' => [
	// 	'name'	=> 'contact_type',
	// 	'id'		=> 'b_contact_type',
	// 	'type'	=> 'text',
	// 	'col' 	=> '3',
	// 	'req' 	=> true,
	// ],
	'Address *' => [
		'name'	=> 'address',
		'id'		=> 'b_address',
		'type'	=> 'text',
		'col' 	=> '3',
		'req' 	=> true,
	],
	'Suburb *' => [
		'name'	=> 'suburb',
		'id'		=> 'b_suburb',
		'type'	=> 'text',
		'col' 	=> '3',
		'req' 	=> true,
	],
	'State *' => [
		'name'	=> 'state',
		'id'		=> 'b_state',
		'type'	=> 'select',
		'var'		=> 'states',
		'col' 	=> '3',
		'req' 	=> true,
	],
	'Postcode *' => [
		'name'	=> 'postcode',
		'id'		=> 'b_postcode',
		'type'	=> 'number',
		'col' 	=> '3',
		'req' 	=> true,
	],
	'Mobile' => [
		'name'	=> 'mobile',
		'id'		=> 'b_mobile',
		'type'	=> 'text',
		'col' 	=> '3',
		'req' 	=> false,
	],
	'Email' => [
		'name'	=> 'email',
		'id'		=> 'b_email',
		'type'	=> 'email',
		'col' 	=> '3',
		'req' 	=> false,
	],
	'Comments' => [
		'name'	=> 'comments',
		'id'		=> 'b_comments',
		'type'	=> 'textarea',
		'col' 	=> '3',
		'req' 	=> false,
	],
];
@endphp
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-purple {{-- collapsed-box --}} box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Add Buyer</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="box-body">
					<form role="form" method="POST" action="{{route('buyers.store')}}" data-toggle="validator" enctype="multipart/form-data">
						@csrf

						@foreach($fields as $f_name => $part)
						<div class="col-md-{{$part['col']}}">
							<div class="form-group">
								<label for="{{$part['id']}}">{{$f_name}}</label>
								@if($part['type']=='text' || $part['type']=='number' || $part['type']=='email' || $part['type']=='date')
								<input type="{{$part['type']}}" name="{{$part['name']}}" class="form-control" id="{{$part['id']}}" placeholder="Enter {{$f_name}}" @if($part['req']) required @endif>
								@elseif($part['type']=='select')
								<select name="{{$part['name']}}" class="form-control select2" id="{{$part['id']}}" style="width: 100%;" @if($part['req']) required @endif>
									<option hidden disabled selected value>Select {{$f_name}}</option>
									@foreach(${$part['var']} as $data)
									@if($part['name']=='state')
									<option value="{{$data->name}}">{{$data->name}}</option>
									@endif
									@endforeach
								</select>
								@elseif($part['type']=='textarea')
								<textarea type="text" name="{{$part['name']}}" class="form-control" id="{{$part['id']}}" placeholder="{{$f_name}}"></textarea>
								@endif
							</div>
						</div>
						@endforeach
						<div class="col-md-2">
							<div class="form-group">
								<label for="b_buyers_premium">Buyers Premium</label>
								<div class="row" style="padding: 5px 0px 0px 30px;">
									<label>
										Yes
										<input type="radio" class="b_buyers_premium_yes" value="1" name="buyers_premium" onclick="show1();">
									</label>
									<label>
										No
										<input type="radio" class="b_buyers_premium_no" value="2" name="buyers_premium" onclick="hide1();" checked>
									</label>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group b_buyers_premium_rate" style="display: none;">
								<label for="b_buyers_premium_rate">Buyers Premium Rate</label>
								<input type="number" name="buyers_premium_rate" class="form-control" id="b_buyers_premium_rate" placeholder="Buyers Premium Rate" >
							</div>
						</div>

						<div class="col-md-12">
							<div class="box-footer text-center">
								<button type="submit" class="btn btn-purple">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="box box-purple box-solid">
				<div class="box-header">
					<h3 class="box-title">List of buyers</h3>
				</div>
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tr>
							{{-- <th>S.No</th> --}}
							<th style="text-align: left; padding-left: 30px;">Buyer Code</th>
							<th>Buyer Name</th>
							<th>Address</th>
							<th>Mobile</th>
							<th>Comments</th>
							<th>Action</th>
						</tr>
						@php
						$c=1;
						@endphp
						@foreach($buyers as $buyer)
						<tr data-buyer-id="{{$buyer->id}}">
							{{-- <td>{{$c}}</td> --}}
							<td style="text-align: left; padding-left: 30px;">{{$buyer->buyer_code}}</td>
							<td>{{$buyer->first_name}} {{$buyer->last_name}}</td>
							<td>{{$buyer->address}}</td>
							<td><span class="label bg-purple">{{$buyer->mobile}}</span></td>
							<td>{{$buyer->comments}}</td>
							<td>
								<a href="#" class="edit_buyer">
									<span class="action_icons"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
								</a>
								@if(count($buyer->purchases))
								<a href="#" data-toggle="modal" data-target="#buyer_purchases_{{$buyer->id}}">
									<i class="fa fa-dot-circle-o"></i>
								</a>
								<div class="modal fade buyer_purchases_modal" id="buyer_purchases_{{$buyer->id}}">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title">Purchases</h4>
												</div>
												<div class="modal-body">
													<table class="table table-hover buyer_purchases_table" data-buyer-id="{{$buyer->id}}">
														<tr>
															<th>S.No</th>
															<th>Invoice No</th>
															<th>Form No</th>
															<th>Item No</th>
															<th>Description</th>
															<th>Rate</th>
															<th>Quantity</th>
															<th>Discount</th>
															<th>BP Amount</th>
															<th>Action</th>
														</tr>
														@php 
														$count=1; 
														@endphp
														@foreach($buyer->purchases as $purchase)
														<tr data-vendor-id="{{$purchase->vendor_id}}">
															<td>{{$count}}</td>
															<td class="invoice_id">{{$purchase->invoice_id}}</td>
															<td class="form_no">{{$purchase->form_no}}</td>
															<td class="item_no">{{$purchase->item_no}}</td>
															<td class="lot_no">{{$purchase->lot_no}}</td>
															<td class="rate">{{$purchase->rate}}</td>
															<td class="quantity">{{$purchase->quantity}}</td>
															<td class="discount">{{$purchase->discount}}</td>
															<td class="buyers_premium_amount">{{round($purchase->buyers_premium_amount,6)}}</td>
															<td>
																&nbsp; &nbsp; 
																<a href="#" class="remove_purchase"><i class="fa fa-remove"></i></a>
															</td>
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
							@php
							$c++;
							@endphp
							@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	@include('backend.modals.modal', [
		'modalId' => 'editBuyerModal',
		'modalFile' => '__modal_body',
		'modalTitle' => __('User Details'),
		'modalSize' => 'large_modal_dialog',
		])

		@endsection
		@push('scripts')
		<script type="text/javascript">
			function show1(){
				$('.b_buyers_premium_rate').show();
			}
			function hide1(){
				$('.b_buyers_premium_rate').hide();
			}
			$('.edit_buyer').on('click',function (e) {
				e.preventDefault();
				var buyer_id = $(this).parent().parent().data('buyer-id');
				$.ajax({
					type: 'GET',
					url: SITE_URL + 'buyers/' + buyer_id + '/edit',
					dataType: 'json'
				}).done(function (response) {
					console.log(response);
					detailModel = $('#editBuyerModal');
					detailModel.find('.modal-content .modal-title').html(response.title);
					detailModel.find('.modal-body').html(response.html);
					detailModel.modal('show');
				});
			});

			$('body').on('click','.remove_purchase',function(e){
				e.preventDefault();
				swal({
					title: "Are you sure?",
					text: "Once deleted, you will not be able to recover this data",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						const current_row = $(this).closest('tr');
						const invoice_id = $(this).closest('tr').children('td.invoice_id').text();
						const buyer_id = $(this).parents('.buyer_purchases_table').data('buyer-id');
						const form_no = $(this).closest('tr').children('td.form_no').text();
						const item_no = $(this).closest('tr').children('td.item_no').text();
						const quantity = $(this).closest('tr').children('td.quantity').text();
						const vendor_id = $(this).closest('tr').data('vendor-id');
						$.ajax({
							type:'post',
							url:'{{ url("/remove_sale") }}',
							dataType: 'json',
							data:{
								buyer_id: buyer_id,
								vendor_id: vendor_id,
								invoice_id: invoice_id,
								form_no: form_no,
								item_no: item_no,     
								quantity: quantity     
							},
							success:function(data) {
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
						swal("Deleted!", {
							icon: "success",
						});
					} 
				});
			});
		</script>
		@endpush