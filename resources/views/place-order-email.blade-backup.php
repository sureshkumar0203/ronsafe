<table width="100%" style="border:1px solid #EEE; background-color:#FFF; font-size:14px;" cellpadding="0" cellspacing="0">

	<tbody>

		<tr>
        <td style="text-align:center; background:#dbe0fd;">
           <img src="https://www.bletechnolabs.com/projects/ronsafe/public/images/logo.png" width="157"/>
        </td>
    </tr>

		<tr>

			<td>

			<div style="padding:35px; color:#555;">
              Dear <strong>{{ $data['full_name'] }}</strong> ,
              <div style="padding-left:30px; line-height:20px;"><br />
                <strong>Your order placed successfully. Order details as follows</strong><br /><br />
                
                <strong>ORDER ID :</strong> {{ $data['order_id'] }}<br />
                <strong>Transaction ID :</strong> {{ $data['transaction_id'] }}<br /><br /><br />
              </div>
              <strong>Thanks</strong><br />
              <strong>{{ $data['admin_name'] }}</strong><br />
              <strong>{{ $data['admin_email'] }}</strong>
              </div>
			</td>

		</tr>

		<tr>
          <td style="text-align:center; color:#000; background-color:#dbe0fd;" height="35">
              All rights &copy; ronsafett.com.  {{ $data['current_year'] }}
          </td>
        </tr>

	</tbody>

</table>