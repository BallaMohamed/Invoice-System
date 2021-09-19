<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Invoice Number # {{ $invoice_number}}</title>

		<style>
			body{
				font-family: 'XBRiyaz' , 'sans-serif';
			}
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				font-size: 16px;
				line-height: 24px;
				font-family: 'XBRiyaz' , 'sans-serif';
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: 'XBRiyaz' , 'sans-serif';
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
	  @page {
				header: page-header;
				footer: page-footer;
			}

		</style>
	</head>

	<body>
		<div class="invoice-box {{ config('app.locale') == 'ar' ? 'rtl' : ''}}">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="6">
						<table>
							<tr>
								<td class="title">
									<img src="https://www.sparksuite.com/images/logo.png" style="width: 100%; max-width: 300px" />
								</td>

								<td>
									{{ __('forntend/forntend.serial') }} : {{ $invoice_number}} <br>
									{{ __('forntend/forntend.date') }} : {{ $invoice_date}} <br>
									{{ __('forntend/forntend.print_date') }} : {{ Carbon\Carbon::now()->format('Y-m-d')}} <br>		
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center"><h2>{{ __('forntend/forntend.invoice_title') }} #{{$invoice_id}}</h2></td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="6">
						<table>
							<tr>
								<td>
									<h2>{{ __('forntend/forntend.seller') }}</h2>
									    {{ __('forntend/forntend.seller_name') }} <br>
									    <span dir="ltr">{{ __('forntend/forntend.seller_phone') }}</span><br>
									    {{ __('forntend/forntend.seller_vat') }} <br>
									    {{ __('forntend/forntend.seller_address') }}
								</td>

								<td>
									<h2>{{ __('forntend/forntend.buyer') }}</h2>
									@foreach($customer as $key => $val)
                                       {{$key}} : {{$val}} <br>
									@endforeach
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td></td>
                        <td>{{ __('forntend/forntend.product-name') }}</td>
                        <td>{{ __('forntend/forntend.unit') }}</td>
                        <td>{{ __('forntend/forntend.quantity') }}</td>
                        <td>{{ __('forntend/forntend.unit-price') }}</td>
                        <td>{{ __('forntend/forntend.subtotal') }}</td>
				</tr>
                 @foreach($items as $item)
                  <tr class="item {{$loop->last ? 'last' : ''}}">
                  	 <td>{{$loop->iteration}}</td>
                  	 <td>{{$item['product_name']}}</td>
                  	 <td>{{$item['unit']}}</td>
                  	 <td>{{$item['quantity']}}</td>
                  	 <td>{{$item['unit_price']}}</td>
                  	 <td>{{$item['row_sub_total']}}</td>
                  </tr>
                 @endforeach
				<tr class="total">
					<td colspan="4"></td>
                    <td>{{ __('forntend/forntend.subtotal') }}</td>
					<td>{{$sub_total}}</td>
				</tr>
				<tr class="total">
					<td colspan="4"></td>
                    <td>{{ __('forntend/forntend.discount') }}</td>
					<td>{{$discount}}</td>
				</tr>
				<tr class="total">
					<td colspan="4"></td>
                    <td>{{ __('forntend/forntend.vat') }}</td>
					<td>{{$vat_value}}</td>
				</tr>
				<tr class="total">
					<td colspan="4"></td>
                    <td>{{ __('forntend/forntend.shipping') }}</td>
					<td>{{$shipping}}</td>
				</tr>
				<tr class="total">
					<td colspan="4"></td>
                    <td>{{ __('forntend/forntend.toatl-due') }}</td>
					<td>{{$total_due}}</td>
				</tr>
			</table>
		</div>
	</body>
</html>