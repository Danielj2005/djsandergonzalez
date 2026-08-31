
/* *
*   easyModal
*   function para la manipulacion dinamica de ventanas modal
*/

function easyModal () {
    // modal bg 
    const modalBg = document.createElement('div');
    modalBg.className = 'modal fade';
    modalBg.id = "em_lists";
    modalBg.setAttribute("tabindex","-1");
    modalBg.setAttribute("aria-labelledby","modal_lists");
    modalBg.setAttribute("aria-hidden","true"); 
    modalBg.setAttribute("data-bs-backdrop","static");
    // modal container
    const modalContainer = document.createElement('div');
    modalContainer.className = 'modal-dialog modal-dialog-scrollable';
    modalContainer.id = "em_container";
    // modal content
    const modalContent = document.createElement('div');
    modalContent.className = 'dark:bg-slate-800 modal-content';
    // modal header
    const modalheader = document.createElement('div');
    modalheader.className = 'modal-header';
    // modal body
    const modalBody = document.createElement('div');
    modalBody.className = 'modal-body';
    modalBody.id = "em_body_lists";
    // modal footer
    const modalFooter = document.createElement('div');
    modalFooter.className = 'modal-footer';
    modalFooter.id = 'em_footer';
    // modal tittle
    const modaltitle = document.createElement('h5');
    modaltitle.className = 'text-xl dark:text-slate-200 modal-title';
    modaltitle.id = "em_title";
    // btn close
    const modalBtnClose = document.createElement('button');
    modalBtnClose.className = 'dark:bg-white btn-close';
    modalBtnClose.id = "em_btn_close";
    modalBtnClose.type = "button";
    modalBtnClose.setAttribute("data-bs-dismiss","modal");
    modalBtnClose.setAttribute("aria-label","Close");
    // btn save
    const modalBtnSave = document.createElement('button');
    modalBtnSave.className = 'btn btn-success';
    modalBtnSave.textContent = "Guardar";
    modalBtnSave.id = "em_btn_save";
    modalBtnSave.setAttribute("form","em_form");
    modalBtnSave.type = "submit";
    // btn cancel
    const modalBtnCancel = document.createElement('button');
    modalBtnCancel.className = 'btn btn-danger';
    modalBtnCancel.textContent = "Cancelar";
    modalBtnCancel.id = "em_btn_cancel";
    modalBtnCancel.type = "button";
    modalBtnCancel.setAttribute("data-bs-dismiss","modal");

    // modal header section
    modalheader.appendChild(modaltitle);
    modalheader.appendChild(modalBtnClose);
    // modal footer section
    modalFooter.appendChild(modalBtnSave);
    modalFooter.appendChild(modalBtnCancel);
    // modal content section
    modalContent.appendChild(modalheader);
    modalContent.appendChild(modalBody);
    modalContent.appendChild(modalFooter);
    // modal container section
    modalContainer.appendChild(modalContent);
    // modal bg section
    modalBg.appendChild(modalContainer);

    document.body.appendChild(modalBg);

};

function updateEasyModal (em_title, em_icon, em_size, em_target) {
    // modal tittle icon    
    const modalIcontitle = `<i class="bi ${em_icon}"></i>  `;
    
    document.getElementById('em_title').innerHTML = modalIcontitle;
    document.getElementById('em_title').innerHTML += em_title;
    
    document.getElementById('em_container').className = `modal-dialog modal-dialog-scrollable ${em_size}`;

    if (em_target == "list") {
        document.getElementById('em_footer').classList.add('d-none');
    }else{
        document.getElementById('em_footer').classList.remove('d-none');
    }


}


// Ejecutar al cargar la página o el modal
document.addEventListener('DOMContentLoaded', () => {
    // create modal and add to the body of document
    easyModal ();
    
    // buscar disparadores de funcionalidad Easy_Modal
    document.querySelectorAll('.em_trigger').forEach((trigger) => {
        trigger.addEventListener('click', async () => {
            let target = trigger.getAttribute('em_trigger') ?? null;
            let url = trigger.getAttribute('em_url') ?? null;
            let title = trigger.getAttribute('em_title') ?? null;
            let icon = trigger.getAttribute('em_icon') ?? null;
            let size = trigger.getAttribute('em_size') ?? null;

            updateEasyModal (title, icon, size, target);
            
            // Consultamos al PHP que trae los datos de MySQL
            let response = await fetch(url);

            if (!response.ok) throw new Error("Error en la petición");
            const data = await response.text();
            document.getElementById('em_body_lists').innerHTML = data;

            dataTable('em_tale_data');
            SendFormAjax();

        });
    });
    
});
