<!-- 
    api key :-
    rzp_test_qScTznNfxHjAQP -->
<!-- 
        
        id[int], name[var], amount[int], payment_status[var] , payment_id[var] , added_on[dateandtime] (kub wo transection huwa he)  -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<form action="">
    <input type="textbox" name="name" id="name" placeholder="Enter name"><br /><br />
    <input type="textbox" name="amt" id="amt" placeholder="Enter Amount"><br /><br />
    <input type="button" name="btn" id="btn" value="Pay Now" onclick="pay_now()"><br /><br />
</form>

<script>
    function pay_now() {
        var name = jQuery('#name').val();
        var amt = jQuery('#amt').val();

        var options = {
            "key": "rzp_test_qScTznNfxHjAQP",
            "amount": amt * 100, //jetla pasisa hoi tena * 100 nakhvana 500 hoi to 50000 nakhva
            "currency": "INR",
            "name": "BUS PASS ", //your business name
            "description": "Test Transaction",
            "image": "../img/buslogo.png",

            "handler": function(response) {
                console.log(response);
                //databasr ma nakhva mate
                jQuery.ajax({
                    type: 'post',
                    url: 'payment_process.php',
                    data: "payment_id" + response.razorpay_payment_id + "&amt= " + amt + "&name" + name,
                    success: function(result) {
                        window.location.href = "passformate.php";
                    }
                })
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
        // e.preventDefault();
    }
</script>



<!-- <button id="rzp-button1">Pay</button> -->
<!-- <script>
    var options = {
        "key": "rzp_test_qScTznNfxHjAQP", 
        "amount": "50000", //jetla pasisa hoi tena * 100 nakhvana 500 hoi to 50000 nakhva
        "currency": "INR",
        "name": "BUS PASS  ", //your business name
        "description": "Test Transaction",
        "image": "../img/buslogo.png",
        // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        // "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",
        // "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
        //     "name": "Gaurav Kumar", //your customer's name
        //     "email": "gaurav.kumar@example.com",
        //     "contact": "9000090000" //Provide the customer's phone number for better conversion rates 
        // },
        // "notes": {
        //     "address": "Razorpay Corporate Office"
        // },
        // "theme": {
        //     "color": "#3399cc"
        // }
        "handler": function(response) {
            console.log(response);
        }
    };
    var rzp1 = new Razorpay(options);
    document.getElementById('rzp-button1').onclick = function(e) {
        rzp1.open();
        e.preventDefault();
    }
</script> -->