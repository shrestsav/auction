@extends('backend.layouts.app',['title'=>'Lotting'])

@section('content')

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">

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
            	<form role="form" method="POST" action="{{route('lotting.store')}}">
            	@csrf
            		<div class="col-md-2">
		                <div class="form-group">
		                  	<label for="v_state">Auction </label>
		                  	{{-- <input type="text" name="state" class="form-control" id="v_state" placeholder="State" required> --}}
		                	<select name="state" class="form-control select2" id="v_state" style="width: 100%;" required>
		                		<option selected="selected" disabled>Select Auction</option>
				                 @foreach ($auctions as $auction)
				                  	<option value="{{$auction->id}}">{{$auction->auction_no}}</option>
				                 @endforeach
			                </select>
		                </div>
		            </div>
	              	<div class="col-md-4">
		                <div class="form-group">
		                  <label for="l_venue">Venue</label>
		                  <input type="text" name="first_name" class="form-control" id="l_venue" placeholder="Venue" disabled>
		                </div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                  <label for="l_date">Date</label>
		                  <input type="text" name="last_name" class="form-control" id="l_date" placeholder="Date" disabled>
		                </div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                  <label for="l_time">Time</label>
		                  <input type="text" name="address" class="form-control" id="l_time" placeholder="Address" disabled>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="s_vendor_code">Vendor Code</label>
		                  <select name="vendor_code" class="form-control select2" id="s_vendor_code" style="width: 100%;" required>
			                  <option selected="selected" disabled>Vendor Code</option>
			                  @foreach($vendors_with_stocks as $vendor)
			                  	<option value="{{$vendor->id}}">{{$vendor->vendor_code}}</option>
			                  @endforeach
			                </select>
		                </div>

		            </div>
	              	<div class="col-md-5">
		                <div class="form-group">
		                  <label for="s_vendor_name">Vendor</label>
		                  <select name="vendor_name" class="form-control select2" id="s_vendor_name" style="width: 100%;" required>
			                  <option selected="selected" disabled>Select Vendor</option>
			                  @foreach($vendors_with_stocks as $vendor)
			                  	<option value="{{$vendor->id}}">{{$vendor->first_name}} {{$vendor->last_name}}</option>
			                  @endforeach
			              </select>
		                </div>
		            </div>
		            <div class="col-md-12">
		                <div class="form-group">
		                  	<label for="l_stocks">Stocks</label>
		                  	<div class="box-body table-responsive no-padding">
				              <table class="table table-hover stocks_table">
					                <tr class="stocks_head">
					                  <th>Form No</th>
					                  <th>Item No</th>
					                  <th>Quantity</th>
					                  <th>Description</th>
					                  <th>Commission</th>
					                </tr>
				               
				             
				              </table>
				            </div>
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="v_postcode">Postcode *</label>
		                  <input type="number" name="postcode" class="form-control" id="v_postcode" placeholder="Postcode" required>
		                </div>
		            </div>
		           	<div class="col-md-4">
		                <div class="form-group">
		                  <label for="v_telephone_home">Telephone Home </label>
		                  <input type="text" name="telephone_home" class="form-control" id="v_telephone_home" placeholder="Telephone Home ">
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="v_telephone_work">Telephone Work </label>
		                  <input type="text" name="telephone_work" class="form-control" id="v_telephone_work" placeholder="Telephone Work ">
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="v_mobile">Mobile </label>
		                  <input type="text" name="mobile" class="form-control" id="v_mobile" placeholder="Mobile">
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="v_email">Email </label>
		                  <input type="email" name="email" class="form-control" id="v_email" placeholder="Email">
		                </div>
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <label for="v_joined_date">Joined Date </label>
		                  <input type="date" name="joined_date" class="form-control" id="v_joined_date" placeholder="Joined Date" required>
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="form-group">
		                  <label for="v_account_no">A/C No </label>
		                  <input type="text" name="a/c_no" class="form-control" id="v_account_no" placeholder="A/C Number">
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="form-group">
		                  <label for="v_bsb_no">BSB No </label>
		                  <input type="text" name="bsb_no" class="form-control" id="v_bsb_no" placeholder="BSB Number">
		                </div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                  <label for="v_abn">ABN</label>
		                  <input type="text" name="abn" class="form-control" id="v_abn" placeholder="ABN">
		                </div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                	<label for="v_gst_status">GST Status *</label>
		                  	<select class="form-control" name="gst_status" id="v_gst_status">
			                  <option selected="selected" value="inclusive">Inclusive</option>
			                  <option value="exclusive">Exclusive</option>
			                </select>
		                </div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                  <label for="v_payment_method">Payment Method *</label>
		                  <select class="form-control" name="payment_method" id="v_payment_method">
			                  <option selected="selected" disabled> </option>
			                  <option value="cash">Cash</option>
			                  <option value="eftpos">Eftpos</option>
			                  <option value="credit">Credit</option>
			                  <option value="bank transfer">Bank Transfer</option>
			              </select>
		                  {{-- <input type="text" name="payment_method" class="form-control" id="v_payment_method" placeholder="Payment Method" required> --}}
		                </div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                  <label for="v_commission">Commission *</label>
		                  <input type="number" name="commission" class="form-control" id="v_commission" placeholder="Commission" required>
		                </div>
		            </div>
		            <div class="col-md-12">
		                <div class="form-group">
		                  <label for="v_comments">Comments</label>
		                  <textarea type="text" name="comments" class="form-control" id="v_comments" placeholder="Comments"></textarea>
		                </div>
		            </div>
			        <div class="col-md-12">
			        	<div class="box-footer">
		              		<button type="submit" class="btn btn-primary">Submit</button>
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
		$('#s_vendor_code').on('change', function() {
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
               		$(".stocks_body").remove();
               		var length = data.length;
               		for(i=0; i<length;i++){
               			$('.stocks_table').append('<tr class="stocks_body"><td>'+data[i]["form_no"]+'</td><td>'+data[i]["item_no"]+'</td><td>'+data[i]["quantity"]+'</td><td>'+data[i]["description"]+'</td><td>'+data[i]["commission"]+'</td></tr>');
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

	</script>
@endpush