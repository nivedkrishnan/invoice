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
        $order = new Order;
        // user id
        $order->user_id = Auth()->id();
        // order id generate
        $latestOrder = Invoice::orderBy('created_at', 'DESC')->first();
        if (isset($latestOrder)) {
            $order->order_id = str_pad($latestOrder->id + 1, 8, "order", STR_PAD_LEFT);
        } else {
            $order->order_id = 'orderor1';
        }
        // print_r($data);
        // exit();
        $products = $request->productName;
        $quantity = $request->quantity;
        $price = $request->price;
        $total = $request->total;

        // save product and invoice
        $count_product = count($products);
        for ($i = 0; $i < $count_product; $i++) {
            if ($products[$i] == '') {
                return Redirect::back()->withErrors(['Product Field is empty']);
            } elseif ($quantity[$i] == '') {
                return Redirect::back()->withErrors(['Product Quantity Field are empty']);
            } elseif ($price[$i] == '') {
                return Redirect::back()->withErrors(['Product Price Field are empty']);
            } elseif ($total[$i] == '') {
                return Redirect::back()->withErrors(['Product Total Field are empty']);
            } else {
                $newInvoice = new Invoice();
                $newInvoice->product = $products[$i];
                $newInvoice->quantity = $quantity[$i];
                $newInvoice->price = $price[$i];
                $newInvoice->total_amount = $total[$i];
                $newInvoice->user_id = $request->userId;
                $newInvoice->order_id = $order->order_id;
                $newInvoice->save();
            }
        }
        // save orders in order model



        if ($request->subTotal == '') {
            return Redirect::back()->withErrors(['Subtotal Field is empty']);
        } elseif ($request->taxAmount == 0) {
            return Redirect::back()->withErrors(['Tax Amount Field are empty']);
        }
        // elseif ($request->discount == '') {
        //     return Redirect::back()->withErrors(['Discount Price Field are empty']);
        // }
        elseif ($request->total == '') {
            return Redirect::back()->withErrors(['Total Field are empty']);
        } elseif ($request->grand_total == '') {
            return Redirect::back()->withErrors(['Grand Total Field are empty']);
        } else {

            $order->subtotal = $request->subTotal;
            $order->tax_amount = $request->taxAmount;
            $order->discount = $request->discount;
            $order->mrp_total = $request->total;
            $order->grand_total = $request->grand_total;
            $order->save();
        }


        return redirect::to('/invoice-list');
    }
}
