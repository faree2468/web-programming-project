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