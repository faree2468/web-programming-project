var BillService = {
    createBill: function(bill) {
        RestClient.post('bills', bill, function(_){
            toastr.success("Bill added");
        }, function(response) {
            toastr.error(response.message);
        })
    },

    deleteBill: function(id) {
        let data={};
        RestClient.delete("bills/" + id, data, function(_){
            toastr.success("Bill deleted");
        }, function(response) {
            toastr.error(response.responseText || "Request failed");
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
        
    },

    editBillStatus: function(id, billStatus) {
        RestClient.patch('bills/' + id, billStatus, function(_) {}, function(response){
            console.error(response);
        })
    },

    deleteUserBills: function(id) {
        RestClient.delete('bills/user/'+id, function(_){}, function(response){
            console.log(response);
        })
    }
}