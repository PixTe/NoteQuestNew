
document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('theme-toggle');
    const themeStyle = document.getElementById('theme-style');
    const path = window.location.pathname;
    const isSpecialPage = path.includes('/register') || path.includes('/login');
    console.log(isSpecialPage);
    // Проверяем, есть ли сохраненная тема в localStorage
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme) {
        themeStyle.href = isSpecialPage
            ? `/assets/css/${currentTheme}-theme-register.css`
            : `/assets/css/${currentTheme}-theme.css`;
    } else {
        themeStyle.href = isSpecialPage
            ? '/assets/css/light-theme-register.css'
            : '/assets/css/light-theme.css';
    }

    themeToggle.addEventListener('click', () => {
        if (themeStyle.href.includes('/assets/css/light-theme.css')) {
            themeStyle.href = isSpecialPage
                ? '/assets/css/style-theme-register.css'
                : '/assets/css/style-theme.css';
            localStorage.setItem('theme', 'style');
        } else {
            themeStyle.href = isSpecialPage
                ? '/assets/css/light-theme-register.css'
                : '/assets/css/light-theme.css';
            localStorage.setItem('theme', 'light');
        }
    });
});
