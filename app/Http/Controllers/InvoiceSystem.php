<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invoice;
Use App\Models\InvoiceDetail;
use Illuminate\Pagination\Paginator;
use PDF;

class InvoiceSystem extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::orderBy('id' , 'desc')->paginate(10);
        return view('forntend.index' , compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forntend.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 
        $data['customer_name']  =  request('customer-name');
        $data['customer_email']  = request('customer-email');
        $data['customer_mobile'] = request('customer-mobile');
        $data['company_name']   = request('company-name');
        $data['invoice_number'] = request('invoice-number');
        $data['sub_total']      = request('sub_total');
        $data['invoice_date']   = request('invoice-date');
        $data['discount_type']  = request('discount_type');
        $data['discount_value'] = request('discount_value');
        $data['vat_value']      = request('vat_value');
        $data['shipping']       = request('shipping');
        $data['total_due']      = request('total_due');
        $invoice = Invoice::create($data);

        $details_list = [] ;

        for($i = 0 ; $i < count($request->product_name) ; $i++)
        {
          $details_list[$i]['product_name'] = $request->product_name[$i];
          $details_list[$i]['unit']         = $request->unit[$i];
          $details_list[$i]['quantity']     = $request->quantity[$i];
          $details_list[$i]['unit_price']   = $request->unit_price[$i];
          $details_list[$i]['row_sub_total']= $request->row_sub_total[$i];    
        }

        $details = $invoice->InvoiceDetails()->createMany($details_list);

        return redirect('/invoice');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $invoices = Invoice::orderBy('id' , 'desc')->paginate(10);
        return view('forntend.index' , compact('invoices'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::find($id);
        return view('forntend.edit' , compact('invoice'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $invoice = Invoice::whereId($id)->first();
        $data['customer_name']  =  request('customer-name');
        $data['customer_email']  = request('customer-email');
        $data['customer_mobile'] = request('customer-mobile');
        $data['company_name']   = request('company-name');
        $data['invoice_number'] = request('invoice-number');
        $data['sub_total']      = request('sub_total');
        $data['invoice_date']   = request('invoice-date');
        $data['discount_type']  = request('discount_type');
        $data['discount_value'] = request('discount_value');
        $data['vat_value']      = request('vat_value');
        $data['shipping']       = request('shipping');
        $data['total_due']      = request('total_due');
        $invoice->update($data);
        
        $invoice->InvoiceDetails()->delete();

        $details_list = [] ;

        for($i = 0 ; $i < count($request->product_name) ; $i++)
        {
          $details_list[$i]['product_name'] = $request->product_name[$i];
          $details_list[$i]['unit']         = $request->unit[$i];
          $details_list[$i]['quantity']     = $request->quantity[$i];
          $details_list[$i]['unit_price']   = $request->unit_price[$i];
          $details_list[$i]['row_sub_total']= $request->row_sub_total[$i];    
        }

        $details = $invoice->InvoiceDetails()->createMany($details_list);

        return redirect('/invoice');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $invoice = Invoice::find($id);
       $invoice->delete();
       return redirect('/invoice');
    }

    public function dispaly($id)
    {
        $invoice = Invoice::find($id);
        return view('forntend.dispaly' , compact('invoice'));
    }

    public function print($id)
    {
        $invoice = Invoice::find($id);
        return view('forntend.print' , compact('invoice'));  
    }

    public function pdf($id)
    {
        $invoice = Invoice::find($id);

        $data['invoice_id']        = $invoice->id;
        $data['invoice_date']      = $invoice->invoice_date;
        $data['customer']          = [
            __('forntend/forntend.customer-name')   => $invoice->customer_name,
            __('forntend/forntend.customer-email')  => $invoice->customer_email,
            __('forntend/forntend.customer-mobile') => $invoice->customer_mobile,  

        ];

        $items = [];

        foreach ($invoice->InvoiceDetails()->get() as $item) {
            $items[] = [

                'product_name'    => $item->product_name,
                'unit'            => $item->unitText() ,
                'quantity'        => $item->quantity,
                'unit_price'      => $item->unit_price,
                'row_sub_total'   => $item->row_sub_total,
            ];
        }

        $data['items']            = $items;
        $data['invoice_number']   = $invoice->invoice_number;
        $data['created_at']       = $invoice->created_at->format('Y-m-d');
        $data['sub_total']        = $invoice->sub_total;
        $data['discount']         = $invoice->discountResult();
        $data['vat_value']        = $invoice->vat_value;
        $data['shipping']         = $invoice->shipping;
        $data['total_due']        = $invoice->total_due;

        $pdf = PDF::loadView('forntend.pdf', $data);
        return $pdf->stream($invoice->invoice_number .'.pdf');


        

        //return view('forntend.pdf' , compact('invoice'));
    }
}
