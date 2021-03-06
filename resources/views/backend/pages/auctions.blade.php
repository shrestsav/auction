@extends('backend.layouts.app',['title'=>'Auctions'])

@push('styles')
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-timepicker.min.css') }}">
@endpush

@section('content')

    <section class="content">
      <div class="row">
      	<div class="col-md-4">
          <div class="box box-purple box-solid{{--  collapsed-box --}}">
            <div class="box-header with-border">
              <h3 class="box-title">Add Auction</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
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
		              <button type="submit" class="btn btn-purple">Submit</button>
		            </div>    
            	</form>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="box box-purple">
            <div class="box-header">
              <h3 class="box-title">Auctions</h3>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
	                <tr>
	                  <th>Auction No</th>
	                  <th>Venue</th>
	                  <th>Date</th>
                    <th>Time</th>
	                  <th>Stocks</th>
	                </tr>
                </thead>
                @foreach($auctions as $auction)
	                <tr>
	                  <td>{{$auction->auction_no}}</td>
	                  <td>{{$auction->venue}}</td>
	                  <td>{{$auction->date}}</td>
                    <td><span class="label bg-purple">{{$auction->time}}</span></td>
	                  <td>
                      @if(count($auction->lottings))
                        <a href="#" data-toggle="modal" data-target="#auction_stocks_{{$auction->id}}">
                          <i class="fa fa-dot-circle-o"></i>
                        </a>
                        {{-- Modal Popup --}}
                        <div class="modal fade auction_stocks_modal" id="auction_stocks_{{$auction->id}}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">{{$auction->auction_no}} Stocks</h4>
                              </div>
                              <div class="modal-body">
                                <table class="table table-hover buyer_purchases_table datatable_with_print" data-buyer-id="{{$auction->id}}">
                                  <thead>
                                    <tr>
                                      <th>S.No</th>
                                      <th>Vendor Code</th>
                                      <th>Form No</th>
                                      <th>Item No</th>
                                      <th>Description</th>
                                      <th>Quantity</th>
                                      <th>Sold</th>
                                      <th>Left</th>
                                    </tr>
                                  </thead>
                                    @php 
                                      $count = 1;
                                    @endphp
                                    <tbody>
                                  @foreach($auction->lottings as $stock)
                                    @php
                                      $sold = 0; 
                                      if(count($stock->sale)){
                                        foreach($stock->sale as $sale){
                                          $sold += $sale->quantity;
                                        }
                                      }
                                    @endphp
                                    
                                      <tr>
                                        <td>{{$count}}</td>
                                        <td class="vendor_code">{{$stock->vendor->vendor_code}}</td>
                                        <td class="form_no">{{$stock->form_no}}</td>
                                        <td class="item_no">{{$stock->item_no}}</td>
                                        <td class="description">{{$stock->description}}</td>
                                        <td class="quantity">{{$stock->quantity}}</td>
                                        <td class="sold">{{$sold}}</td>
                                        <td class="left_quantity">{{$stock->quantity - $sold}}</td>
                                      </tr>
                                    
                                      @php 
                                        $count++; 
                                      @endphp
                                  @endforeach
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      @else
                        <a href="#" data-auction-id="{{$auction->id}}" class="delete_auction">
                          <i class="fa fa-trash"></i>
                        </a>
                      @endif
                    </td>
	                </tr>
                @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection
@push('scripts')

  <script src="{{ asset('backend/js/bootstrap-timepicker.min.js') }}"></script>
  <script src="{{ asset('backend/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('backend/js/buttons.print.min.js') }}"></script>
  <script type="text/javascript">
    $('.timepicker').timepicker({
      showInputs: false
    })

    $('.delete_auction').on('click',function(e){
      e.preventDefault();
      const me = $(this);
      swal({
        title: "Are you sure?",
        text: "Once deleted, this item will be removed from the invoice",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          const auction_id = $(this).data('auction-id');
          $.ajax({
            type:'DELETE',
            url: SITE_URL + 'auctions/' + auction_id,
            dataType: 'json',
            data:{
              auction_id: auction_id,    
            },
            success:function(data) {
              console.log(data)
              swal("Deleted!", {
                icon: "success",
              });
              me.parent().parent().remove();
              // location.reload();
              
            },
            error: function(response){
            }
          });
        } 
      });
    })

    $(document).ready(function() {
      $('.datatable_with_print').DataTable( {
          dom: 'Bfrtip',
          buttons: [
            {
              extend: 'print',
              title: '',
              customize: function(win) {
                $(win.document.body).css('font-size', '5pt');
                $(win.document.body).css('margin', '0px');
                $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
              }
            }
          ],

      });




    // DatatableButtons = function() {
    //   var e, a = $(".datatable_with_print");
    //   a.length && (e = {
    //     lengthChange: !1,
    //     dom: "Bfrtip",
    //     buttons: ["copy", "print"],
    //     language: {
    //       paginate: {
    //         previous: "<i class='fas fa-angle-left'>",
    //         next: "<i class='fas fa-angle-right'>"
    //       }
    //     }
    //   }, a.on("init.dt", function() {
    //       $(".dt-buttons .btn").removeClass("btn-secondary").addClass("btn-sm btn-default")
    //   }).DataTable(e))
    // }();








    });
  </script>
@endpush
