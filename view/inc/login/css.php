

<!-- Favicons -->
<link href="./view/img/logo.ico" rel="shortcut icon" type="image/x-icon">

<link href="./view/css/app.css" rel="stylesheet">
<link href="./view/css/bootstrap.min.css" rel="stylesheet">
<link href="./view/css/bootstrap-icons.css" rel="stylesheet">
<link href="./view/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="./view/css/sweetalert2.min.css" rel="stylesheet">

<script src="./view/js/tailwind.min.js"></script>

<script>
    // Se ejecuta al instante antes de pintar el body
    const savedTheme = localStorage.getItem('theme') ?? 'dark';
    document.documentElement.classList.add(savedTheme);
</script>

<script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                colors: {
                    slate: { 950: '#020617', },
                    purple: { 400: '#c084fc', 500: '#a855f7', 600: '#9333ea', },
                    fuchsia: { 500: '#d946ef', 600: '#c026d3', 700: '#a21caf', },
                },
                fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'], },
            }
        }
    }
</script>