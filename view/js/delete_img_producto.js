

let product_data;
let imgProductDeletedArray = [];

function delete_img_producto () {

    document.querySelectorAll('.delete_image').forEach((btn) => {

        btn.addEventListener('click', () => {
            
            let image = btn.querySelector('img');
            let imgSrc = image.src.split('/')[5];
            
            let fileImg = document.getElementById('fileImg');
            let imgHasProduct = document.getElementById('imgHasProduct').value;
            imgHasProduct = imgHasProduct.split(',');
            product_data = imgHasProduct;

            let cant_img_product = product_data.length;

            let imgProductDeleted = document.getElementById('imgDeleted').value;

            if (cant_img_product > 1 && imgProductDeleted.length < cant_img_product && fileImg.files.length < 1) {
                cant_img_product -= 1;
                
                btn.classList.add('d-none');
                imgProductDeletedArray.push(imgSrc);
                document.getElementById('imgDeleted').value = imgProductDeletedArray.join(',');
                
            }else if (cant_img_product > 0 && fileImg.files.length > 0) {
                cant_img_product -= 1;

                btn.classList.add('d-none');
                imgProductDeletedArray.push(imgSrc);
                document.getElementById('imgDeleted').value = imgProductDeletedArray.join(',');
                
                
            }else {
                // alert con toastify library
                Toastify({
                    text: ' No puedes eliminar todas las imágenes del producto, debes dejar al menos una imagen.',
                    className: "bi bi-exclamation-triangle-fill text-xl",
                    duration: 3000,
                    style: {
                        background: "#6c757d",
                    }
                }).showToast();
            }
        })
    });
}