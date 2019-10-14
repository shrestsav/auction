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

<div class="box-body">
	<form role="form" method="POST" action="{{route('buyers.update',$buyer->id)}}" data-toggle="validator" enctype="multipart/form-data">
		@csrf
		<input type="hidden" name="_method" value="PUT" />
		@foreach($fields as $f_name => $part)
			<div class="col-md-{{$part['col']}}">
				<div class="form-group">
					<label for="{{$part['id']}}">{{$f_name}}</label>
					@if($part['type']=='text' || $part['type']=='number' || $part['type']=='email' || $part['type']=='date')
						<input type="{{$part['type']}}" name="{{$part['name']}}" class="form-control" id="{{$part['id']}}" placeholder="Enter {{$f_name}}" @if($part['req']) required @endif value="{{$buyer->{$part['name']} }}" @if($part['name']=='buyer_code') readonly @endif>
					@elseif($part['type']=='select')
						<select name="{{$part['name']}}" class="form-control select2" id="{{$part['id']}}" style="width: 100%;" @if($part['req']) required @endif>
							<option hidden disabled selected value>Select {{$f_name}}</option>
							@foreach(${$part['var']} as $data)
								@if($part['name']=='state')
									<option value="{{$data->name}}" @if($data->name==$buyer->{$part['name']}) selected @endif>{{$data->name}}</option>
								@endif
							@endforeach
						</select>
					@elseif($part['type']=='textarea')
						<textarea type="text" name="{{$part['name']}}" class="form-control" id="{{$part['id']}}" placeholder="{{$f_name}}">{{ $buyer->{$part['name']} }}</textarea>
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
						<input type="radio" class="b_buyers_premium_yes" value="1" name="buyers_premium" onclick="show1();" @if($buyer->buyers_premium==1) checked  @endif>
					</label>
					<label>
						No
						<input type="radio" class="b_buyers_premium_no" value="2" name="buyers_premium" onclick="hide1();" @if($buyer->buyers_premium==2) checked  @endif>
					</label>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group b_buyers_premium_rate">
				<label for="b_buyers_premium_rate">Buyers Premium Rate</label>
				<input type="number" name="buyers_premium_rate" class="form-control" id="b_buyers_premium_rate" placeholder="Buyers Premium Rate" value="{{$buyer->buyers_premium_rate}}">
			</div>
		</div>
		<div class="col-md-12">
			<div class="box-footer text-center">
				<button type="submit" class="btn btn-purple">Submit</button>
			</div>
		</div>
	</form>
</div>