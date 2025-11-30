var BillService = {
    createBill: function(bill) {
        RestClient.post('bills', bill, function(_){
            toastr.success("Bill added");
        }, function(response) {
            toastr.error(response.message);
        })
    },

    getBillsFromUser: function(id) {
        return new Promise((resolve, reject)=>{
            RestClient.get(
                'bills/user/' + id, 
                (response)=>resolve(response), 
                (error)=>reject(error)
            );
        });
        
    }
}