// Style related code
export function adaptStyles() {
    const navigation = document.getElementById('nav');
    navigation.style.display = 'none';
}

export function register() {

    const formId = document.getElementById("sign-up-form-form");
    formId.addEventListener("submit", (e)=>{
        e.preventDefault();
        UserService.register();
    })

    
}