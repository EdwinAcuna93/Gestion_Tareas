//----------------------------------------------Agregar reporte----------------------------------
$('#enviarReporte').click(function(){
      Swal.fire({
        title: 'Está seguro de generar el reporte?',
        text: "Al generar el reporte las tareas pendientes pasaran a no terminadas!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
      }).then((result) => {
        if (result.value) {
        //peticion para insertar reporte
        $.ajax({
            method:"post",
            url:"http://192.168.32.55/Gestion_Tareas/public/api/reportes/insertar",
            data:{               
                descripcion: $('#redactarReporte').val(),
                observacion: " ",
                fecha: datoFecha,               
                users_id: 1
                // token: token_desc
            },
            success:reporte,
            error:errorReporte

        })

        //peticion para cambiar el estado de las tareas pendientes a no cumplidas al generar el reporte
        $.ajax({
            method:"put",
            url:"http://192.168.32.55/Gestion_Tareas/public/api/tareas/editarEstadoMultiple",
            data:{               
                fecha: datoFecha,               
                users_id: 1
                // token: token_desc
            },
            success:noCumplidas
        })

        //Bloquear el textArea y el boton enviar reporte despues de dar click a dicho boton
        document.getElementById('enviarReporte').disabled=true;
        document.getElementById('redactarReporte').disabled=true;

        }else{
            document.getElementById("redactarReporte").value = "";
        }
      })
    
});

//Verificar si se agrego el reporte
function reporte(v) {
    // alert('Envio Reporte: '+v);
    if(v=="Reporte insertado con éxito"){
        Swal.fire(
            'Éxito!',
            v,
            'success'
          )
    }else{
        Swal.fire(
            'Error!',
            v,
            'error'
          )
    }
    datos();
    document.getElementById("redactarReporte").value = "";
}

//Error si no se agrego el reporte
function errorReporte(e) {
    Swal.fire(
        'Error!',
        'Error al generar el reporte',
        'Error'
    )
    datos();
    
}

//Verificar si el estado de la tarea cambia a No Cumplidas al generar el reporte
function noCumplidas(t) {
    datos();
}