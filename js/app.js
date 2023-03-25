//TOGGLE
const body = document.querySelector("body"),
    modeToggle = body.querySelector(".toggle-ball");
let getMode = localStorage.getItem('mode');
if (getMode && getMode === "dark") {
    body.classList.toggle("dark");
}

function clickDarkMode() {
    body.classList.toggle('dark');
    if (body.classList.contains('dark')) {
        localStorage.setItem('mode', 'dark');
    } else localStorage.setItem('mode', 'light');
}
modeToggle.addEventListener('click', clickDarkMode);
// ----------------------------------------------------------------
const toggleBtnBar = document.querySelector(".icon-bars"),
    navLeft = document.querySelector('.navbar-left '),
    navClose = document.querySelector('.navbar-close');

function clickToggleBar() {
    navLeft.classList.toggle('active');
}
toggleBtnBar.addEventListener('click', clickToggleBar);

navClose.addEventListener('click', clickToggleBar);