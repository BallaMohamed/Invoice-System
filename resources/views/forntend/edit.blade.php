@extends('layouts.app')

@section('style')
 <link rel="stylesheet"  href="{{asset('forntend/css/pickadate/classic.css')}}">
  <link rel="stylesheet"  href="{{asset('forntend/css/pickadate/classic.date.css')}}">
   <link rel="stylesheet"  href="{{asset('forntend/css/pickadate/classic.time.css')}}">

   @if(config('app.locale') == 'ar')
      <link rel="stylesheet"  href="{{asset('forntend/css/pickadate/rtl.css')}}">
   @endif
@endsection

@section('content')
 
      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex">{{ __('forntend/forntend.update-invoice') }}
                 <a href="{{route('invoice.index')}}" class="btn btn-primary ml-auto btn-sm"><i class="fa fa-home"></i>{{ __('forntend/forntend.index_invoice') }}</a>
                </div>

                <div class="card-body">
                    <form  action="{{ route('invoice.update' , $invoice->id) }}" method="post" class="form">
                     {{csrf_field()}}

                     @method('PATCH')
                      <div class="row">
                          <div class="col-4">
                            <div class="form-group">
                                <label for="customer-name">{{ __('forntend/forntend.customer-name') }}</label>
                                <input type="text" name="customer-name" class="form-control" value="{{old('customer-name' , $invoice->customer_name)}}">
                                @error('customer-name')<span class="help-block text-danger">{{$message}}</span>@enderror
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label for="customer-email">{{ __('forntend/forntend.customer-email') }}</label>
                                <input type="text" name="customer-email" class="form-control"  value="{{old('customer-email' , $invoice->customer_email)}}">
                                @error('customer-email')<span class="help-block text-danger">{{$message}}</span>@enderror
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label for="customer-mobile">{{ __('forntend/forntend.customer-mobile') }}</label>
                                <input type="text" name="customer-mobile" class="form-control" value="{{old('customer-mobile' , $invoice->customer_mobile)}}">
                                @error('customer-mobile')<span class="help-block text-danger">{{$message}}</span>@enderror
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-4">
                            <div class="form-group">
                                <label for="company-name">{{ __('forntend/forntend.company-name') }}</label>
                                <input type="text" name="company-name" class="form-control" value="{{old('company-name' , $invoice->company_name)}}">
                                @error('company-name')<span class="help-block text-danger">{{$message}}</span>@enderror
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label for="invoice-number">{{ __('forntend/forntend.invoice-number') }}</label>
                                <input type="text" name="invoice-number" class="form-control"  value="{{old('invoice-number' , $invoice->invoice_number)}}">
                                @error('invoice-number')<span class="help-block text-danger">{{$message}}</span>@enderror
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label for="invoice-date">{{ __('forntend/forntend.invoice-date') }}</label>
                                <input type="text" name="invoice-date" class="form-control pickadate" value="{{old('invoice-date' , $invoice->invoice_date)}}">
                                @error('invoice-date')<span class="help-block text-danger">{{$message}}</span>@enderror
                            </div>
                          </div>
                      </div>
                      <div class="table-responsive">
                          <table class="table" id="invoice-details">
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
                                <tr class="cloning_row" id="{{$loop->index}}">
                                  <td>
                                      @if($loop->index == 0)
                                      {{'#'}}
                                      @else
                                       <button type="button" class="btn btn-danger btn-sm delgated-btn"><i class="fa fa-minus"></i></button>
                                      @endif
                                  </td>
                                  <td>
                                      <input type="text" name="product_name[{{$loop->index}}]" id="product-name" class="product-name form-control"  value="{{old('product-name' , $item->product_name)}}">
                                      @error('product-name')<span class="help-block text-danger">{{$message}}</span>@enderror
                                  </td>
                                  <td>
                                      <select name="unit[{{$loop->index}}]" id="unit" class="unit form-control">
                                          <option></option>
                                          <option value="piece" {{$item->unit == 'piece' ? 'selected' : ''}}>{{ __('forntend/forntend.piece') }}</option>
                                          <option value="g" {{$item->unit == 'g' ? 'selected' : ''}}>{{ __('forntend/forntend.gram') }}</option>
                                          <option value="kg" {{$item->unit == 'kg' ? 'selected' : ''}}>{{ __('forntend/forntend.kilo-gram') }}</option>
                                      </select>
                                      @error('unit')<span class="help-block text-danger">{{$message}}</span>@enderror
                                  </td>
                                  <td>
                                      <input type="number" step="0.1" name="quantity[{{$loop->index}}]" id="quantity" class="quantity form-control" value="{{old('quantity' , $item->quantity)}}">
                                      @error('quantity')<span class="help-block text-danger">{{$message}}</span>@enderror
                                  </td>
                                  <td>
                                    <input type="number" step="0.01" name="unit_price[{{$loop->index}}]" id="unit_price" class="unit_price form-control" value="{{old('unit_price' , $item->unit_price)}}">
                                    @error('unit_price')<span class="help-block text-danger">{{$message}}</span>@enderror
                                  </td>
                                  <td>
                                      <input type="number" name="row_sub_total[{{$loop->index}}]" id="row_sub_total" value="0.00" class="row_sub_total form-control" readonly="readonly" value="{{old('row_sub_total' , $item->row_sub_total)}}">
                                      @error('row_sub_total')<span class="help-block text-danger">{{$message}}</span>@enderror
                                  </td>
                                  </tr>
                                  @endforeach
                              </tbody>
                              <tfoot>
                                  <tr>
                                      <td colspan="6">
                                          <button type="button" class="btn-add btn btn-primary"> {{ __('forntend/forntend.add-another-product') }} </button>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td colspan="3"></td>
                                      <td colspan="2">{{ __('forntend/forntend.total') }}</td>
                                      <td><input type="number" name="sub_total" id="sub_total" class="sub_total form-control" readonly="readonly" value="{{old('sub_total' , $invoice->sub_total)}}"></td>
                                  </tr>
                                  <tr>
                                      <td colspan="3"></td>
                                      <td colspan="2"> {{ __('forntend/forntend.discount') }}</td>
                                      <td>
                                        <div class="input-group mb-3">
                                            <select name="discount_type" id="discount_type" class="discount_type custom-select">
                                                <option value="fixed" {{$invoice->discount_type == 'fixed' ? 'selected' : ''}}>SR</option>
                                                <option value="persentage" {{$invoice->discount_type == 'persentage' ? 'selected' : ''}}>{{ __('forntend/forntend.percentage') }}</option>
                                            </select> 
                                            <div class="input-group-append">
                                                <input type="number" step="0.01" name="discount_value" id="discount_value" class="discount_value form-control" value="{{old('discount_value' , $invoice->discount_value)}}">
                                            </div>
                                        </div>
                                      </td>
                                  </tr>
                                   <tr>
                                      <td colspan="3"></td>
                                      <td colspan="2">{{ __('forntend/forntend.vat') }}</td>
                                      <td><input type="number"  step="0.01" name="vat_value" id="vat_value" class="vat_value form-control" readonly="readonly" value="{{old('vat_value' , $invoice->vat_value)}}"></td>
                                  </tr>
                                   <tr>
                                      <td colspan="3"></td>
                                      <td colspan="2">{{ __('forntend/forntend.shipping') }}</td>
                                      <td><input type="number"  step="0.01" name="shipping" id="shipping" class="shipping form-control" value="{{old('shipping' , $invoice->shipping)}}"></td>
                                  </tr>

                                   <tr>
                                      <td colspan="3"></td>
                                      <td colspan="2">{{ __('forntend/forntend.toatl-due') }}</td>
                                      <td><input type="number"  step="0.01" name="total_due" id="total_due" class="total_due form-control" readonly="readonly" value="{{old('total_due' , $invoice->total_due)}}"></td>
                                  </tr>

                              </tfoot>
                          </table>
                      </div>
                      <div class="text-right pt-3">
                          <button type="submit" name="save" class="btn btn-primary">{{ __('forntend/forntend.update') }}</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 
@endsection

@section('script')
<script src="{{asset('forntend/js/pickadate/picker.js')}}"></script>
<script src="{{asset('forntend/js/pickadate/picker.date.js')}}"></script>
<script src="{{asset('forntend/js/pickadate/picker.time.js')}}"></script>
@if(config('app.locale') == 'ar')
   <script src="{{asset('forntend/js/pickadate/ar.js')}}"></script>
@endif
 <script>
     $(document).ready(function(){
        
        $('.pickadate').pickadate({
            format:'yyyy-mm-dd' ,
            selectMonth:true  ,
            selectYear: true ,
            clear: 'Clear' ,
            close: 'Ok' , 
            closeOnSelect:true
        });

        $('#invoice-details').on('keyup blur' , '.quantity' , function(){
            let $row = $(this).closest('tr');
            let quantity = $row.find('.quantity').val() || 0;
            let unit_price = $row.find('.unit_price').val() || 0;
            $row.find('.row_sub_total').val((quantity * unit_price).toFixed(2))

            $('#sub_total').val(sum_total('.row_sub_total'));
            $('#vat_value').val(calculate_vat());
            $('#total_due').val(sum_due_total());
        });

        $('#invoice-details').on('keyup blur' , '.unit_price' , function(){
            let $row = $(this).closest('tr');
            let quantity = $row.find('.quantity').val() || 0;
            let unit_price = $row.find('.unit_price').val() || 0;
            $row.find('.row_sub_total').val((quantity * unit_price).toFixed(2))
             $('#sub_total').val(sum_total('.row_sub_total'));
              $('#vat_value').val(calculate_vat());
            $('#total_due').val(sum_due_total());
        });

        $('#invoice-details').on('keyup blur' , '.discount_type' , function(){
             $('#vat_value').val(calculate_vat());
             $('#total_due').val(sum_due_total());
        });
        $('#invoice-details').on('keyup blur' , '.discount_value' , function(){
            $('#vat_value').val(calculate_vat());
            $('#total_due').val(sum_due_total());
        });
        $('#invoice-details').on('keyup blur' , '.shipping' , function(){
            $('#vat_value').val(calculate_vat());
            $('#total_due').val(sum_due_total());
        });
         
        let sum_total = function ($selector){
            let sum = 0;
            $($selector).each(function ()
            {
               let selectorVal = $(this).val() != '' ? $(this).val() : 0;
               sum += parseFloat(selectorVal);
            });
            return sum.toFixed(2);
        }

        let calculate_vat = function () {
            let sub_totalVal = $('.sub_total').val() || 0;
            let discount_type = $('.discount_type').val();
            let discount_value = parseFloat($('.discount_value').val()) || 0;
            let discountVal = discount_value != 0 ? discount_type == 'persentage' ? sub_totalVal * (discount_value / 100) : discount_value : 0;
            let vatVal = (sub_totalVal -discountVal) * 0.05;
            return vatVal.toFixed(2);
        }

        let sum_due_total = function () {
            let sum = 0;
            let sub_totalVal = $('.sub_total').val() || 0;

            let discount_type = $('.discount_type').val();
            let discount_value = parseFloat($('.discount_value').val()) || 0;
            let discountVal = discount_value != 0 ? discount_type == 'persentage' ? sub_totalVal * (discount_value / 100) : discount_value : 0;
            let vatVal = parseFloat($('.vat_value').val()) || 0;
            let shippingVal =  parseFloat($('.shipping').val() )|| 0;
            sum += sub_totalVal;
            sum -= discountVal;
            sum += vatVal;
            sum += shippingVal;
            return sum.toFixed(2);
        }

        $(document).on('click' , '.btn-add' , function(){
            let trCount = $('#invoice-details').find('tr.cloning_row:last').length;
            let numberIncr = trCount > 0 ? parseInt($('#invoice-details').find('tr.cloning_row:last').attr('id')) + 1 : 0;

            $('#invoice-details').find('tbody').append($('' + 
               '<tr class="cloning_row" id="'+numberIncr+'">' +
               '<td><button type="button" class="btn btn-danger btn-sm delgated-btn"><i class="fa fa-minus"></button></td>'+
               '<td>'+
               '<input type="text" name="product_name[]" id="product-name" class="product-name form-control">'+
               '</td>'+
               ' <td>'+
               '<select name="unit[]" id="unit" class="unit form-control">'+
               '<option></option>' +
               '<option value="piece">Piece</option>'+
               '<option value="g">Gram</option>'+
               '<option value="kg">Kilo Gram</option>'+
               ' </select>'+
               '</td>'+
               '<td>'+
               '<input type="number" step="0.1" name="quantity[]" id="quantity" class="quantity form-control">'+
               '</td>'+
               '<td>'+
               '<input type="number" step="0.1" name="unit_price[]" id="unit_price" class="unit_price form-control">'+
               '</td>'+
               '<td>'+
               '<input type="number" name="row_sub_total[]" id="row_sub_total" value="0.00" class="row_sub_total form-control" readonly="readonly">'+
               '</td>'+
               '</tr>'));
        });
         $(document).on('click' , '.delgated-btn' , function(e){
           e.preventDefault();
           $(this).parent().parent().remove();
            $('#sub_total').val(sum_total('.row_sub_total'));
            $('#vat_value').val(calculate_vat());
            $('#total_due').val(sum_due_total());
         });
     });
 </script>
@endsection