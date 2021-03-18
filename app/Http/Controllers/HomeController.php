<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Order;
use Illuminate\Support\Facades\Redirect;
use PDF;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function saveInvoice(Request $request)
    {
        $products = $request->productName;
        $quantity = $request->quantity;
        $price = $request->price;
        $total = $request->total;
        
        $order = new Order;

        $order->user_id = Auth()->id();
        $latestOrder = Invoice::orderBy('created_at', 'DESC')->first();
        if(isset($latestOrder)){
            $order->order_id = str_pad($latestOrder->id + 1, 8, "order", STR_PAD_LEFT);
        }else{
            $order->order_id = 'orderor1';
        }
        
        $order->subtotal = $request->subTotal;
        $order->tax_amount = $request->taxAmount;
        $order->discount = $request->amountPaid;
        $order->mrp_total = $request->totalAftertax;
        $order->grand_total = $request->amountDue;
        $order->save();

        $count_product = count($products);
        for ($i = 0; $i < $count_product; $i++) {
            $newInvoice = new Invoice();
            $newInvoice->product = $products[$i];
            $newInvoice->quantity = $quantity[$i];
            $newInvoice->price = $price[$i];
            $newInvoice->total_amount = $total[$i];
            $newInvoice->user_id = $request->userId;
            $newInvoice->order_id = $order->order_id;
            $newInvoice->save();
        }
        

        return redirect::to('/invoice-list');
    }
}
