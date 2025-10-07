function submitSettingsForm(e) {
    e.preventDefault();
    

    // Timezone settings
    const formData = new FormData(e.currentTarget);
    for (const [key, value] of formData.entries()) {
        if(key=="timezone") {
            const event = new CustomEvent('timezoneChanged', { detail: value });
            document.dispatchEvent(event);
        }
    }
}

export function manageListeners() {
    const settingsForm = document.getElementById('settings-form');
    if (!settingsForm) {
        return;
    }

    settingsForm.removeEventListener('change', submitSettingsForm);
    settingsForm.addEventListener('change', submitSettingsForm);
}


// Style related code
export function adaptSettingsStyles() {
    const dropdown = document.getElementById('timezoneDropdown');
    if(dropdown) {
        dropdown.value = localStorage.getItem('billAppTimezone') !== null ? localStorage.getItem('billAppTimezone') : 'Europe/Sarajevo';
    }

}