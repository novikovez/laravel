<!DOCTYPE html>
<html>
<head>
    <title>Оплата через PayPal</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script
        src="https://www.paypal.com/sdk/js?client-id=AbvGc0DFDQR83Ry_C1GBwH9tFmLkIh_EwCPO7aYFkzT5iujxRQ-P6HsHQJBjTY04WMGGrp2QJCssANGl"></script>
</head>
<body>
<h1>Оплата через PayPal</h1>
<div id="payment-result"></div>
<button onclick="payWithPaypal()">Здійснити оплату</button>

<script>
    function payWithPaypal() {
        paypal.Buttons({
            createOrder() {
                return fetch("/api/payment/makePayment/1", {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiZTVkYWRlNzc5NWI3NTdmYWI5ODYzNTkwMWQ1N2VjYTQyNjI4ZTk4YWIwNTU3ZDNkOTZmYmM5ZWZhMjZmMjBhODdhYzk4YTQyZDg2NDk4NTgiLCJpYXQiOjE2OTEzNDQzMzMuNTQ0NzYsIm5iZiI6MTY5MTM0NDMzMy41NDQ3NywiZXhwIjoxNzIyOTY2NzMzLjUzNzIyNiwic3ViIjoiMiIsInNjb3BlcyI6W119.rwl1xmjxUOugo2_Ht8s7WcGFgn8ZZxgh_ES_XwJQs8tcTr9Zj5Oqoa6Gq1yn4_8klmgLmMjRfkxlZJGJHFCCcEmHURdMKAPpUNYNyovFbx-MfT5uXE_GuSE0d5SW65SJmGogpgilHecfcluoa4poj5soMfKYxTZYR4cRFW3viGXvE8sihE1wdwiicSOTYuYq6OrowLjp6v1MoklDDjNhcTAxFiyjn3vATgWGPSCblHNTF1edxWhh4bx5A-qj2wOKXr3AAC3Q4CY8xzDGcxlBj2dd5K2xjNrvyzos8utrJ84bK9szQAsREEh2P3faYK42ffLWdLFTvFvcR9d0Y4-gG3_ECImmgyYxKz9-GK-O2R0ohJKoZ0npqj0b3-ig1gVsEMq9ls-tP9JJArbUDIrws2Dk0W2kbIJlroz94lF68P6UfyWIR3fj4iSmjw-kAdki2Nonwntr_YF2-a2X39okj8HgkYqTzScE2nywYGiYUVESvKJ7OyNoYdilyeTwqUwDyJmGqdX7_aE3UIAH4DMU6N0QnuxUCoaYzGnGh0lfjorq6Gw4oBYYOSSQcB6UE6SY8QeoFAfpuaG9GjH_q3NbYvNdTiZ5CZ5UFkfs8L3kbHEyVN9895GT3uAN3R57wBhDPIpoyrTL9O2E39f1MbxGrq6mflIR9qkTlhyRZMuEnW0",
                    },
                })
                    .then(function (response) {
                        return response.json()
                    })
                    .then(function (data) {
                        console.log(data.order.id)
                        return data.order.id
                    });
            },
            onApprove: function (data, actions) {
                executePaypalPaymentOnBackend(data.orderID);
            }
        }).render('body');
    }

    function executePaypalPaymentOnBackend(paypalToken) {
        axios.post('/api/payment/confirm/1', {paymentId: paypalToken}, {
            headers: {
                "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiZTVkYWRlNzc5NWI3NTdmYWI5ODYzNTkwMWQ1N2VjYTQyNjI4ZTk4YWIwNTU3ZDNkOTZmYmM5ZWZhMjZmMjBhODdhYzk4YTQyZDg2NDk4NTgiLCJpYXQiOjE2OTEzNDQzMzMuNTQ0NzYsIm5iZiI6MTY5MTM0NDMzMy41NDQ3NywiZXhwIjoxNzIyOTY2NzMzLjUzNzIyNiwic3ViIjoiMiIsInNjb3BlcyI6W119.rwl1xmjxUOugo2_Ht8s7WcGFgn8ZZxgh_ES_XwJQs8tcTr9Zj5Oqoa6Gq1yn4_8klmgLmMjRfkxlZJGJHFCCcEmHURdMKAPpUNYNyovFbx-MfT5uXE_GuSE0d5SW65SJmGogpgilHecfcluoa4poj5soMfKYxTZYR4cRFW3viGXvE8sihE1wdwiicSOTYuYq6OrowLjp6v1MoklDDjNhcTAxFiyjn3vATgWGPSCblHNTF1edxWhh4bx5A-qj2wOKXr3AAC3Q4CY8xzDGcxlBj2dd5K2xjNrvyzos8utrJ84bK9szQAsREEh2P3faYK42ffLWdLFTvFvcR9d0Y4-gG3_ECImmgyYxKz9-GK-O2R0ohJKoZ0npqj0b3-ig1gVsEMq9ls-tP9JJArbUDIrws2Dk0W2kbIJlroz94lF68P6UfyWIR3fj4iSmjw-kAdki2Nonwntr_YF2-a2X39okj8HgkYqTzScE2nywYGiYUVESvKJ7OyNoYdilyeTwqUwDyJmGqdX7_aE3UIAH4DMU6N0QnuxUCoaYzGnGh0lfjorq6Gw4oBYYOSSQcB6UE6SY8QeoFAfpuaG9GjH_q3NbYvNdTiZ5CZ5UFkfs8L3kbHEyVN9895GT3uAN3R57wBhDPIpoyrTL9O2E39f1MbxGrq6mflIR9qkTlhyRZMuEnW0",
            }
        })
            .then(function (response) {
                alert(response.statusText)
            })
            .catch(function (error) {
                console.error('Помилка при виконанні оплати через PayPal на бекенді: ', error);
            });
    }
</script>
</body>
</html>
