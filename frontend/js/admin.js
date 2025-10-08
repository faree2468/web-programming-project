// Style related code
export function adaptAdminStyles() {
    const navigation = document.getElementById('nav');
    navigation.style.display = 'none';
}

export function handleSearch() {
    document.getElementById('users-online').textContent = 5;
    document.getElementById('user-count').textContent = 120;

    const userSearchForm = document.getElementById('user-search-form');
    const userResult = document.getElementById('user-result');
    const resultUsername = document.getElementById('result-username');
    const deleteAccountBtn = document.getElementById('delete-account-btn');
    const removeBillsBtn = document.getElementById('remove-bills-btn');

    userSearchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const username = document.getElementById('search-username').value;
        resultUsername.textContent = username;
        userResult.style.display = 'block';
    });

    deleteAccountBtn.addEventListener('click', function() {
        alert('Account deleted (simulation)');
        userResult.style.display = 'none';
    });

    removeBillsBtn.addEventListener('click', function() {
        alert('Bills removed (simulation)');
    });
}