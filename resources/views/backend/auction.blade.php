@extends('backend.layouts.app',['title'=>'Auctions'])

@push('styles')
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-timepicker.min.css') }}">
@endpush

@section('content')

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">

      	<div class="col-md-4">
          <!-- general form elements -->
          <div class="box box-success collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Add Auction</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<form role="form" method="POST" action="{{route('auctions.store')}}">
            	   @csrf
                  <div class="form-group">
                    <label for="a_venue">Venue</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                      </div>
                      <input type="text" name="venue" class="form-control" id="a_venue" placeholder="Enter Venue" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="a_date">Date</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" name="date" class="form-control" id="a_date" placeholder=" Date" required>
                    </div>
                  </div>
    				      <!-- time Picker -->
		              <div class="bootstrap-timepicker">
		                <div class="form-group">
		                  <label>Time picker:</label>
		                  <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
		                    <input type="text" name="time" class="form-control timepicker">
		                  </div>
		                </div>
		              </div>
			   
			        	<div class="box-footer">
		              		<button type="submit" class="btn btn-primary">Submit</button>
		            </div>    
            	</form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Auctions</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
	                <tr>
	                  <th>Auction No</th>
	                  <th>Venue</th>
	                  <th>Date</th>
	                  <th>Time</th>
	                </tr>
                @foreach($auctions as $auction)
	                <tr>
	                  <td>{{$auction->auction_no}}</td>
	                  <td>{{$auction->venue}}</td>
	                  <td>{{$auction->date}}</td>
	                  <td><span class="label label-success">{{$auction->time}}</span></td>
	                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->

@endsection
@push('scripts')
  <!-- bootstrap time picker -->
  <script src="{{ asset('backend/js/bootstrap-timepicker.min.js') }}"></script>
  <script type="text/javascript">
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  </script>
@endpush
