@extends('backend.layouts.app',['title'=>'Stocks'])

@section('content')

	@php
	$fields = [
		'Form No *' => [
			'name' 	=> 'form_no',
			'id' 	=> 's_form_no',
			'type' 	=> 'text',
			'col' 	=> '2',
		],
		'Commission *' 	=> [
			'name' 	=> 'commission',
			'id'   	=> 's_commission',
			'type' 	=> 'number',
			'col' 	=> '2',
		],
		'Item Number *' => [
			'name' 	=> 'item_no',
			'id' 	=> 's_item_no',
			'type' 	=> 'text',
			'col' 	=> '2',
		],
		'Quantity' => [
			'name' 	=> 'quantity',
			'id' 	=> 's_quantity',
			'type' 	=> 'number',
			'col' 	=> '2',
		],
		'Reserve' => [
			'name' 	=> 'reserve',
			'id' 	=> 's_reserve',
			'type' 	=> 'number',
			'col' 	=> '2',
		],
	];
	@endphp
	
	<section class="content">
		<div class="row">
			<div class="col-md-12">
			</div>
			<div class="col-md-12">
				<div class="box box-purple {{-- collapsed-box --}} box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Add Stock</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
							</button>
						</div>
					</div>
					<div class="box-body">
						<form role="form" method="POST" action="{{route('stocks.store')}}">
							@csrf
							<div class="col-md-2">
								<div class="form-group">
									<label for="s_vendor_code">Vendor Code</label>
									<select name="vendor_id" class="form-control select2" id="s_vendor_code" style="width: 100%;" required>
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
									<select class="form-control select2" id="s_vendor_name" style="width: 100%;" required>
										<option selected="selected" disabled>Select Vendor</option>
										@foreach($vendors as $vendor)
										<option value="{{$vendor->id}}">{{$vendor->first_name}} {{$vendor->last_name}}</option>
										@endforeach
									</select>
								</div>
							</div>

							@foreach($fields as $f_name => $parts)
								<div class="col-md-{{$parts['col']}}">
									<div class="form-group">
										<label for="{{$parts['id']}}">{{$f_name}}</label>
										<input type="{{$parts['type']}}" name="{{$parts['name']}}" class="form-control" id="{{$parts['id']}}" placeholder="{{$f_name}}" required>
									</div>
								</div>
							@endforeach

							<div class="col-md-6">
								<div class="form-group">
									<label for="s_description">Description</label>
									<textarea type="text" name="description" class="form-control" id="s_description" placeholder="Description" required></textarea> 
								</div>
							</div>
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
						<h3 class="box-title">List of Stocks</h3>
					</div>
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover">
							<tr>
								<th>S.No</th>
								<th>Vendor Code</th>
								<th>Form No</th>
								<th>Item No</th>
								<th>Description</th>
								<th>Quantity</th>
								<th>Reserve</th>
								<th>Sold</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
							@php
							$count=1; 
							@endphp
							@foreach($stocks as $stock)
							@php
							$sold = 0;
							if(count($stock->lotting)){
								foreach($stock->lotting as $lotting){
									if(count($lotting->sale)){
										foreach($lotting->sale as $sale){
											$sold += $sale->quantity;
										}
									}
								}
							}
							@endphp
							<tr>
								<td>{{$count}}</td>
								<td>{{$stock->vendor_code}}</td>
								<td>{{$stock->form_no}}</td>
								<td>{{$stock->item_no}}</td>
								<td>{{$stock->description}}</td>
								<td>{{$stock->quantity}}</td>
								<td>{{$sold}}</td>
								<td>{{$stock->reserve}}</td>
								<td>{{$stock->date}}</td>
								<td>		
									<a href="{{url('stocks/'.$stock->id.'/edit')}}"><i class="fa fa-pencil"></i></a>
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
	</section>

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