<script>
	//Abrir el modal
	$(document).on("click", "#openModalOrden_AddEdit", openModalOrden);
        function openModalOrden(e){
            e.preventDefault();
            var id_orden = $(this).attr("data-id-orden");
            var seccion = "modal_orden";
            var data_json = {
                "accion":"openModalOrden_AddEdit",
                "datos":{
                    "id_orden":id_orden,
                    "seccion":seccion,
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_orden") }}',
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

        //añadir nuevo
    $(document).on("click", "#postAddOrden", postAddOrden);
    	function postAddOrden(e){
            e.preventDefault();
            var id_orden = $("#addEditFormOrden_footer #id_orden").val();
            var id_cliente = $("#addEditFormOrden #id_cliente").val();
            var id_producto = $("#addEditFormOrden #id_producto").val();
            var precio_unitario = $("#addEditFormOrden #precio_unitario").val();
            var cantidad_piezas = $("#addEditFormOrden #cantidad_piezas").val();
            var tipo_empaque = $("#addEditFormOrden #tipo_empaque").val();
            var fecha_produccion = $("#addEditFormOrden #fecha_produccion").val();
            var fecha_entrega = $("#addEditFormOrden #fecha_entrega").val();
            var data_flag_modal = $(this).attr("data-flag-modal");
            var data_json = {
                "accion":"postPutOrden",
                "datos":{
                    "id_orden":id_orden,
                    "id_cliente":id_cliente,
                    "id_producto":id_producto,
                    "precio_unitario":precio_unitario,
                    "cantidad_piezas":cantidad_piezas,
                    "tipo_empaque":tipo_empaque,
                    "fecha_produccion":fecha_produccion,
                    "fecha_entrega":fecha_entrega,
                    "data_flag_modal":data_flag_modal
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_orden") }}',
                type:  'post',
                dataType:'json',
                beforeSend: function () {
                },
                success:  function (result) {
                    if(result.status != undefined && result.status == "correcto" ){
                        if(result.data_flag_modal == "by_orden"){
                            $("#modalOrden").modal("hide");    
                            getTableOrdens(); 
                        }
                        else{
                            $("#modalOrden").modal("hide");
                            getTableClientes_Orden(null, id_cliente);
                        }
                        
                    }
                    else{

                    }


                },
                error: function(error){
                    console.log(error);
                }
            });
        }

        //editar cliente
        $(document).on("click", "#putEditOrden", putEditOrden);
    	function putEditOrden(e){
            e.preventDefault();
            var id_orden = $("#addEditFormOrden_footer #id_orden").val();
            var id_cliente = $("#addEditFormOrden #id_cliente").val();
            var id_producto = $("#addEditFormOrden #id_producto").val();
            var precio_unitario = $("#addEditFormOrden #precio_unitario").val();
            var cantidad_piezas = $("#addEditFormOrden #cantidad_piezas").val();
            var tipo_empaque = $("#addEditFormOrden #tipo_empaque").val();
            var fecha_produccion = $("#addEditFormOrden #fecha_produccion").val();
            var fecha_entrega = $("#addEditFormOrden #fecha_entrega").val();
            var data_flag_modal = $(this).attr("data-flag-modal");
            var data_json = {
                "accion":"postPutOrden",
                "datos":{
                    "id_orden":id_orden,
                    "id_cliente":id_cliente,
                    "id_producto":id_producto,
                    "precio_unitario":precio_unitario,
                    "cantidad_piezas":cantidad_piezas,
                    "tipo_empaque":tipo_empaque,
                    "fecha_produccion":fecha_produccion,
                    "fecha_entrega":fecha_entrega,
                    "data_flag_modal":data_flag_modal
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_orden") }}',
                type:  'post',
                dataType:'json',
                beforeSend: function () {
                },
                success:  function (result) {
                    if(result.status != undefined && result.status == "correcto" ){
                        if(result.data_flag_modal == "by_orden"){
                            $("#modalOrden").modal("hide");    
                            getTableOrdens(); 
                        }
                        else{
                            $("#modalOrden").modal("hide");
                            getTableClientes_Orden(null, id_cliente);
                        }
                        
                    }
                    else{

                    }

                },
                error: function(error){
                    console.log(error);
                }
            });
        }


        /*Buscar*/
        $(document).on("keyup", "#search_orden", searchTableOrden);
        $(document).on("click", "#search_tabla_orden", searchTableOrden);
        function searchTableOrden(e) {
            e.preventDefault();
            var nombre_cliente = $('#search_orden #searh_nombre_orden_cliente').val();
            var nombre_producto = $('#search_orden #nombre_producto').val();
            var data_json = {
                "accion":"getTableOrden",
                "datos":{                   
                    "nombre_cliente":nombre_cliente,
                    "nombre_producto":nombre_producto
                    
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_orden") }}',
                type:  'post',
                dataType:'html',
                beforeSend: function () {
                },
                success:  function (result) {   
                    $('#tabla_orden').html(result);
                    /*getTableInfo(1); */
                },
                error: function(error){
                    console.log(error);
                }
            });
        }


        //carga de la tabla
        function getTableOrdens(page) {
        	if(page == undefined){
                var page = 0;
                if ($('#tabla_orden ul.pagination li').hasClass("active") == true) {
                    page = $('#tabla_orden ul.pagination .active .page-link').text();
                }else{
                    page = 1;
                }
            }
            var data_json = {
                "accion":"getTableOrden",
                "page":page,
                "datos":{

                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_orden") }}',
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
            getTableOrdens($(this).attr('href').split('page=')[1]);
        });
        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getTableOrdens(page);
                }
            }
        });

</script>		