var PaymentService = {
    createPayment: function(payment) {
        RestClient.post('payments', payment, function(_) {
            toastr.success("Bill paid");
        }, function(response) {
            toastr.error(response);
        })
    },

    getPaymentsFromUser: function(id) {
        return new Promise((resolve, reject)=>{
            RestClient.get(
                'payments/user/' + id,
                (response)=>resolve(response),
                (error)=>reject(error)
            )
        })
        
    },

    getPaymentsFromUserForYearMonth: function(year, month, id) {
        return new Promise((resolve, reject)=>{
            RestClient.get(
                `payments/${year}/${month}/${id}`,
                (response)=>resolve(response),
                (error)=>reject(error)
            )
        })
        
    }
}