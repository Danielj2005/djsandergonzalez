let imgHasProductArray = [];
let imgProductDeletedArray = [];

function delete_img_producto (idBtn) {

    const delete_img = (idBtn) =>{

        $.ajax({
            type: "POST",
            url: "../controller/img_producto.php",
            data: { "modulo": "Delete" , "id": idBtn }, // Usa el objeto FormData en lugar de $(this).serialize(),
            error: function () {
                Swal.fire("¡Ocurrio un problema!","Recargue la página e intente nuevamente o presione F5", "error");
            },
            success: function (data) { 
                $('.msjFormSend').html(data); 
                document.getElementById(`${idBtn}`).classList.add('d-none');

            }
        });
    };

    let imgHasProduct = document.getElementById('imgHasProduct').value;
    imgHasProductArray = imgHasProduct.split(',');
    let newImg = document.getElementById('fileImg');
    let imageDeleted = document.getElementById(`${idBtn}`);
    cant_img_product = imgHasProductArray.length - imgProductDeletedArray.length;
    
    Swal.fire({
        title: "Advertencia",
        text: "¿Estás seguro de que deseas eliminar esta imagen?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6", // Default SweetAlert2 blue
        confirmButtonText: "Sí, continuar",
        cancelButtonText: "No, cancelar",
        animation: "slide-from-top"
    }).then((result) => {
        if (result.isConfirmed) {
            // el usuario confirme la acción
            Swal.fire({title: "Procesando...", text: "", allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });

            if (cant_img_product > 1 && imgProductDeletedArray.length < imgHasProductArray.length && newImg.files.length < 1) {
                cant_img_product -= 1;
                
                delete_img(idBtn);
                Swal.close();
                
            }else if (cant_img_product > 0 && newImg.files.length > 0) {
                cant_img_product -= 1;
                
                delete_img(idBtn);
                Swal.close();

            }else {
                // alert con toastify library
                Swal.close();
                Toastify({ text: ' No puedes eliminar todas las imágenes del producto, debes dejar al menos una imagen.', className: "bi bi-exclamation-triangle-fill text-md]", duration: 3000, }).showToast();
            }
        }
    });
}