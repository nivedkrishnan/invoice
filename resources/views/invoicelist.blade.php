@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-10">
            <form action="{{route('save.invoice')}}" id="invoice-form" method="post" class="invoice-form" role="form" novalidate="">
                @csrf
                <div class="load-animate animated fadeInUp">
                    <div class="row">
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <h2 class="title">Order List</h2>

                        </div>
                        <br>
                    </div>
                    <input id="currency" type="hidden" value="$">
                    <div class="row">
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-bordered table-hover" id="invoiceItem">
                                <tr>
                                    <th width="15%">order No</th>
                                    <th width="38%">Email</th>
                                    <th width="8%">Print</th>

                                </tr>
                                @foreach($data as $row)
                                <tr>

                                    <td>{{$row->order_id}}</td>
                                    <td>{{ Auth::user()->email }}</td>
                                    <td><a href="{{route('print.pdf', ['id' => $row->order_id])}}" title="Print Invoice"><span class="glyphicon glyphicon-print"></span></a></td>

                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                    <div class="row">


                    <a href="{{ URL::to('/home') }}">Go to Home Page</a></h3>




                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>

        </div>
    </div>
</div>
</div>

@endsection