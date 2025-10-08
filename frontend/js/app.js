import { addCharts } from './home.js';
import { adaptStyles } from './register.js';
import { adaptLoginStyles } from './login.js';
import { adaptHeroStyles } from './hero.js';
import { adaptAdminStyles, handleSearch } from './admin.js';

const app = document.getElementById('app');

// Restoring styles for elements
const navigation = document.getElementById('nav');

// Styles
const NAV_VISIBLE = navigation.style.display;


// Settings timezone
document.addEventListener('timezoneChanged', (e) => {
    localStorage.setItem('billAppTimezone', e.detail);
});



const routes = {
    '/' : 'views/hero.html',
    '/home' : 'views/home.html',
    '/register' : 'views/register.html',
    '/login' : 'views/login.html',
    '/bills' : 'views/bills.html',
    '/profile' : 'views/profile.html',
    '/admin' : 'views/admin.html'
}

// Utils
function restoreStyles() {

    navigation.style.display = NAV_VISIBLE;
    
}

async function loadPage(route) {
    let pageUrl = null;
    if(route in routes) {
        pageUrl = routes[route];
    } else {
        pageUrl = routes['/'];
    }
    try {
        const res = await fetch(pageUrl);
        const html = await res.text();
        app.innerHTML = html;

        // if it's home disable scroll otherwise enable scroll
        if(route === '/home') {
            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
            addCharts();
            restoreStyles();
        } else if(route === '/register') {
            // run register view specific scripts
            adaptStyles();
            // disabling scroll again
            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
        } else if(route === '/login') {
            // run login view specific scripts
            adaptLoginStyles();
            // disabling scroll again
            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
        } else if(route === '/admin') {
            // run admin view scripts
            adaptAdminStyles();
            handleSearch();
            
        } else if(route === '/') {
            // hero page, remove nav
            adaptHeroStyles();
            
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


