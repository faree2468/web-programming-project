import { addCharts } from './home.js';
import { adaptStyles } from './register.js';

const app = document.getElementById('app');

// Restoring styles for elements
const navigation = document.getElementById('nav');
const logo = document.getElementById('main-logo');
const navigationSubsection = document.querySelector('.main-nav-subsection');

// Styles
const NAV_BACKGROUND_COLOR = navigation.style.backgroundColor;
const LOGO_BACKGROUND_COLOR = logo.style.backgroundColor;
const NAV_SUBSECTION_VISIBILITY = navigationSubsection.style.visibility;


const routes = {
    '/' : 'views/home.html',
    '/register' : 'views/register.html',
    '/login' : 'views/login.html',
    '/bills' : 'views/bills.html',
    '/profile' : 'views/profile.html',
    '/settings' : 'views/settings.html'
}

// Utils
function restoreStyles() {

    navigation.style.backgroundColor = NAV_BACKGROUND_COLOR;
    logo.style.color = LOGO_BACKGROUND_COLOR;
    navigationSubsection.style.visibility = NAV_SUBSECTION_VISIBILITY;
    
}

async function loadPage(route) {
    const pageUrl = routes[route] || routes['/']; // if the route does not exist go to home
    try {
        const res = await fetch(pageUrl);
        const html = await res.text();
        app.innerHTML = html;

        // if it's home disable scroll otherwise enable scroll
        if(route === '/') {
            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
            addCharts();
            restoreStyles();
        } else if(route === '/register') {
            // run register view specific scripts
            adaptStyles();
        } else {
            document.documentElement.style.overflow = '';
            document.body.style.overflow = '';
            restoreStyles();
        }

    } catch(_) {
        app.innerHTML = '<h1>Page not found</h1>';
    }
}

window.addEventListener('hashchange', ()=>{
    const route = location.hash.slice(1) || '/';
    loadPage(route);
})


// 1st load
window.addEventListener('DOMContentLoaded', ()=>{
    const route = location.hash.slice(1) || '/';
    loadPage(route);
})


