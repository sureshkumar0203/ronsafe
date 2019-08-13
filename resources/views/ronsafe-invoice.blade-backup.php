<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Ronsafe Invoice</title>
  <style>
      body {
          margin: 0;
          padding: 0;
          font: 12pt "Tahoma";
      }
      p{
          padding:0px;
          margin:0px;
      }
      * {
          box-sizing: border-box;
          -moz-box-sizing: border-box;
      }

      .table{
          border-collapse:collapse; 
          font-size:12px;
      }

      .table thead th {
          vertical-align: bottom;
          /* border-bottom: 1px solid #000;*/
      }

      .table td, .table th {
          padding: .75rem;
          vertical-align: top;
          border-top: 1px solid #00000024;
      }

      .table-striped tbody tr:nth-of-type(odd) {
          background-color: rgba(0,0,0,.05);
      }

      .total{border-top:none; border-bottom:none; text-align: right; border-color:#fff!important;}

      .total2{ text-align: left;}

      .table {
          width: 100%;
          max-width: 100%;
          margin-bottom: 1rem;
          background-color: transparent;
      }

      .btn {
          display: inline-block;
          padding: 6px 20px;
          margin-bottom: 0;
          font-size: 14px;
          font-weight: 400;
          line-height: 1.42857143;
          text-align: center;
          white-space: nowrap;
          vertical-align: middle;
          -ms-touch-action: manipulation;
          touch-action: manipulation;
          cursor: pointer;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
          background-image: none;
          border: 1px solid transparent;
          border-radius: 4px;
          font-weight:bold;
          float:right;
      }
      .page {
          width:96%;
          min-height: 29.7cm;
          padding: 0cm;
          margin: 1cm auto;
          border-radius: 5px;
          background: white;
      }
      .subpage {
          padding: 1cm;
          height:100mm;
      }
      @page {
          size: A4;
          margin: 0;
      }

      .pan{
          float:left; 
          width:33%; 
          border-left:solid 1px #000; 
          padding: 8px 0px;
      }

      .pan2{
          float:left; 
          width:33%;
          padding: 8px 0px;
      }

      address{
          margin-bottom: 1rem;
          font-style: normal;
          line-height:20px;
      }	

      @media print {
          .page {
              margin: 0;
              border: initial;
              border-radius: initial;
              width: initial;
              min-height: initial;
              box-shadow: initial;
              background: initial;
              page-break-after:always;
          }
          .noprint {
              visibility: hidden;
          }
      }
      .no-bdr { 
          border:none;
      }
  </style>
</head>
<body>
  <div class="page">                    
      <div class="subpage">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                  <td>
                      <table width="100%" cellpadding="5"  border="1" id="section_a2" style="border:solid 1px #00000024; border-collapse:collapse; font-size:12px;">
                          <tr>
                              <td colspan="3" align="left" valign="middle">
                                  <img src="https://www.bletechnolabs.com/projects/ronsafe/public/images/logo.png" alt=""/>
                                  <span style="float:right; line-height: 80px; padding-right:20px;">Date:{{ date('d-m-Y') }}</span></td>
                          </tr>
                          <tr style="font-size:12px; line-height:15px;">
                              <td width="33%" height="40" align="left" valign="top">
                                  From
                                  <address>
                                      <strong>Ronsafe</strong><br>
                                      {{ getAdminDetails()->address }}
                                      Phone: {{ getAdminDetails()->contact_no }}<br>
                                      Email: {{ getAdminDetails()->alt_email }}
                                  </address>
                              </td>
                              <td width="33%" align="left" valign="top">
                                  To
                                  <address>
                                      <strong>{{ $getOrderDetails->ship_full_name }}</strong><br>
                                      {{ $getOrderDetails->ship_full_name }}<br>
                                      {{ $getOrderDetails->ship_address1 }}<br>
                                      {{ $getOrderDetails->ship_address2 }}<br>
                                      City : {{ $getOrderDetails->ship_city }},State : {{ $getOrderDetails->ship_state }}<br>Country : {{ $getOrderDetails->ship_country }} Pincode: {{ $getOrderDetails->bill_post_code }}<br>
                                      Phone: {{ $getOrderDetails->ship_phone_number }}<br>
                                      Email: {{ $getOrderDetails->email }}
                                  </address>
                              </td>
                              <td width="33%" align="left" valign="top">
                                  <b>Invoice #pixie{{ $getOrderDetails->id }}</b><br>
                                  <br>
                                  <b>Order ID:</b> {{ $getOrderDetails->id }}<br>
                              </td>
                          </tr>
                      </table></td>
              </tr>
              <tr>
                  <td>&nbsp;</td>
              </tr>
              <tr>
                  <td>
                      <table border="0" cellpadding="0" cellspacing="0" class="table table-striped">
                          <thead>
                              <tr>
                                  <th align="left" valign="middle">SL No.</th>
                                  <th align="left" valign="middle">Product Name</th>
                                  <th align="left" valign="middle">Quantity</th>
                                  <th align="left" valign="middle">Unit Price</th>
                                  <th align="left" valign="middle">Total</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($getOrderDetails->orderItems as $orderItem)
                              <tr>                               
                                  <td align="left" valign="middle">{{ $loop->iteration }}</td>
                                  <td align="left" valign="middle">{{ getProductDetails($orderItem->product_id)->name }}</td>
                                  <td align="left" valign="middle">{{ $orderItem->quantity }}</td>
                                  <td align="left" valign="middle">${{ $orderItem->unit_price }}</td>
                                  <td align="left" valign="middle">${{ $orderItem->total_price }}</td>
                              </tr> 
                              @endforeach
                          </tbody>
                      </table>
                  </td>
              </tr>
              <tr>
                  <td align="right" valign="top" style="border-top:solid 1px #ccc; text-align: right;">

                      <table border="0" class="table" style="width:300px; float:right;">
                          <tbody><tr>
                                  <th align="left" valign="middle" class="total2" style="width:60%; border-top:none; border-bottom:none; text-align: right; ">Subtotal:</th>
                                  <td align="left" valign="middle" class="total total2">${{ number_format($getOrderDetails->orderItems->sum('total_price'),2) }}</td>
                              </tr>
                              <tr>
                                  <th align="left" valign="middle" class="total">Discount</th>
                                  <td align="left" valign="middle" class="total total2">${{ $getOrderDetails->discount_amount }}</td>
                              </tr>
                              <tr>
                                  <th align="left" valign="middle" class="total">Shipping:</th>
                                  <td align="left" valign="middle" class="total total2">${{ $getOrderDetails->shipping_amount ? $getOrderDetails->shipping_amount:"0.00" }}</td>
                              </tr>
                              <tr>
                                  <th align="left" valign="middle" class="total">Total:</th>
                                  <td align="left" valign="middle" class="total total2">${{ $getOrderDetails->total_amount }}</td>
                              </tr>
                          </tbody></table>


                  </td>
              </tr>
              <tr>
                  <td>&nbsp;</td>
              </tr>
              <tr>
                  <td>&nbsp;</td>
              </tr>
              <tr>
                  <td>&nbsp;</td>
              </tr>
          </table>
      </div>
  </div>
</body>
</html>