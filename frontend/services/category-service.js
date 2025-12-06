var CategoryService = {
    showCategories: function() {
        return new Promise((resolve, reject)=>{
            RestClient.get(
                'categories',
                (response)=>resolve(response),
                (error)=>reject(error)
            )
        })
        
    },

    getTopSpendsForUser: function(id) {
        return new Promise((resolve, reject)=>{
            RestClient.get(
                'get_paid_bills_by_category/' + id,
                (response)=>resolve(response),
                (error)=>reject(error)
            )
        })
    }
}