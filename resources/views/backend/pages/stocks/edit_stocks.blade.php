@extends('backend.layouts.app',['title'=>'Edit Stock'])

@section('content')

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
      	<div class="col-md-12">
          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
		  @if (\Session::has('message'))
	        <div class="alert alert-success custom_success_msg">
	            {{ \Session::get('message') }}
	        </div>
	      @endif
        </div>
      	<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success ">
            <div class="box-header with-border">
              <h3 class="box-title">Add Stock</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<form role="form" method="POST" action="{{route('stocks.update',$stocks->id)}}">
            	@csrf
            		<div class="col-md-2">
		                <div class="form-group">
		                  <label for="s_vendor_code">Vendor Code</label>
		                  <input type="text" class="form-control" id="s_date" value="{{$stocks->vendor_code}}" placeholder="Date" disabled>
		                </div>
		            </div>

		            <div class="col-md-5">
		                <div class="form-group">
		                  <label for="s_date"> Date </label>
		                  <input type="date" name="date" class="form-control" id="s_date" placeholder="Date" value="{{$stocks->date}}" required>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="s_form_no">Form No *</label>
		                  <input type="text" name="form_no" class="form-control" id="s_form_no" placeholder="Form No" value="{{$stocks->form_no}}" required>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="s_item_no">Item Number *</label>
		                  <input type="text" name="item_no" class="form-control" id="s_item_no" placeholder="Item Number" value="{{$stocks->item_no}}" required>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="s_commission">Commission *</label>
		                  <input type="number" name="commission" class="form-control" id="s_commission" value="{{$stocks->commission}}" placeholder="Commission" required>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="s_quantity">Quantity </label>
		                  <input type="number" name="quantity" class="form-control" id="s_quantity" placeholder="Quantity" value="{{$stocks->quantity}}" required>
		                </div>
		            </div>

		            <div class="col-md-2">
		                <div class="form-group">
		                  <label for="s_reserve">Reserve</label>
		                  <input type="number" name="reserve" class="form-control" id="s_reserve" value="{{$stocks->reserve}}" placeholder="Reserve">
		                </div>
		            </div>
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
            <!-- /.box-body -->
          </div>
        </div>

      </div>
    </section>
    <!-- /.content -->


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