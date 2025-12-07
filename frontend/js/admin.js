// Style related code
export function adaptAdminStyles() {
    const navigation = document.getElementById('nav');
    navigation.style.display = 'none';
}

export function handleSearch() {
    document.getElementById('users-online').textContent = 1;
    UserService.getUsers().then((cnt)=>{
        document.getElementById('user-count').textContent = cnt;
    });

    const userSearchForm = document.getElementById('user-search-form');
    const userResult = document.getElementById('user-result');
    const resultUsername = document.getElementById('result-username');
    const resultRole = document.getElementById('result-role');
    const resultEmail = document.getElementById('result-email');
    const deleteAccountBtn = document.getElementById('delete-account-btn');
    const removeBillsBtn = document.getElementById('remove-bills-btn');
    const userResultNegative = document.getElementById('user-no');

    userSearchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const username = document.getElementById('search-username').value;
        UserService.getUsersByName(username).then((res)=>{
            if(Object.keys(res).length !== 0) {
                userResultNegative.style.display = 'none';
                resultUsername.textContent = res[0].name+` (id:${res[0].id})`;
                resultRole.textContent = res[0].role;
                resultEmail.textContent = res[0].email;
                userResult.style.display = 'block';
            } else {
                userResult.style.display = 'none';
                userResultNegative.style.display = 'block';
            }
            
        })
    });

    deleteAccountBtn.addEventListener('click', function() {
        let id = "";
        if(resultUsername.textContent) {
            id = resultUsername.textContent.substring(resultUsername.textContent.indexOf("id")+3,resultUsername.textContent.length-1);
        }
        UserService.deleteUser(Number(id));

        alert('Account deleted');
        userResult.style.display = 'none';
    });

    removeBillsBtn.addEventListener('click', function() {
        let id = "";
        if(resultUsername.textContent) {
            id = resultUsername.textContent.substring(resultUsername.textContent.indexOf("id")+3,resultUsername.textContent.length-1);
        }
        BillService.deleteUserBills(Number(id));
        alert('Bills removed (simulation)');
    });
}