@extends('backend.layouts.app',['title'=>'Add Auction'])

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
          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
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
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Auctions</h3>

{{--               <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
	                <tr>
	                  <th>Auction No</th>
	                  <th>Venue</th>
	                  <th>Date</th>
                    <th>Time</th>
	                  <th>Stocks</th>
	                </tr>
                @foreach($auctions as $auction)
	                <tr>
	                  <td>{{$auction->auction_no}}</td>
	                  <td>{{$auction->venue}}</td>
	                  <td>{{$auction->date}}</td>
                    <td><span class="label label-success">{{$auction->time}}</span></td>
	                  <td>
                        @if(in_array($auction->id, $auction_with_stocks))
                          <a href="#" data-toggle="modal" data-target="#auction_stocks_{{$auction->id}}">
                            <i class="fa fa-dot-circle-o"></i>
                          </a>
                        @endif
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

 @foreach($auctions as $auction)
  @if(in_array($auction->id, $auction_with_stocks))
  <div class="modal fade auction_stocks_modal" id="auction_stocks_{{$auction->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">{{$auction->auction_no}} Stocks</h4>
          </div>
          <div class="modal-body">
            <table class="table table-hover buyer_purchases_table" data-buyer-id="{{$auction->id}}">
                <tr>
                  <th>S.No</th>
                  <th>Vendor Code</th>
                  <th>Form No</th>
                  <th>Item No</th>
                  <th>Description</th>
                  <th>Quantity</th>
                  <th>Sold</th>
                  <th>Available</th>
                </tr>
                <?php $count=1; ?>
            @foreach($stocks as $stock)
              @if($auction->id==$stock->auction_id)
                  <tr>
                    <td>{{$count}}</td>
                    <td class="invoice_id">{{$stock->vendor_code}}</td>
                    <td class="form_no">{{$stock->form_no}}</td>
                    <td class="item_no">{{$stock->item_no}}</td>
                    <td class="description">{{$stock->description}}</td>
                    <td class="quantity">{{$stock->quantity}}</td>
                    <td class="quantity">{{$stock->sold}}</td>
                    <td class="quantity">{{$stock->quantity - $stock->sold}}</td>
                  </tr>
                  <?php $count++; ?>
              @endif
              
            @endforeach

          </table>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  @endif
 @endforeach



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
