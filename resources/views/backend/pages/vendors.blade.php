@extends('backend.layouts.app',['title'=>'Vendors'])

@section('content')

@php
$gst_status = ['inclusive', 'exclusive'];

$fields = [
	'Vendor Code *' => [
		'name'	=> 'vendor_code',
		'id'	=> 'v_vendor_code',
		'type'	=> 'text',
		'col' 	=> '2',
		'req' 	=> true,
	],
	'First Name *' => [
		'name'	=> 'first_name',
		'id'	=> 'v_first_name',
		'type'	=> 'text',
		'col' 	=> '3',
		'req' 	=> true,
	],
	'Last Name *' => [
		'name'	=> 'last_name',
		'id'	=> 'v_last_name',
		'type'	=> 'text',
		'col' 	=> '4',
		'req' 	=> true,
	],
	'Company Name' => [
		'name'	=> 'company',
		'id'	=> 'v_company',
		'type'	=> 'text',
		'col' 	=> '3',
		'req' 	=> true,
	],
	'Address *' => [
		'name'	=> 'address',
		'id'	=> 'v_address',
		'type'	=> 'text',
		'col' 	=> '4',
		'req' 	=> true,
	],
	'Suburb *' => [
		'name'	=> 'suburb',
		'id'	=> 'v_suburb',
		'type'	=> 'text',
		'col' 	=> '2',
		'req' 	=> true,
	],
	'State *' => [
		'name'	=> 'state',
		'id'	=> 'v_state',
		'type'	=> 'select',
		'var'	=> 'states',
		'col' 	=> '2',
		'req' 	=> true,
	],
	'Postcode *' => [
		'name'	=> 'postcode',
		'id'	=> 'v_postcode',
		'type'	=> 'number',
		'col' 	=> '4',
		'req' 	=> true,
	],
	'Mobile' => [
		'name'	=> 'mobile',
		'id'	=> 'v_mobile',
		'type'	=> 'text',
		'col' 	=> '4',
		'req' 	=> false,
	],
	'Email' => [
		'name'	=> 'email',
		'id'	=> 'v_email',
		'type'	=> 'email',
		'col' 	=> '4',
		'req' 	=> false,
	],
	'Joined Date' => [
		'name'	=> 'joined_date',
		'id'	=> 'v_joined_date',
		'type'	=> 'date',
		'col' 	=> '4',
		'req' 	=> true,
	],
	'A/C No' => [
		'name'	=> 'a/c_no',
		'id'	=> 'v_account_no',
		'type'	=> 'text',
		'col' 	=> '6',
		'req' 	=> false,
	],
	'BSB No' => [
		'name'	=> 'bsb_no',
		'id'	=> 'v_bsb_no',
		'type'	=> 'text',
		'col' 	=> '6',
		'req' 	=> false,
	],
	'ABN' => [
		'name'	=> 'abn',
		'id'	=> 'v_abn',
		'type'	=> 'text',
		'col' 	=> '3',
		'req' 	=> false,
	],
	'GST Status *' => [
		'name'	=> 'gst_status',
		'id'	=> 'v_gst_status',
		'type'	=> 'select',
		'var'		=> 'gst_status',
		'col' 	=> '3',
		'req' 	=> true,
	],
	'Payment Method *' => [
		'name'	=> 'payment_method',
		'id'	=> 'v_payment_method',
		'type'	=> 'select',
		'var'	=> 'payment_methods',
		'col' 	=> '3',
		'req' 	=> true,
	],
	'Commission *' => [
		'name'	=> 'commission',
		'id'	=> 'v_commission',
		'type'	=> 'number',
		'col' 	=> '3',
		'req' 	=> true,
	],
	'Comments' => [
		'name'	=> 'comments',
		'id'	=> 'v_comments',
		'type'	=> 'textarea',
		'col' 	=> '12',
		'req' 	=> true,
	],
];
@endphp

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-purple {{-- collapsed-box --}} box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Add Vendor</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="box-body">
					<form role="form" method="POST" data-toggle="validator" action="{{route('vendors.store')}}" enctype="multipart/form-data">
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
										@elseif($part['name']=='gst_status' || $part['name']=='payment_method')
											<option value="{{$data}}">{{ucfirst($data)}}</option>
										@endif
									@endforeach
								</select>
								@elseif($part['type']=='textarea')
								<textarea type="text" name="{{$part['name']}}" class="form-control" id="{{$part['id']}}" placeholder="{{$f_name}}"></textarea>
								@endif
							</div>
						</div>
						@endforeach

						<div class="col-md-12">
							<div class="box-footer">
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
					<h3 class="box-title">List of Vendors</h3>
				</div>
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tr>
							{{-- <th>S.No</th> --}}
							<th>Vendor Code</th>
							<th>Vendor Name</th>
							<th>Mobile</th>
							<th>Joined Date</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
						@php
						$c=1;
						@endphp
						@foreach($vendors as $vendor)
						<tr data-vendor-id="{{$vendor->id}}">
							{{-- <td>{{$c}}</td> --}}
							<td>{{$vendor->vendor_code}}</td>
							<td>{{$vendor->first_name}} {{$vendor->last_name}}</td>
							<td>{{$vendor->mobile}}</td>
							<td><span class="label bg-purple">{{$vendor->joined_date}}</span></td>
							<td>{{$vendor->address}}</td>
							<td>
								<a href="#" class="edit_vendor">
									<span class="action_icons"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
								</a>
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
		'modalId' => 'editVendorModal',
		'modalFile' => '__modal_body',
		'modalTitle' => __('User Details'),
		'modalSize' => 'large_modal_dialog',
		])

		@endsection

		@push('scripts')
		<script type="text/javascript">
    //Show User Detail Modal
    
    $('.edit_vendor').on('click',function (e) {
    	e.preventDefault();
    	var vendor_id = $(this).parent().parent().data('vendor-id');
    	$.ajax({
    		type: 'GET',
    		url: SITE_URL + 'vendors/' + vendor_id + '/edit',
    		dataType: 'json'
    	}).done(function (response) {
    		console.log(response);
    		detailModel = $('#editVendorModal');
    		detailModel.find('.modal-content .modal-title').html(response.title);
    		detailModel.find('.modal-body').html(response.html);
    		detailModel.modal('show');
    	});
    });
  </script>
  @endpush