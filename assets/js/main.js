// Получаем элементы
const openMenuButton = document.getElementById('openMenu');
const closeMenuButton = document.getElementById('closeMenu');
const modalMenu = document.getElementById('modalMenu');

// Функция для открытия меню
function openMenu() {
    modalMenu.style.display = 'flex';

    document.body.style.overflow = 'hidden';
}

// Функция для закрытия меню
function closeMenu() {
    modalMenu.style.display = 'none';

    document.body.style.overflow = '';
}

// Добавляем обработчики событий на кнопки
openMenuButton.addEventListener('click', openMenu);
closeMenuButton.addEventListener('click', closeMenu);

// Закрытие меню при клике вне меню
window.addEventListener('click', function(event) {
    if (event.target === modalMenu) {
        closeMenu();
    }
});
