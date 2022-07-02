<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pay With Paypal</title>
    {{-- <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script> --}}
</head>
<body>
    {{-- {{dd($orderPrice['total'])}} --}}
     <div class="card">
        <h5 class="card-header"></h5>
        <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                    <form method="post" action="placeOrder">
                        @csrf 
                        <div class="form-group col">
                            <label for="inputEmail4">employee_id</label>
                            <input type="text" value="" name="employee_id" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label >shipping_id</label>
                            <input type="text" value="" name="shipping_id" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label >status</label>
                            <input type="text" value="" name="status" class="form-control">
                        </div>
                        <div class="shipping form-group col">
                            <label >Shipping Cost</label>
                            @if(count(Helper::shipping())>0)
                                    <select name="shipping" class="form-select nice-select" aria-label="Default select example">
                                        <option value="">Select your address</option>
                                        @foreach(Helper::shipping() as $shipping)
                                        <option value="{{$shipping->id}}" class="shippingOption" data-price="{{$shipping->price}}">{{$shipping->name}}:{{$shipping->price}}$</option>
                                        @endforeach
                                    </select>
                                @else 
                                    <span>Free</span>
                                @endif
                                
                                @if(count($orderPrice)>0)
                                    <input class="total" type="hidden" name="total"value="{{$orderPrice['total']}}" data-price="{{$orderPrice['total']}}"> 
                                    <input class="sub_total" type="hidden" name="sub_total"value="{{$orderPrice['sub_total']}}" data-price="{{$orderPrice['sub_total']}}"> 
                                    <input class="total_discount" type="hidden" name="total_discount"value="{{$orderPrice['total_discount']}}" data-price="{{$orderPrice['total_discount']}}">
                                @endif
                        </div>
                        {{-- @php
                           $shippingPrice= Helper::getShippingPrice($shipping->id)->price;
                           echo $shippingPrice;
                        @endphp --}}

        
                        <input type="submit" class="form-control" name="payment_mode" value="placeOrder" ><br>
                        <div id="paypal-button-container"></div>
                    </form>
                </div>
              </div>
            </div>


            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                    <form action="{{route('couponStore')}}" method="POST">
                        @csrf
                        <input name="code" placeholder="Enter Your Coupon">
                        <button class="btn">Apply</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
            </form>
        </div> 
    
     {{-- <a class="btn btn-primary m-3" href="{{ route('processTransaction') }}">Pay With PayPal</a> --}}
    @if(\Session::has('error'))
        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
        {{ \Session::forget('error') }}
    @endif
    @if(\Session::has('success'))
        <div class="alert alert-success">{{ \Session::get('success') }}</div>
        {{ \Session::forget('success') }}
    @endif
</body>
<script>
    // $(document).ready(function(){
    //     $('.shipping select[name=shipping]').change(function(){
    //         let shippingPrice = parseFloat( $(this).find('option:selected').data('price') ) || 0;
    //         let total = parseFloat( $('.total').data('price') );
    //         var totalWithShipping = total +shippingPrice; 
    //         // alert(coupon);
    //         $('#total').text('$'+(totalWithShipping).toFixed(2));
    //     });

    // });

    // $('.shipping select[name=shipping]').change(function(){
    //         var shippingPrice = parseFloat( $(this).find('option:selected').data('price') ) || 0;
    //         var total = parseFloat( $('.total').data('price') );
    //         var totalWithShipping = total +shippingPrice;
    // });
    $(".shipping").on('change', "select[select[name=shipping]]", function() {

    $var shippingPrice = $(this).find('option:selected').data('price')  || 0;
    // $row.find("input[id^='item_price']").val( $(this).find('option:selected').data("price") );

});
</script>


 <!-- Include the PayPal JavaScript SDK -->
 <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>

 <script>
     // Render the PayPal button into #paypal-button-container
     paypal.Buttons({

         // Set up the transaction
         createOrder: function(data, actions) {
             return actions.order.create({
                 purchase_units: [{
                     amount: {
                         value: shippingPrice
                     }
                 }]
             });
         },

         // Finalize the transaction
         onApprove: function(data, actions) {
             return actions.order.capture().then(function(orderData) {
                 // Successful capture! For demo purposes:
                 console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                 var transaction = orderData.purchase_units[0].payments.captures[0];
                 alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                var employee = $('.employee_id').val();
                var shipping = $('.shipping_id').val();
                var status = $('.status').val();

                 $.ajax({
                    type: "POST",
                    url: '/placeOrder',
                    data: {
                        'employee_id':employee,
                        'shipping_id':shipping,
                        'status':status,
                        'employee_id':employee,
                        'payment_mode':'paid with paypal',

                    },
                    success: function(Response){
                        swal(Response.status);
                        window.location.href = '/createTransaction'
                    },
                });
                 // Replace the above to show a success message within this page, e.g.
                 // const element = document.getElementById('paypal-button-container');
                 // element.innerHTML = '';
                 // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                 // Or go to another URL:  actions.redirect('thank_you.html');
             });
         }


     }).render('#paypal-button-container');
 </script>

</html>