<!-- jquery -->
<script src="./js/jquery-3.6.0.min.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>

<!-- datatable js files -->
<script src="./js/jquery.dataTables.min.js"></script>
<script src="./js/datatables.min.js"></script>
<script src="./js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var t = $('#example').DataTable( { 
            language: {
				url: './js/dataTables-Español.json'
			},
            lengthMenu: [[5, 10, 15, 20, 25, 50, 100, -1], [5, 10, 15, 20, 25, 50, 100, "Todos"]],
            responsive: true,
        } );

        t.on( 'order.dt search.dt', function () {
            let i = 1;
    
            t.cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
                this.data(i++);
            } );
        } ).draw();
    } );
    
    function dataTable(classTable = "example"){
        var t = $(`.${classTable}`).DataTable( { 
            language: {
                url: './js/dataTables-Español.json'
            },
            lengthMenu: [[5, 10, 15, 20, 25, 50, 100, -1], [5, 10, 15, 20, 25, 50, 100, "Todos"]],
            responsive: true,
        } );

        t.on( 'order.dt search.dt', function () {
            let i = 1;
            t.cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
                this.data(i++);
            } );
        } ).draw();
    }
    
</script>


<!-- Template Main JS File -->
<script src="./js/nice_admin_scripts/main.js"></script>

<script src="./js/get_url.js"></script>

<!-- <script src="./js/sweet-alert.min.js"></script> -->
<script src="./js/sweetalert2.min.js"></script>

<!-- <script src="./js/tiempo_inactividad.js"></script> -->
<script src="./js/hiddenInput.js"></script>
<!-- <script src="./js/validacion_formularios.js"></script> -->

<script src="./js/SendForm.js"></script> <!-- procesamiento de peticiones CRUD del usuario -->

<script src="./js/cerrar_sesion.js"></script> <!-- script para cerrar sesion -->
<script src="./js/toastify.js"></script> <!-- script para import la libreria de alertas toastify -->

<script type="text/javascript" src="js/dark_mode.js"></script>

<script type="text/javascript" src="js/productos.js"></script>
<script type="text/javascript" src="js/carousell.js"></script>
<script type="text/javascript" src="js/initialApp.js"></script>
<script type="text/javascript" src="js/delete_img_producto.js"></script>
<script type="text/javascript" src="js/easy_modal_v1.js"></script>
