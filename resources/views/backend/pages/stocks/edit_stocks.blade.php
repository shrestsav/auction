@extends('backend.layouts.app',['title'=>'Edit Stock'])

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
				<div class="box box-success ">
					<div class="box-header with-border">
						<h3 class="box-title">Edit Stock</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
							</button>
						</div>
					</div>
					<div class="box-body">
						<form role="form" method="POST" action="{{route('stocks.update',$stocks->id)}}">
							@csrf
							<div class="col-md-2">
								<div class="form-group">
									<label for="s_vendor_code">Vendor Code</label>
									<input type="text" class="form-control" id="s_date" value="{{$stocks->vendor_code}}" placeholder="Date" disabled>
								</div>
							</div>
							@foreach($fields as $f_name => $part)
								<div class="col-md-{{$part['col']}}">
									<div class="form-group">
										<label for="{{$part['id']}}">{{$f_name}}</label>
										<input type="{{$part['type']}}" name="{{$part['name']}}" class="form-control" id="{{$part['id']}}" placeholder="{{$f_name}}" value="{{$stocks->{$part['name']} }}" required>
									</div>
								</div>
							@endforeach
							<div class="col-md-6">
								<div class="form-group">
									<label for="s_description">Description</label>
									<textarea type="text" name="description" class="form-control" id="s_description" placeholder="Description" required>{{$stocks->description}}</textarea> 
								</div>
							</div>
							<div class="col-md-12">
								<div class="box-footer">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>    
						</form>
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