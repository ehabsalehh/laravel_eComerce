
    var total = document.getElementById('total').value ;
    var select = document.getElementById('menu');
    var shippingPrice = select.options[select.selectedIndex].getAttribute("data-price");
 
    // Render the PayPal button into #paypal-button-container
     paypal.Buttons({
         // Set up the transaction
         createOrder: function(data, actions) {

            return actions.order.create({
                
                 purchase_units: [{
                     amount: {
                         value: total

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
                        'payment_mode':'paidWithPaypal',

                    },
                    success: function(Response){
                        swal(Response.status);
                        window.location.href = '/createTransaction'
                    },
                });
             });
         }


     }).render('#paypal-button-container');