

let product_data = {
    imgSrc: [],
    imgId: []
};

function modificar_producto () {

    document.querySelectorAll('.delete_image').forEach((btn) => {

        btn.addEventListener('click', () => {

            let image = document.querySelector('.delete_image img');

            product_data.imgSrc.push(image.src);
            product_data.imgId.push(btn.getAttribute('dataId'));

            btn.remove();
            // console.log(image.src);
            
        })
    });
}