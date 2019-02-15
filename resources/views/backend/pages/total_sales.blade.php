@extends('backend.layouts.app',['title'=>'Total Sales'])
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
              <h3 class="box-title">All Sales by Items</h3>

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
					@foreach($all_sales as $all_sale)
					<tr>
						<td>{{$all_sale->invoice_id}}</td>
						<td>{{$all_sale->auction_no}}</td>
						<td>{{$all_sale->buyer_code}}</td>
						<td>{{$all_sale->vendor_code}}</td>
						<td>{{$all_sale->form_no}}</td>
						<td>{{$all_sale->item_no}}</td>
						<td>{{$all_sale->description}}</td>
						<td>{{$all_sale->quantity}}</td>
						<td>$ {{$all_sale->rate}}</td>
						<td>$ {{$all_sale->discount}}</td>
						<td>$ <?php echo floatval($all_sale->buyers_premium_amount); ?></td>
						<?php $grand_total = ($all_sale->quantity * $all_sale->rate)-$all_sale->discount+$all_sale->buyers_premium_amount ?>
						<td>$ {{$grand_total}}</td>
					</tr>
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


@endsection
@push('scripts')

@endpush