var PaymentService = {
    createPayment: function(payment) {
        RestClient.post('payments', payment, function(_) {
            toastr.success("Bill paid");
        }, function(response) {
            toastr.error(response);
        })
    }
}