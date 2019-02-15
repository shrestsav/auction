@extends('backend.layouts.app',['title'=>'Invoices'])
@push('styles')
	<style type="text/css">
		tr>td, tr>th{
			text-align: center;
		}
	</style>
@endpush
@section('content')

   <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">List of Invoices</h3>

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
              	<thead>
	                <tr>
					  <th>S.No</th>
					  <th>Invoice No</th>
					  <th>Buyer Code</th>
	                  <th>Quantity</th>
	                  <th>Total</th>
	                  <th>Discount</th>
	                  <th>Net Total</th>
	                  <th>Buyers Premium Amount</th>
	                  <th>Grand Total</th>
	                  <th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $count=1; ?>
					@foreach($invoices_sum as $invoice_sum)
					<tr>
						<th>{{$count}}</th>
						<th>{{$invoice_sum->invoice_id}}</th>
						<th>{{$invoice_sum->invoice_id}}</th>
						<th>{{$invoice_sum->quantity_sum}}</th>
						<th>$ {{$invoice_sum->total_sum}}</th>
						<th>$ {{$invoice_sum->discount_sum}}</th>
						<th>$ {{$invoice_sum->net_total_sum}}</th>
						<th>$ <?php echo round($invoice_sum->buyers_premium_amount_sum,6); ?></th>
						<th>$ <?php echo round($invoice_sum->grand_total_sum,6); ?></th>
						<th>
							<a href="#" data-toggle="modal" data-target="#invoice_{{$invoice_sum->invoice_id}}">
		                  		<i class="fa fa-eye"></i>
		                  	</a>
		                  	&nbsp;&nbsp;
		                  	<?php $id = ["invoice_id"=>$invoice_sum->invoice_id]; ?>
		                  	<a href="{{route('reports.print_invoice', $id)}}" target="_blank"><i class="fa fa-print"></i></a></th>
					</tr>
					
					<?php $count++; ?>
					@endforeach
				</tbody>
				
			  </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->

  @foreach($unique_invoices as $unique_invoice)  
	<div class="modal fade vendor_stocks" id="invoice_{{$unique_invoice->invoice_id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Purchases</h4>
          </div>
          <div class="modal-body">
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
              	<thead>
	                <tr>
					  <th>S.No</th>
					  <th>Invoice No</th>
					  <th>Auction No</th>
					  <th>Buyer Code</th>
					  <th>Vendor Code</th>
	                  <th>Form No</th>
	                  <th>Item No</th>
	                  <th>Description</th>
	                  <th>Quantity</th>
	                  <th>Rate</th>
	                  <th>Discount</th>
	                  <th>Buyers Premium Amount</th>
	                  <th>Grand Total</th>
					</tr>
				</thead>
				<tbody>
					<?php $count=1; ?>
					@foreach($invoices as $invoice)
						@if($unique_invoice->invoice_id==$invoice->invoice_id)
						<tr>
							<td>{{$count}}</td>
							<td>{{$invoice->invoice_id}}</td>
							<td>{{$invoice->auction_no}}</td>
							<td>{{$invoice->buyer_code}}</td>
							<td>{{$invoice->vendor_code}}</td>
							<td>{{$invoice->form_no}}</td>
							<td>{{$invoice->item_no}}</td>
							<td>{{$invoice->description}}</td>
							<td>{{$invoice->quantity}}</td>
							<td>$ {{$invoice->rate}}</td>
							<td>$ {{$invoice->discount}}</td>
							<td>$ <?php echo round($invoice->buyers_premium_amount,6); ?></td>
							<?php $grand_total = ($invoice->quantity * $invoice->rate)-$invoice->discount+$invoice->buyers_premium_amount ?>
							<td>$ {{$grand_total}}</td>
						</tr>
						<?php $count++; ?>
						@endif
					@endforeach
				</tbody>
			  </table>
            </div>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
@endforeach

@endsection
@push('scripts')

@endpush