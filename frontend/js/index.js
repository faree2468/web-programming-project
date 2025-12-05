import { addCharts, personalize } from './home.js';
import { adaptStyles, register } from './register.js';
import { adaptLoginStyles, logoutFunc, checkSession } from './login.js';
import { adaptHeroStyles } from './hero.js';
import { adaptAdminStyles, handleSearch } from './admin.js';
import { payBills, deleteBills, handleBills, loadBills, loadCategories } from './bills.js';
import { editProfileFunction } from './profile.js';

// Restoring styles for elements
const navigation = document.getElementById('nav');

// Styles
const NAV_VISIBLE = navigation.style.display;

// Utils
function restoreStyles() {

    navigation.style.display = NAV_VISIBLE;
    
}

function scrollAutomatic() {
    window.scrollBy(0, -window.innerHeight);
}

var app=$.spapp({
    defaultView: "#hero-main",
    templateDir: "./views/"
});

app.run();

app.route({
    view: "home-main",
    onReady: function() {
        checkSession();
        scrollAutomatic();
        document.documentElement.style.overflow = '';
        document.body.style.overflow = '';
        addCharts();
        restoreStyles();
        personalize();
        logoutFunc();
        
    }
});

app.route({
    view: "bills-main",
    onReady: function() {
        checkSession();
        scrollAutomatic();
        document.documentElement.style.overflow = '';
        document.body.style.overflow = '';
        restoreStyles();
        loadCategories();
        loadBills();
        handleBills();
        setTimeout(()=>{
            deleteBills();
            payBills();
        }, 1000)
        
    }
});

app.route({
    view: "profile-main",
    onReady: function() {
        checkSession();
        scrollAutomatic();
        document.documentElement.style.overflow = '';
        document.body.style.overflow = '';
        restoreStyles();
        editProfileFunction();
    }
});

app.route({
    view: "login-main",
    onReady: function() {
        // run login view specific scripts
        adaptLoginStyles();

        UserService.init();
        
        // disabling scroll again
        document.documentElement.style.overflow = 'hidden';
        document.body.style.overflow = 'hidden';
    }
});

app.route({
    view: "register-main",
    onReady: function() {
        //run register view specific scripts
        adaptStyles();
        register();
        // disabling scroll again
        document.documentElement.style.overflow = 'hidden';
        document.body.style.overflow = 'hidden';
    }
});

app.route({
    view: "admin-main",
    onReady: function() {
        scrollAutomatic();
        // run admin view scripts
        adaptAdminStyles();
        handleSearch();
    }
});

app.route({
    view: "hero-main",
    onReady: function() {
        adaptHeroStyles();
    }
});



