<script>
	$(document).on("click", "#contacto_enviar", contacto_enviar);
    	function contacto_enviar(e){
            e.preventDefault();
            var contacto_email = $("#formContacto #contacto_email").val();
            var contacto_asunto = $("#formContacto #contacto_asunto").val();
            var contacto_mensaje = $("#formContacto #contacto_mensaje").val();
            var data_json = {
                "accion":"SendEmailContacto",
                "datos":{
                    "contacto_email":contacto_email,
                    "contacto_asunto":contacto_asunto,
                    "contacto_mensaje":contacto_mensaje
                }
            }
            ajaxSetup();
            $.ajax({
                data:  data_json,
                url:   '{{ route("path_ajax_contacto") }}',
                type:  'post',
                dataType:'json',
                beforeSend: function () {
                },
                success:  function (result) {
                    if(result.status != undefined && result.status == "correcto"){

                    }else{

                    }
                    
                },
                error: function(error){
                    console.log(error);
                }
            });
        }
</script>