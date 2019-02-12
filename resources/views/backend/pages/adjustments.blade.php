@extends('backend.layouts.app',['title'=>'Adjustments'])
@push('styles')
<style type="text/css">
	.modal-title{
		text-align: center;
	}
</style>
@endpush
@section('content')

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
      	<div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="https://dummyimage.com/200x200/000/fff.png" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">State</h3>
              <h5 class="widget-user-desc">Add New</h5>
              <a data-toggle="modal" data-target="#show_states"><h5 class="pull-right" style="float: left;">Show All</h4></a>
            {{--   <div class="box-tools pull-right">

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div> --}}
            </div>
            <div class="box-footer no-padding">
               <form class="form-horizontal" action="{{route('adjustments.store')}}" method="post">
               		@csrf
	              <div class="box-body">
	                <div class="form-group">
	                  <label for="state" class="col-sm-4 control-label">State Name</label>
	                  <div class="col-sm-6">
	                    <input type="text" name="name" class="form-control" id="state" placeholder="Eg: New York">
	                  </div>
	                </div>
	              </div>
	              @if ($errors->any())
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				  @endif
	              <!-- /.box-body -->
	              <div class="box-footer">
	                <button type="button" class="btn btn-default">Cancel</button>
	                <button type="submit" class="btn btn-info pull-right">Save</button>
	              </div>
	              <!-- /.box-footer -->
	            </form>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
      </div>
    </section>
    <!-- /.content -->

		<div class="modal fade" id="show_states">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Available States</h4>
              </div>
              <div class="modal-body">
                <table class="table table-hover">
	                <tr>
	                	<th>S.No</th>
		                <th>State Name</th>
		                <th>Action</th>
	                </tr>
                @foreach($states as $state)
	                <tr>
	                  <td>{{$state->id}}</td>
	                  <td>{{$state->name}}</td>
	                  <td><i class="fa fa-pencil"></i> &nbsp; &nbsp; <i class="fa fa-remove"></i></td>
	                </tr>
                @endforeach
              </table>
              </div>
              {{-- <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div> --}}
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

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