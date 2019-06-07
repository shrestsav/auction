@extends('backend.layouts.app',['title'=>'Dashboard'])

@section('content')

    <!-- Main content -->
    <section class="content" style="padding-top: 50px;">
      <!-- /.row -->
      <div class="row">
        <div class="col-md-12">
          {{-- <div class="box">
            <div class="box-header" style="text-align: center;">
              <h3 class="box-title" >Welcome You are Logged In</h3>

              
            </div>
            <div class="box-body  no-padding">
            </div>
          </div> --}}
          <!-- /.box -->
          <!-- DONUT CHART -->
          <div class="box box-purple">
            {{-- <div class="box-header with-border">
              <h3 class="box-title">Donut Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div> --}}
            <div class="box-body chart-responsive">
              <div class="chart" id="total_status" style="height: 300px; position: relative;"></div>
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
  <script src="{{ asset('backend/js/morris.min.js') }}"></script>
  <script src="{{ asset('backend/js/raphael.min.js') }}"></script>
  <script>
  $(function () {
    //DONUT CHART
    var buyers = {{$buyers}};
    var vendors = {{$vendors}};
    var auctions = {{$auctions}};
    var donut = new Morris.Donut({
      element: 'total_status',
      resize: true,
      colors: ["#3c8dbc", "#f56954", "#00a65a"],
      data: [
        {label: "Buyers", value: buyers},
        {label: "Vendors", value: vendors},
        {label: "Auctions", value: auctions}
      ],
      hideHover: 'auto'
    });

  });
</script>
@endpush