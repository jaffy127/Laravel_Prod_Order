<script>
	//Abrir el modal
	$(document).on("click", "#openModalProducto_AddEdit", openModalProducto);
        function openModalProducto(e){
            e.preventDefault();
            var id_producto = $(this).attr("data-id-producto");
            var data_json = {
                "accion":"openModalProducto_AddEdit",
                "datos":{
                    "id_producto":id_producto
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_producto") }}',
                type:  'post',
                dataType:'html',
                beforeSend: function () {
                },
                success:  function (result) {
                    $("#modalProducto").html(result);
                    $("#modalProducto").modal({backdrop: 'static',keyboard:false});     
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

        //añadir nuevo
    $(document).on("click", "#postAddProducto", postAddProducto);
    	function postAddProducto(e){
            e.preventDefault();
            var id_producto = $("#addEditFormProducto_footer #id_producto").val();
            var nombre_producto = $("#addEditFormProducto #nombre_producto").val();
            var codigo_producto = $("#addEditFormProducto #codigo_producto").val();
            var precio_producto = $("#addEditFormProducto #precio_producto").val();
            var data_json = {
                "accion":"postPutProducto",
                "datos":{
                    "id_producto":id_producto,
                    "nombre_producto":nombre_producto,
                    "codigo_producto":codigo_producto,
                    "precio_producto":precio_producto
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_producto") }}',
                type:  'post',
                dataType:'json',
                beforeSend: function () {
                },
                success:  function (result) {
                    if(result.status != undefined && result.status == "correcto"){

                    }else{

                    }
                    $("#modalProducto").modal("hide");    
                    getTableProducto();
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

        //editar cliente
    $(document).on("click", "#putEditProducto", putEditProducto);
    	function putEditProducto(e){
            e.preventDefault();
            var id_producto = $("#addEditFormProducto_footer #id_producto").val();
            var nombre_producto = $("#addEditFormProducto #nombre_producto").val();
            var precio_producto = $("#addEditFormProducto #precio_producto").val();
            var data_json = {
                "accion":"postPutProducto",
                "datos":{
                    "id_producto":id_producto,
                    "nombre_producto":nombre_producto,
                    "codigo_producto":codigo_producto,
                    "precio_producto":precio_producto
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_producto") }}',
                type:  'post',
                dataType:'json',
                beforeSend: function () {
                },
                success:  function (result) {
                    if(result.status != undefined && result.status == "correcto"){

                    }else{

                    }
                    $("#modalProducto").modal("hide");    
                    getTableProducto(); 
                },
                error: function(error){
                    console.log(error);
                }
            });
        }


        /*Buscar*/
    $(document).on("keyup", "#searh_producto", searchTablaProducto);
    $(document).on("click", "#search_tabla_producto", searchTablaProducto);
        function searchTablaProducto(e) {
            e.preventDefault();
            var nombre_producto = $('#searh_producto #searh_nombre_producto').val();
            var data_json = {
                "accion":"searchTablaProducto",
                "datos":{                   
                    "nombre_producto":nombre_producto
                    
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_producto") }}',
                type:  'post',
                dataType:'html',
                beforeSend: function () {
                },
                success:  function (result) {   
                    $('#tabla_producto').html(result);
                    getTableProducto(); 
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

        //carga de la tabla
        function getTableProducto(page) {
        	if(page == undefined){
                var page = 0;
                if ($('#tabla_producto ul.pagination li').hasClass("active") == true) {
                    page = $('#tabla_producto ul.pagination .active .page-link').text();
                }else{
                    page = 1;
                }
            }
            var data_json = {
                "accion":"getTableProducto",
                "page":page,
                "datos":{

                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_producto") }}',
                type:  'post',
                dataType:'html',
                beforeSend: function () {
                    /*$('#tabla_info').html('<div class="col-md-12 text-center"><h3>Cargando Datos ...</h3></div>');*/
                },
                success:  function (result) {
                    $('#tabla_producto').html(result);
                },
                error: function(error){
                    $('#tabla_producto').html('<div class="col-md-12 text-center"><h3>Datos no encontrados</h3></div>');
                    console.log(error);
                }
            });
        }

    $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            getTableProducto($(this).attr('href').split('page=')[1]);
        });
    $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getTableProducto(page);
                }
            }
        });


    //abrir modal para la importacion
    $(document).on("click", "#openModalProducto_ImportExcel", openModalProducto_ImportExcel);
        function openModalProducto_ImportExcel(e){
            e.preventDefault();
            var accion = "openModalProducto_ImportExcel";
            var data_json = {
                "accion":accion,                
                "datos":{
   
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_producto") }}',
                type:  'post',
                dataType:'html',
                beforeSend: function () {
                },
                success:  function (result) {
                    $("#modalImport_Producto").html(result);
                    $("#modalImport_Producto").modal({backdrop: 'static',keyboard:false});     
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

    //subir el archivo para procesarlo
    $(document).on("click", "#importProducto_toExcel", importProducto_toExcel);
        function importProducto_toExcel(e){
            e.preventDefault();
            var form = document.forms.namedItem("FormImportProducto");
            var accion = "importProducto_toExcel";
            var fd = new FormData(form);
            fd.append("accion", accion);

            ajaxSetup();
            $.ajax({
                data:  fd,
                url:   '{{ route("path_ajax_producto") }}',
                type:  'post',
                dataType:'json',
                processData: false,
                contentType: false,
                beforeSend: function () {
                },
                success:  function (result) {
                    if(result.status == "correcto")
                    {
                        openModalProducto_Similares(result.result_producto_similar);
                        $("#modalImport_Producto").modal("hide");
                    }
                    
                },
                error: function(error){
                    console.log(error);
                }

            });
        }

        //en caso de tener datos similares se abrira el modal
        function openModalProducto_Similares(result_producto_similar){
            var accion = "openModalProducto_Similares";
            var data_json = {
                "accion":accion,                
                "datos":{
                    "result_producto_similar":result_producto_similar
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_producto") }}',
                type:  'post',
                dataType:'html',
                beforeSend: function () {
                },
                success:  function (result) {
                    $("#modalImport_Producto_similares").html(result);
                    $("#modalImport_Producto_similares").modal({backdrop: 'static',keyboard:false});
                    getTableProducto();
                },
                error: function(error){
                    console.log(error);
                }
            });
        }


</script>		