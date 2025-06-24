        const toggleBtn = document.getElementById('modoToggle');
        const body = document.body;
        const profileImg = document.getElementById('perfil-img');
        const imgClaro = 'assets/images/lightmode.jpg';
        const imgOscuro = 'assets/images/darkmode.jpg';

        if (localStorage.getItem('modo') === 'oscuro') {
            activarModoOscuro();
        }

        toggleBtn.addEventListener('click', () => {
            if (body.classList.contains('dark-mode')) {
                desactivarModoOscuro();
            } else {
                activarModoOscuro();
            }
        });

        function activarModoOscuro() {
            body.classList.remove('light-mode');
            body.classList.add('dark-mode');
            profileImg.style.opacity = 0;
            setTimeout(() => {
                profileImg.src = imgOscuro;
                profileImg.style.opacity = 1;
            }, 300);
            toggleBtn.innerHTML = '<i class="fa-solid fa-sun"></i>';
            localStorage.setItem('modo', 'oscuro');
        }

        function desactivarModoOscuro() {
            body.classList.remove('dark-mode');
            body.classList.add('light-mode');
            profileImg.style.opacity = 0;
            setTimeout(() => {
                profileImg.src = imgClaro;
                profileImg.style.opacity = 1;
            }, 300);
            toggleBtn.innerHTML = '<i class="fa-solid fa-moon"></i>';
            localStorage.setItem('modo', 'claro');
        }