

function toggleNavbar() {

    const ul = document.getElementById('toggleNavbar');
    const aUl = document.querySelectorAll('#toggleNavbar a');
    const span_A_Ul = document.querySelectorAll('#toggleNavbar a span');
    const btnToggleNav = document.querySelector('#btnToggleNav i');


    if (ul.classList.contains('md:w-[5rem]')) {
        // ajuste de width navmenu

        ul.classList.remove('md:w-[5rem]');
        ul.classList.add('md:w-[15rem]');

        btnToggleNav.classList.remove('bi-arrow-right');
        btnToggleNav.classList.add('bi-arrow-left');

        aUl.forEach((a) => {
            a.classList.remove('md:max-w-14');
            a.classList.add('md:max-w-[15rem]');
        });
        
        span_A_Ul.forEach((span) => {
            span.classList.remove('d-md-none');
            span.classList.add('show-span');
        });
    }else{
        
        btnToggleNav.classList.add('bi-arrow-right');
        btnToggleNav.classList.remove('bi-arrow-left');

        aUl.forEach((a) => {
            a.classList.add('md:max-w-14');
            a.classList.remove('md:max-w-[15rem]');
        });
        
        span_A_Ul.forEach((span) => {
            span.classList.remove('show-span');
            span.classList.add('d-none');
        });

        // ajuste de width navmenu
        ul.classList.add('md:w-[5rem]');
        ul.classList.remove('md:w-[15rem]');
    }

}