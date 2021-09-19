@extends('layouts.app')

@section('content')
 
      <div class="row justify-content-center">
        <div class="col-md-12">
        	<div class="card">
                <div class="card-header d-flex">
                  <h5>{{ __('forntend/forntend.invoices') }}</h5>
                  <a href="{{route('invoice.create')}}" class="btn btn-primary ml-auto btn-sm"><i class="fa fa-plus"></i>{{ __('forntend/forntend.add_invoice') }}</a>
                </div>
                   <div class="table-responsive">
                    <table class="table card-table">
                      <thead>
                        <tr>
                          <th>{{ __('forntend/forntend.customer-name') }}</th>
                          <th>{{ __('forntend/forntend.invoice-date') }}</th>
                          <th>{{ __('forntend/forntend.toatl-due') }}</th>
                          <th>{{ __('forntend/forntend.actions') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($invoices as $invoice)
                          <tr>
                            <td><a href="/invo/{{$invoice->id}}/show">{{$invoice->customer_name}}</a></td>
                            <td>{{$invoice->invoice_date}}</td>
                            <td>{{$invoice->total_due}}</td>
                            <td>
                                <form action="/invoice/{{$invoice->id}}" method="post">
                                      @method('DELETE')
                                      @csrf
                                      <a href="/invoice/{{$invoice->id}}/edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                      <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="4">
                            <div class="float-right">
                               {{ $invoices->links('pagination::bootstrap-4') }}
                            </div>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                    </div>
            </div>
        </div>
    </div>
 
@endsection