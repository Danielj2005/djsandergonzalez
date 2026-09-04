let imgHasProductArray = [];
let imgProductDeletedArray = [];

function delete_img_producto (idBtn) {
    let imgHasProduct = document.getElementById('imgHasProduct').value;
    imgHasProductArray = imgHasProduct.split(',');
    let newImg = document.getElementById('fileImg');
    let imageDeleted = document.getElementById(`${idBtn}`);
    cant_img_product = imgHasProductArray.length - imgProductDeletedArray.length;
    let imgProductDeleted = document.getElementById('imgDeleted').value;

    if (cant_img_product > 1 && imgProductDeletedArray.length < imgHasProductArray.length && newImg.files.length < 1) {
        cant_img_product -= 1;
        imageDeleted.classList.add('d-none');
        imgProductDeletedArray.push(idBtn);
        document.getElementById('imgDeleted').value = imgProductDeletedArray.join(',');
        console.log(1);
    }else if (cant_img_product > 0 && newImg.files.length > 0) {
        cant_img_product -= 1;
        imageDeleted.classList.add('d-none');
        imgProductDeletedArray.push(idBtn);
        document.getElementById('imgDeleted').value = imgProductDeletedArray.join(',');
        console.log(2);
    }else {
        // alert con toastify library
        Toastify({ text: ' No puedes eliminar todas las imágenes del producto, debes dejar al menos una imagen.', className: "bi bi-exclamation-triangle-fill text-md]", duration: 3000, }).showToast();
    }
}