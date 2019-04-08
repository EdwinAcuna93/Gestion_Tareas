//----------------------------------------------Agregar reporte----------------------------------
$('#enviarReporte').click(function(){
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
    document.getElementById('enviarReporte').disabled=true;
    document.getElementById('redactarReporte').disabled=true;
});

//Verificar si se agrego el reporte
function reporte(v) {
    alert('Envio Reporte: '+v);
    datos();
    document.getElementById("redactarReporte").value = "";
}

//Error si no se agrego el reporte
function errorReporte(e) {
    alert('Error reporte: '+e);
    alert("Error: "+e);
    
}

//Verificar si el estado de la tarea cambia a No Cumplidas al generar el reporte
// function noCumplidas(t) {
//     alert('Error no cumplidas: '+t);
//     datos();
// }