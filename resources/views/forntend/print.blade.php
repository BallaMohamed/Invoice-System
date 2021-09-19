@extends('layouts.print')

@section('content')
 
      <div class="row justify-content-center">
        <div class="col-md-12">
        	<div class="card">
                <div class="card-header d-flex">
                    <h5>{{ __('forntend/forntend.showinvoice') }} <span> # {{$invoice->invoice_number}}</span></h5>
                </div>

                <div class="card-body">
                   <div class="table-responsive">
                       <table class="table">
                        <tr>
                            <th>{{ __('forntend/forntend.customer-name') }}</th>
                            <td>{{$invoice->customer_name}}</td>
                            <th>{{ __('forntend/forntend.customer-email') }}</th>
                            <td>{{$invoice->customer_email}}</td>
                        </tr>
                         <tr>
                            <th>{{ __('forntend/forntend.customer-mobile') }}</th>
                            <td>{{$invoice->customer_mobile}}</td>
                            <th>{{ __('forntend/forntend.company-name') }}</th>
                            <td>{{$invoice->company_name}}</td>
                        </tr>
                         <tr>
                            <th>{{ __('forntend/forntend.invoice-number') }}</th>
                            <td>{{$invoice->invoice_number}}</td>
                            <th>{{ __('forntend/forntend.invoice-date') }}</th>
                            <td>{{$invoice->invoice_date}}</td>
                        </tr>
                           
                       </table>

                       <h2>{{ __('forntend/forntend.invoice-details') }}</h2>
                       <table class="table">
                           <thead>
                               <tr>
                                   <th></th>
                                   <th>{{ __('forntend/forntend.product-name') }}</th>
                                   <th>{{ __('forntend/forntend.unit') }}</th>
                                   <th>{{ __('forntend/forntend.quantity') }}</th>
                                   <th>{{ __('forntend/forntend.unit-price') }}</th>
                                   <th>{{ __('forntend/forntend.subtotal') }}</th>
                               </tr>
                           </thead>
                           <tbody>
                                @foreach($invoice->InvoiceDetails as $item)
                                 <tr>
                                     <td>{{$loop->iteration}}</td>
                                     <td>{{$item->product_name}}</td>
                                     <td>{{$item->unitText()}}</td>
                                     <td>{{$item->quantity}}</td>
                                     <td>{{$item->unit_price}}</td>
                                     <td>{{$item->row_sub_total}}</td>
                                 </tr>
                                @endforeach
                           </tbody>
                           <tfoot>
                               <tr>
                                   <td colspan="3"></td>
                                   <th colspan="2">{{ __('forntend/forntend.total') }}</th>
                                   <td>{{$invoice->sub_total}}</td>
                               </tr>
                               <tr>
                                   <td colspan="3"></td>
                                   <th colspan="2">{{ __('forntend/forntend.discount') }}</th>
                                   <td>{{$invoice->discountResult()}}</td>
                               </tr>
                               <tr>
                                   <td colspan="3"></td>
                                   <th colspan="2">{{ __('forntend/forntend.vat') }}</th>
                                   <td>{{$invoice->vat_value}}</td>
                               </tr>
                               <tr>
                                   <td colspan="3"></td>
                                   <th colspan="2">{{ __('forntend/forntend.shipping') }}</th>
                                   <td>{{$invoice->shipping}}</td>
                               </tr>
                               <tr>
                                   <td colspan="3"></td>
                                   <th colspan="2">{{ __('forntend/forntend.toatl-due') }}</th>
                                   <td>{{$invoice->total_due}}</td>
                               </tr>
                           </tfoot>
                       </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
 
@endsection

@section('script')
 <script>
    window.print();
 </script>
@endsection