import { addCharts } from './home.js';
import { adaptStyles } from './register.js';
import { adaptLoginStyles } from './login.js';

const app = document.getElementById('app');

// Restoring styles for elements
const navigation = document.getElementById('nav');

// Styles
const NAV_VISIBLE = navigation.style.display;


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

    navigation.style.display = NAV_VISIBLE;
    
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
            // disabling scroll again
            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
        } else if(route === '/login') {
            // run login view specific scripts
            adaptLoginStyles();
            // disabling scroll again
            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
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


