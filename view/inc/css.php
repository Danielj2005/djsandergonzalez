

<link href="./css/bootstrap.min.css" rel="stylesheet">
<link href="./css/bootstrap-icons.css" rel="stylesheet">
<link href="./css/dataTables.bootstrap5.min.css" rel="stylesheet">

<link href="./css/sweetalert2.min.css" rel="stylesheet">

<link href="./css/toastify.css" rel="stylesheet">
<link href="./css/carousel.css" rel="stylesheet">

<link href="./css/nice_admin_styles/styles.css" rel="stylesheet">


<script>
    // Se ejecuta al instante antes de pintar el body
    const savedTheme = localStorage.getItem('theme') ?? 'dark';
    document.documentElement.classList.add(savedTheme);
    

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