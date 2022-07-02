<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pay With Paypal</title>
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
</head>
<body>
     <div class="card">
        <h5 class="card-header"></h5>
        <div class="card-body">
            <form method="post" action="processTransaction">
                @csrf 
                <div class="form-row">
                    <div class="form-group col">
                        <label for="inputEmail4">employee_id</label>
                        <input type="text" value="" name="employee_id" class="form-control">
                    </div>
                    <div class="form-group col">
                        <label for="inputEmail4">shipping_id</label>
                        <input type="text" value="" name="shipping_id" class="form-control">
                    </div>
                    <div class="form-group col">
                        <label for="inputEmail4">status</label>
                        <input type="text" value="" name="status" class="form-control">
                    </div>
                </div>
                <input type="submit" class="btn btn-primary m-3" name="payment_mode" value="paypal" >
                <input type="submit" class="btn btn-primary m-3" name="payment_mode" value="placeOrder" >
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
</html>