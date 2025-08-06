function showSection(sectionId) {
    document.querySelectorAll('.content-section').forEach(section => {
        section.classList.add('hidden');
    });
    const activeSection = document.getElementById(sectionId);
    activeSection.classList.remove('hidden');
    activeSection.classList.add('active');
}

// Toggle sidebar visibility
document.addEventListener('DOMContentLoaded', function () {
    showSection('dashboard');

    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');

    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
    });
});
