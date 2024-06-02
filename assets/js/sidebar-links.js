document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const openBtn = document.getElementById('openBtn');
    const closeBtn = document.getElementById('closeBtn');
    const sidebarLinks = document.getElementById('sidebar-links');

    // Toggle sidebar open/close
    openBtn.addEventListener('click', function() {
        sidebar.classList.add('open');
        openBtn.style.display = 'none';
    });

    closeBtn.addEventListener('click', function() {
        sidebar.classList.remove('open');
        openBtn.style.display = 'block';
    });

    // Generate sidebar links from h2 elements
    const headers = document.querySelectorAll('.learn-content h2');
    headers.forEach((header, index) => {
        const id = 'section' + (index + 1);
        header.id = id;

        const li = document.createElement('li');
        const a = document.createElement('a');

        a.href = '#' + id;
        a.textContent = header.textContent;
        li.appendChild(a);
        sidebarLinks.appendChild(li);
    });

    // Smooth scroll to section
    const links = document.querySelectorAll('.sidebar-links a');

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                const offsetTop = targetElement.offsetTop;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
});
