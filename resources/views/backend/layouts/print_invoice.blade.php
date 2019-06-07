
<html>
  <head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <style type="text/css">
      /* reset */
        *
        {
          border: 0;
          box-sizing: content-box;
          color: inherit;
          font-family: inherit;
          font-size: inherit;
          font-style: inherit;
          font-weight: inherit;
          line-height: inherit;
          list-style: none;
          margin: 0;
          padding: 0;
          text-decoration: none;
          vertical-align: top;
        }
        /* heading */

        h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

        /* table */

        table { font-size: 75%; table-layout: fixed; width: 100%; }
        /*table { border-collapse: separate; border-spacing: 2px; }*/
        th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
        th, td { border-radius: 0.25em; border-style: solid; }
        th { background: #EEE; border-color: #BBB; }
        td { border-color: #DDD; }

        /* page */

        html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
        html { background: #999; cursor: default; }

        body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
        body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

        /* header */

        header { margin: 0 0 3em; }
        header:after { clear: both; content: ""; display: table; }

        header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
        header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
        header address p { margin: 0 0 0.25em; }
        header span, header img { display: block; float: right; }
        header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
        header img { max-height: 100%; max-width: 100%; }
        header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

        /* article */

        article, article address, table.meta, table.inventory { margin: 0 0 3em; }
        article:after { clear: both; content: ""; display: table; }
        article h1 { clip: rect(0 0 0 0); position: absolute; }

        article address { float: left;  line-height: 0.9; letter-spacing: 1px; font-weight: bold; font-size:13px; }

        /* table meta & balance */

        table.meta, table.balance { float: right; width: 36%; }
        table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

        /* table meta */

        table.meta th { width: 40%; }
        table.meta td { width: 60%; }

        /* table items */

        table.inventory { clear: both; width: 100%; }
        table.inventory th { font-weight: bold; text-align: center; }

        table.inventory td:nth-child(1) { text-align: center; width: 6%; }
        table.inventory td:nth-child(2) { text-align: center; width: 38%; }
        table.inventory td:nth-child(3) { text-align: center; width: 12%; }
        table.inventory td:nth-child(4) { text-align: right; width: 12%; }
        table.inventory td:nth-child(5) { text-align: right; width: 12%; }
        table.inventory td:nth-child(6) { text-align: right; width: 12%; }
        table.inventory td:nth-child(7) { text-align: right; width: 12%; }
        table.inventory td:nth-child(8) { text-align: right; width: 12%; }

        /* table balance */

        table.balance th, table.balance td { width: 50%; }
        table.balance td { text-align: right; }

        /* aside */

        aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
        aside h1 { border-color: #999; border-bottom-style: solid; }
        
        @media print {
          * { -webkit-print-color-adjust: exact; }
          html { background: none; padding: 0; }
          body { box-shadow: none; margin: 0; }
          span:empty { display: none; }
          .print_btn { display: none; }
        }

        @page { margin: 0; }
    </style>
  </head>
  <body>
    <header>
      <h1>Invoice</h1>
      <address >
        <p>SATA</p>
        <p>101 E. Chapman Ave<br>Orange, CA 92866</p>
        <p>(800) 555-1234</p>
      </address>
      <span><img alt="" width="200px" src="{{asset('backend/img/sata logo.png')}}"></span>
    </header>
    <article>
      <h1>Recipient</h1>
      <address >
        <p>{{$buyer_info->buyer_code}}</p>
        <p>{{$buyer_info->first_name}} {{$buyer_info->last_name}}</p>
        <p>{{$buyer_info->address}}</p>
        <p>{{$buyer_info->state}}</p>
        <p>{{$buyer_info->mobile}}</p>
        <p>{{$buyer_info->company}}asd</p>
      </address>
      <table class="meta">
        <tr>
          <th><span >Invoice No</span></th>
          <td><span >{{$invoices[0]->invoice_id}}</span></td>
        </tr>
        <tr>
          <th><span >Date</span></th>
          <td><span >{{date('Y-m-d') }}</span></td>
        </tr>
        {{-- <tr>
          <th><span >Amount Due</span></th>
          <td><span id="prefix" >$</span><span>600.00</span></td>
        </tr> --}}
      </table>
      <table class="inventory" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th><span >Item No</span></th>
            <th><span >Vendor Code</span></th>
            <th><span >Description</span></th>
            <th><span >Quantity</span></th>
            <th><span >Rate</span></th>
            <th><span >Discount</span></th>
            <th><span >Net Total</span></th>
            <th><span >BP Amount</span></th>
            <th><span >Total</span></th>
          </tr>
        </thead>
        <tbody>
          <?php $grand_total = 0; ?>
          @foreach($invoices as $invoice)
          <tr>
            <td><span >{{$invoice->item_no}}</span></td>
            <td><span >{{$invoice->vendor_code}}</span></td>
            <td><span >{{$invoice->description}}</span></td>
            <td><span >{{$invoice->quantity}}</span></td>
            <td><span>$</span><span >{{number_format($invoice->rate,2)}}</span></td>
            <td><span>$</span><span>{{number_format($invoice->discount,2)}}</span></td>
            <td><span>$</span><span>{{number_format($invoice->net_total,2)}}</span></td>
            <td><span>$</span><span>{{round($invoice->buyers_premium_amount,6)}}</span></td>
            <td><span>$</span><span>{{round($invoice->grand_total,6)}}</span></td>
            <?php $grand_total+= $invoice->grand_total; ?>
          </tr>
          @endforeach
        </tbody>
      </table>
      <table class="balance">
        <tr>
          <th><span >Total</span></th>
          <td><span>$</span><span>{{$grand_total}}</span></td>
        </tr>
      {{--   <tr>
          <th><span >Amount Paid</span></th>
          <td><span>$</span><span >{{$grand_total}}</span></td>
        </tr> --}}
  {{--       <tr>
          <th><span >Balance Due</span></th>
          <td><span>$</span><span>600.00</span></td>
        </tr> --}}
      </table>
    </article>
    <div class="print_btn" style="text-align: center;">
      <button class="btn btn-success" onclick="window.print();">PRINT</button>
    </div>
   {{--  <aside>
      <h1><span >Additional Notes</span></h1>
      <div >
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
    </aside> --}}
  </body>
</html>