let imgHasArray = [];
let imgDeletedArray = [];
let imgUploaded = [];
let cant_img = 3;

function delete_img (idParent, idBtn, idFileInput) {
    
    const deleteImg = (id) =>{

        $.ajax({
            type: "POST",
            url: "../controller/portafolio.php",
            data: { "modulo": "Delete" , "id": id }, // Usa el objeto FormData en lugar de $(this).serialize(),
            error: function () {
                Swal.fire("¡Ocurrio un problema!","Recargue la página e intente nuevamente o presione F5", "error");
            },
            success: function (data) { 
                $('.msjFormSend').html(data); 
                document.getElementById(`${idBtn}`).classList.add('d-none');
            }
        });
    };
    
    let i = 0;

    document.querySelectorAll(`#${idParent} button`).forEach(btn => {
        i < 3 ? imgHasArray[i++] = btn.id : '';
    });

    let newImg = document.getElementById(`${idFileInput}`);
    let imageDeleted = document.getElementById(`${idBtn}`);
    cant_img = imgHasArray.length - imgDeletedArray.length;
    
    if (cant_img < 4 && imgDeletedArray.length < 4 && newImg.files.length > 0 && newImg.files.length < 4 && imgUploaded.length < 4 ) {
        cant_img -= 1;  
        imgDeletedArray.push(imageDeleted.id);
        imgUploaded.push(newImg.files.length);


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

                deleteImg(idBtn);
                Swal.close();
            }
        });
    }else {
        // alert con toastify library
        Swal.close();
        Toastify({ text: ' No puedes eliminar las imágenes sin subir un reemplazo, debes dejar 3 imagenes.', className: "bi bi-exclamation-triangle-fill text-md]", duration: 3000, }).showToast();
    }
}