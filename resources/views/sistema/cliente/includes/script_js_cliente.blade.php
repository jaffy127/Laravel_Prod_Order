<script>
	
    //Abrir Modal de las ordenes del cliente
    $(document).on("click", "#openModalCliente_ViewOrden", openModalCliente_ViewOrden);
        function openModalCliente_ViewOrden(e){
            e.preventDefault();
            var id_cliente = $(this).attr("data-id-cliente");
            var accion = "openModalCliente_ViewOrden";
            var seccion = "modal_orden_cliente";
            var data_json = {
                "accion":accion,                
                "datos":{
                    "id_cliente":id_cliente,
                    "seccion":seccion
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_cliente") }}',
                type:  'post',
                dataType:'html',
                beforeSend: function () {
                },
                success:  function (result) {
                    $("#modalCliente_orden").html(result);
                    $("#modalCliente_orden").modal({backdrop: 'static',keyboard:false});     
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

    //Abrir Modal para add/edit orden del cliente abierto
    $(document).on("click", "#openModalCliente_Orden_AddEdit", openModalCliente_Orden_AddEdit);
        function openModalCliente_Orden_AddEdit(e){
            e.preventDefault();
            var id_cliente = $(this).attr("data-id-cliente");
            var id_orden =  $(this).attr("data-id-orden");
            var accion = "openModalCliente_Orden_AddEdit";
            var seccion = "modal_orden_cliente";
            var data_json = {
                "accion":accion,                
                "datos":{
                    "id_cliente":id_cliente,
                    "id_orden":id_orden,
                    "seccion":seccion
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_cliente") }}',
                type:  'post',
                dataType:'html',
                beforeSend: function () {
                },
                success:  function (result) {
                    $("#modalOrden").html(result);
                    $("#modalOrden").modal({backdrop: 'static',keyboard:false});     
                },
                error: function(error){
                    console.log(error);
                }
            });
        }


     //Abrir el modal Add Edit
	$(document).on("click", "#openModalCliente_AddEdit", openModalCliente_AddEdit);
        function openModalCliente_AddEdit(e){
            e.preventDefault();
            var id_cliente = $(this).attr("data-id-cliente");
            var accion = "openModalCliente_AddEdit";
            var seccion = "modal_orden";
            var data_json = {
                "accion":accion,                
                "datos":{
                    "id_cliente":id_cliente,
                    "seccion":seccion
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_cliente") }}',
                type:  'post',
                dataType:'html',
                beforeSend: function () {
                },
                success:  function (result) {
                    $("#modalCliente").html(result);
                    $("#modalCliente").modal({backdrop: 'static',keyboard:false});     
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

        //añadir nuevo
    $(document).on("click", "#postAddCliente", postAddCliente);
    	function postAddCliente(e){
            e.preventDefault();
            var id_cliente = $("#addEditFormCliente_footer #id_cliente").val();
            var nombre_cliente = $("#addEditFormCliente #nombre_cliente").val();
            var email = $("#addEditFormCliente #email").val();
            var telefono = $("#addEditFormCliente #telefono").val();
            var direccion = $("#addEditFormCliente #direccion").val();
            var moneda = $("#addEditFormCliente #moneda").val();
            var data_json = {
                "accion":"postPutCliente",
                "datos":{
                    "id_cliente":id_cliente,
                    "nombre_cliente":nombre_cliente,
                    "email":email,
                    "telefono":telefono,
                    "direccion":direccion,
                    "moneda":moneda
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_cliente") }}',
                type:  'post',
                dataType:'json',
                beforeSend: function () {
                },
                success:  function (result) {
                    if(result.status != undefined && result.status == "correcto"){

                    }else{

                    }
                    $("#modalCliente").modal("hide");    
                    getTableClientes(); 
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

        //editar cliente
    $(document).on("click", "#putEditCliente", putEditCliente);
    	function putEditCliente(e){
            e.preventDefault();
            var id_cliente = $("#addEditFormCliente_footer #id_cliente").val();
            var nombre_cliente = $("#addEditFormCliente #nombre_cliente").val();
            var email = $("#addEditFormCliente #email").val();
            var telefono = $("#addEditFormCliente #telefono").val();
            var direccion = $("#addEditFormCliente #direccion").val();
            var moneda = $("#addEditFormCliente #moneda").val();
            var data_json = {
                "accion":"postPutCliente",
                "datos":{
                    "id_cliente":id_cliente,
                    "nombre_cliente":nombre_cliente,
                    "email":email,
                    "telefono":telefono,
                    "direccion":direccion,
                    "moneda":moneda
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_cliente") }}',
                type:  'post',
                dataType:'json',
                beforeSend: function () {
                },
                success:  function (result) {
                    if(result.status != undefined && result.status == "correcto"){

                    }else{

                    }
                    $("#modalCliente").modal("hide");    
                    getTableClientes(); 
                },
                error: function(error){
                    console.log(error);
                }
            });
        }


        /*Buscar*/
    $(document).on("keyup", "#searh_cliente", function(e){
        e.preventDefault();
        getTableClientes(1);
    });

    $(document).on("click", "#search_tabla_cliente", function(e){
        e.preventDefault();
        getTableClientes(1);
    });

        //carga de la tabla clientes
        function getTableClientes(page) {
        	if(page == undefined){
                var page = 0;
                if ($('#tabla_cliente ul.pagination li').hasClass("active") == true) {
                    page = $('#tabla_cliente ul.pagination .active .page-link').text();
                }else{
                    page = 1;
                }
            }
            var nombre_cliente = $('#searh_cliente #searh_nombre_cliente').val();
            var data_json = {
                "accion":"getTableCliente",
                "page":page,
                "datos":{
                    "nombre_cliente":nombre_cliente

                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_cliente") }}',
                type:  'post',
                dataType:'html',
                beforeSend: function () {
                    /*$('#tabla_info').html('<div class="col-md-12 text-center"><h3>Cargando Datos ...</h3></div>');*/
                },
                success:  function (result) {
                    $('#tabla_cliente').html(result);
                },
                error: function(error){
                    $('#tabla_cliente').html('<div class="col-md-12 text-center"><h3>Datos no encontrados</h3></div>');
                    console.log(error);
                }
            });
        }

        //carga de la tabla clientes
        function getTableClientes_Orden(page, idcliente) {
            if(page == undefined){
                var page = 0;
                if ($('#tabla_orden ul.pagination li').hasClass("active") == true) {
                    page = $('#tabla_orden ul.pagination .active .page-link').text();
                }else{
                    page = 1;
                }
            }
            var id_cliente = idcliente;
            var seccion = "modal_orden_cliente";
            var data_json = {
                "accion":"getTableClientes_Orden",
                "page":page,
                "datos":{
                    "id_cliente":id_cliente,
                    "seccion":seccion
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_cliente") }}',
                type:  'post',
                dataType:'html',
                beforeSend: function () {
                    /*$('#tabla_info').html('<div class="col-md-12 text-center"><h3>Cargando Datos ...</h3></div>');*/
                },
                success:  function (result) {
                    $('#tabla_orden').html(result);
                },
                error: function(error){
                    $('#tabla_orden').html('<div class="col-md-12 text-center"><h3>Datos no encontrados</h3></div>');
                    console.log(error);
                }
            });
        }

    $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            getTableClientes($(this).attr('href').split('page=')[1]);
        });

    $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getTableClientes(page);
                }
            }
        });

    $(document).on("click", "#openModalCliente_ImportExcel", openModalCliente_ImportExcel);
        function openModalCliente_ImportExcel(e){
            e.preventDefault();
            var accion = "openModalCliente_ImportExcel";
            var data_json = {
                "accion":accion,                
                "datos":{
   
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_cliente") }}',
                type:  'post',
                dataType:'html',
                beforeSend: function () {
                },
                success:  function (result) {
                    $("#modalImport_Cliente").html(result);
                    $("#modalImport_Cliente").modal({backdrop: 'static',keyboard:false});     
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

    $(document).on("click", "#importClientes_toExcel", importClientes_toExcel);
        function importClientes_toExcel(e){
            e.preventDefault();
            var form = document.forms.namedItem("FormImportCliente");
            var accion = "importClientes_toExcel";
            var fd = new FormData(form);
            fd.append("accion", accion);

            ajaxSetup();
            $.ajax({
                data:  fd,
                url:   '{{ route("path_ajax_cliente") }}',
                type:  'post',
                dataType:'json',
                processData: false,
                contentType: false,
                beforeSend: function () {
                },
                success:  function (result) {
                    $("#modalImport_Cliente").modal("hide");
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

</script>		