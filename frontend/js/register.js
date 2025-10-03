// Style related code
export function adaptStyles() {
    const navigation = document.getElementById('nav');
    const logo = document.getElementById('main-logo');
    const navigationSubsection = document.querySelector('.main-nav-subsection');

    navigation.style.backgroundColor = 'white';
    logo.style.color = 'black';
    navigationSubsection.style.visibility = 'hidden';
}