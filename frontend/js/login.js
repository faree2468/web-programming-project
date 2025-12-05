// Style related code
export function adaptLoginStyles() {
    const navigation = document.getElementById('nav');
    navigation.style.display = 'none';
}

export function logoutFunc() {
    const logoutBtn = document.getElementById("logout-btn");
    logoutBtn.addEventListener("click", (e)=>{
        e.preventDefault();
        UserService.logout();
    })
}

export function checkSession() {
    var token = localStorage.getItem('user_token');

    if(!token && token == undefined) {
        window.location.hash = "login-main";
    }

}