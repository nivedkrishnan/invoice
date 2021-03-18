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
                            <h2 class="title">Invoice Generating System</h2>

                        </div>
                    </div>
                    <input id="currency" type="hidden" value="$">
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
                            <button class="btn btn-success" id="addRows" type="button">+ Add More</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-bordered table-hover" id="invoiceItem">
                                <tr>
                                    <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                    <th width="15%">Product SKU</th>
                                    <th width="38%">Product Name</th>
                                    <th width="15%">Quantity</th>
                                    <th width="15%">Price</th>
                                    <th width="15%">Total</th>
                                </tr>
                                <tr>
                                    <td><input class="itemRow" type="checkbox"></td>
                                    <td><input type="text" name="productCode[]" id="productCode_1" class="form-control" autocomplete="off" required></td>
                                    <td><input type="text" name="productName[]" id="productName_1" class="form-control" autocomplete="off" required></td>
                                    <td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off" required></td>
                                    <td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off" required></td>
                                    <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row">


                        <div class="col-md-12">
                            <span class="form-inline">
                                <div class="form-group">
                                    <label>Subtotal: &nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-addon currency">$</div>
                                        <input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tax Rate: &nbsp;</label>
                                    <!-- <select name="taxRate" id="taxRate">
                                        <option value="">--Please choose an option--</option>>
                                        <option value="0%">0%</option>
                                        <option value="1%">1%</option>
                                        <option value="5%">5%</option>
                                        <option value="10%">10%</option>
                                    </select> -->
                                    <div class="input-group">
                                        <input value="" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Tax Rate">
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tax Amount: &nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-addon currency">$</div>
                                        <input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Total: &nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-addon currency">$</div>
                                        <input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Discount: &nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-addon currency">$</div>
                                        <input value="" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Discount">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Grand total: &nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-addon currency">$</div>
                                        <input value="" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Grand Total">
                                    </div>
                                </div>


                            </span>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">

                            <br>
                            <div class="form-group">
                                <input type="hidden" value="{{ auth()->user()->id }}" class="form-control" name="userId" id="userId">
                                <input data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" value="Generate Invoice" class="btn btn-success submit_btn invoice-save-btm" id="save">
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>

        </div>
    </div>
</div>
</div>
<script>
    // $(document).on('click', '#save', function(){
    //     var product = $("#productCode_'+count+'").val();
    //     alert(product); 
    // });
    $("#invoice-form").submit(function() {
        console.log($(this).serializeArray());
    });
</script>
@endsection