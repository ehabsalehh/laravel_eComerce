<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pay With Paypal</title>
    {{-- <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script> --}}
</head>
<body>    
     <div class="card">
        <h5 class="card-header"></h5>
        <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                    @if(is_array($orderPrice))
                    <form method="post" action="placeOrder">
                        @csrf 
                        <div class="shipping form-group col">
                            <label >Shipping Cost</label>
                                <select name="shipping_id" id="menu" class="form-select nice-select" aria-label="Default select example">
                                    <option value="">Select your address</option>
                                    @foreach($shippings as $shipping)
                                    <option value="{{$shipping->id}}" class="shippingOption" data-price="{{$shipping->price}}">{{$shipping->name}}:{{$shipping->price}}$</option>
                                    @endforeach
                                </select> 
                                    <input id="total" type="hidden" name="total"value="{{$orderPrice['total']}}" data-price="{{$orderPrice['total']}}"> 
                                    <input class="sub_total" type="hidden" name="sub_total"value="{{$orderPrice['sub_total']}}" data-price="{{$orderPrice['sub_total']}}"> 
                                    <input class="total_discount" type="hidden" name="total_discount"value="{{$orderPrice['total_discount']}}" data-price="{{$orderPrice['total_discount']}}">
                                    <input id="coupon" type="hidden" name="coupon"value="{{$orderPrice['coupon']}}" data-price="{{$orderPrice['coupon']}}"> 
                                
                        </div>
                        <input type="submit" class="form-control" name="payment_mode" value="placeOrder" ><br>
                        <div id="paypal-button-container"></div>
                    </form>
                    @endif
                </div>
              </div>
            </div>
            {{-- coupon store --}}
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
     @if(\Session::has('error'))
        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
        {{ \Session::forget('error') }}
    @endif
    @if(\Session::has('success'))
        <div class="alert alert-success">{{ \Session::get('success') }}</div>
        {{ \Session::forget('success') }}
    @endif
</body>
 <!-- Include the PayPal JavaScript SDK -->
  <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
  <script type="text/javascript" src="{{ URL::asset('js/placeOrder.js') }}"></script>
</html>