const redirectBtn = document.getElementById('redirectBtn');

redirectBtn.addEventListener('click', (e) => {
    e.preventDefault();
    window.location.href = './php/admin.php';
});