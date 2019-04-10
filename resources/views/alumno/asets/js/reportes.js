//----------------------------------------------Agregar reporte----------------------------------
$('#enviarReporte').click(function(){
    //peticion para insertar reporte
    // $.ajax({
    //     method:"post",
    //     url:"http://192.168.32.132/Gestion_Tareas/public/api/reportes/insertar",
    //     data:{               
    //         descripcion: $('#redactarReporte').val(),
    //         observacion: " ",
    //         fecha: datoFecha,               
    //         users_id: 1
    //     },
    //     success:reporte,
    //     error:errorReporte
    // })

    //peticion para cambiar el estado de las tareas pendientes a no cumplidas al generar el reporte
    // $.ajax({
    //     method:"put",
    //     url:"http://192.168.32.132/Gestion_Tareas/public/api/tareas/editarEstadoMultiple",
    //     data:{               
    //         fecha: datoFecha,               
    //         users_id: 1
    //     },
    //     success:noCumplidas
    // })

    //Bloquear el textArea y el boton enviar reporte despues de dar click a dicho boton
    // document.getElementById('enviarReporte').disabled=true;
    // document.getElementById('redactarReporte').disabled=true;


      Swal.fire({
        title: 'Esta seguro de generar el reporte?',
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
            url:"http://192.168.32.132/Gestion_Tareas/public/api/reportes/insertar",
            data:{               
                descripcion: $('#redactarReporte').val(),
                observacion: " ",
                fecha: datoFecha,               
                users_id: 1
            },
            success:reporte,
            error:errorReporte

        })

        //peticion para cambiar el estado de las tareas pendientes a no cumplidas al generar el reporte
        $.ajax({
            method:"put",
            url:"http://192.168.32.132/Gestion_Tareas/public/api/tareas/editarEstadoMultiple",
            data:{               
                fecha: datoFecha,               
                users_id: 1
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
    Swal.fire(
        'Exito!',
        'Reporte Insertado y tareas trasladadas a no terminadas',
        'success'
    )
    datos();
    document.getElementById("redactarReporte").value = "";
}

//Error si no se agrego el reporte
function errorReporte(e) {
    // alert('Error reporte: '+e);
    // alert("Error: "+e);
    Swal.fire(
        'Error!',
        'Error al generar el reporte',
        'Error'
    )
    datos();
    
}

//Verificar si el estado de la tarea cambia a No Cumplidas al generar el reporte
function noCumplidas(t) {
    // alert('Error no cumplidas: '+t);
    // Swal.fire(
    //     'Error!',
    //     t,
    //     'error'
    // )
    datos();
}