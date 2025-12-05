var CategoryService = {
    showCategories: function() {
        return new Promise((resolve, reject)=>{
            RestClient.get(
                'categories',
                (response)=>resolve(response),
                (error)=>reject(error)
            )
        })
        
    }
}