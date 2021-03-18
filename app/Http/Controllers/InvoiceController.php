<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Order;
use PDF;

class InvoiceController extends Controller
{
    public function invoiceDisplay()
    {
        $userId = Auth()->id();
        //    echo $userId;
        $data = Order::where('user_id', $userId)
            ->get();
        // print_r($data);exit(); 
        return view('invoicelist')->with('data', $data);
    }
    public function printPdf($orderId)
    {
        // echo $id;
        $orders = Invoice::where('order_id', $orderId)->get();
        $totalOrder = Order::where('order_id', $orderId)->first();
        // print_r($totalOrder->subtotal);
        // exit();
        $arrraydata = array('orders' => $orders, 'totalOrder' => $totalOrder);
        json_encode($arrraydata);
        view()->share($arrraydata);
        $pdf = PDF::loadView('invoice');
        return $pdf->download('invoice.pdf');
    }
}
