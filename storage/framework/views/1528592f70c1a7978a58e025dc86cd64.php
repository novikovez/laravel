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
                    data: "total: 10",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNTViNWZkMTg3ZjEwMzBhNTMwNGIwZTRkMDllMDZjZTc3NGIzYmYzODk3ZjA5NzAzZTBlNTQzMzYyZDEyZmQ4MjRlOGQ4NWU2Y2I2NTc2YWQiLCJpYXQiOjE2OTI0NTk4MTguMDE4MzIzLCJuYmYiOjE2OTI0NTk4MTguMDE4MzM0LCJleHAiOjE3MjQwODIyMTguMDEzMiwic3ViIjoiMSIsInNjb3BlcyI6W119.mfyCF8deuKaYANqBJZISF-XwgvX3ISNwYVPDErzlyF12AUUlOart4KFf8fPozWzI0wrYZPx86kHRnoUIEjOOcgIscChMF9umQO-H8HrgrA4depksdRjmUUs6udL2A7FkJ_nGGbYrtRYIWZAr51_5hUnFfvThcSOFcBcqJuraOAWZVvi8vnP12JvRmW-vkxjq3Iip7b6Kr10cb4DMkzGtmnFMquTqVVMoGCqPARrGWRxPaGT4dGbaqBkPZnEPByE8Jmw2LNmuLqqVT63Ow4m_wApVQ6gWRMPCyx03gQoAOA98j-SUKTZheo8GBNkTaIqewvl2CsZcWtgp_ImTKDcvDj_kyFhmZEshYMsH5une8T4a1BEG37c8p_A0h5YURwzUgkxtc39sf118WRzIdZ0QtbIpbUAO7kKOjIDzgA6RMiqWzqI8uwqbNDbq7MwNYuHq7AL5qmYp2kwuLtfMhVl4DahxzAeWTaV_rZQCERZyBU34haLJ41NXGoPgCfkCBRedknSz0h_WNoqi0GHq-D7dLVhNJIXJz87Dfm6z8AedenoudiZ3wZFVCGoeSXUJDRNc3Qk9QNzj9c9xX7AwjNuSyv7UW0IzMqg6PEqW2UgHLTPg5bMlKcXr7kGHSuLUteYvVmkYZ2POh2RVx_BDipe2QagySqTDwVgNMci-JEnva1Y",
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
        axios.post('/api/payment/confirm/1', {order_id: paypalToken}, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNTViNWZkMTg3ZjEwMzBhNTMwNGIwZTRkMDllMDZjZTc3NGIzYmYzODk3ZjA5NzAzZTBlNTQzMzYyZDEyZmQ4MjRlOGQ4NWU2Y2I2NTc2YWQiLCJpYXQiOjE2OTI0NTk4MTguMDE4MzIzLCJuYmYiOjE2OTI0NTk4MTguMDE4MzM0LCJleHAiOjE3MjQwODIyMTguMDEzMiwic3ViIjoiMSIsInNjb3BlcyI6W119.mfyCF8deuKaYANqBJZISF-XwgvX3ISNwYVPDErzlyF12AUUlOart4KFf8fPozWzI0wrYZPx86kHRnoUIEjOOcgIscChMF9umQO-H8HrgrA4depksdRjmUUs6udL2A7FkJ_nGGbYrtRYIWZAr51_5hUnFfvThcSOFcBcqJuraOAWZVvi8vnP12JvRmW-vkxjq3Iip7b6Kr10cb4DMkzGtmnFMquTqVVMoGCqPARrGWRxPaGT4dGbaqBkPZnEPByE8Jmw2LNmuLqqVT63Ow4m_wApVQ6gWRMPCyx03gQoAOA98j-SUKTZheo8GBNkTaIqewvl2CsZcWtgp_ImTKDcvDj_kyFhmZEshYMsH5une8T4a1BEG37c8p_A0h5YURwzUgkxtc39sf118WRzIdZ0QtbIpbUAO7kKOjIDzgA6RMiqWzqI8uwqbNDbq7MwNYuHq7AL5qmYp2kwuLtfMhVl4DahxzAeWTaV_rZQCERZyBU34haLJ41NXGoPgCfkCBRedknSz0h_WNoqi0GHq-D7dLVhNJIXJz87Dfm6z8AedenoudiZ3wZFVCGoeSXUJDRNc3Qk9QNzj9c9xX7AwjNuSyv7UW0IzMqg6PEqW2UgHLTPg5bMlKcXr7kGHSuLUteYvVmkYZ2POh2RVx_BDipe2QagySqTDwVgNMci-JEnva1Y",
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
<?php /**PATH /var/www/html/laravel/resources/views/payment_paypal.blade.php ENDPATH**/ ?>