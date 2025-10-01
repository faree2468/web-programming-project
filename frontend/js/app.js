const app = document.getElementById('app');

const routes = {
    '/' : 'views/home.html',
    '/bills' : 'views/bills.html',
    '/profile' : 'views/profile.html',
    '/settings' : 'views/settings.html'
}

async function loadPage(route) {
    const pageUrl = routes[route] || routes['/']; // if the route does not exist go to home
    try {
        const res = await fetch(pageUrl);
        const html = await res.text();
        app.innerHTML = html;
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


