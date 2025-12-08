export function editProfileFunction() {

    // show previously set settings
    const incomeText = document.getElementById("income");
    incomeText.placeholder = localStorage.getItem('user_income') ? localStorage.getItem('user_income') : "It's for data dashboard purposes"

    // account-settings-form
    const form = document.getElementById("account-settings-form");
    const income = document.getElementById("income-form");
    form.addEventListener("submit", (e)=>{
        e.preventDefault();
        const userData = {}
        const token = localStorage.getItem('user_token');
        const user = Utils.parseJwt(token);
        const formData = new FormData(form);
        if(formData.get('username') !== "") {
            userData.name = formData.get('username');
        }

        if(formData.get('email') !== "") {
            userData.email = formData.get('email');
        }

        if(formData.get('password') !== "" && formData.get('confirm-password') !== "") {
            userData.password = formData.get('password');
            userData.confirm_password = formData.get('confirm-password');
        }

        console.log(userData);
        UserService.editUser(user.user.id, userData);
        
    })

    income.addEventListener("submit", (e)=>{
        e.preventDefault();
        const formData = new FormData(income);

        localStorage.setItem('user_income', formData.get('income'));
        toastr.success("Income set successfully");

    })

}