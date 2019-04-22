
function editarReporte(id){
    $("#observacionMR").val('');
    $.ajax({
        method:"Get",
        url:"http://192.168.32.55/Gestion_Tareas/public/api/reportes/buscarReporte",
        data:{
            id:id
        },
        success:llenarModal,
        error:errorBuscar
    })
}

function llenarModal(r){
    let reporte= r.reporte[0];
    $("#idMR").val(reporte.id);
    $("#descripcionMR").val(reporte.descripcion);
    $("#users_idMR").val(reporte.users_id);
    
    if (reporte.observacion != " ") {
        $("#observacionMR").val(reporte.observacion);   
    }else{

    }    
}

function errorBuscar(){
    Swal.fire(
        'Error!',
        'Falló la conexión',
        'error'
    )
    datos();
}

function modifiReporte(){
    $('#reportes').html("");
    $.ajax({
        method:"Put",
        url: "http://192.168.32.55/Gestion_Tareas/public/api/reportes/modificarReporte",
        data:{
            id:$('#idMR').val(),
            observacion:$("#observacionMR").val()
        },
        success:modificado,
        error: errorModificar
    })
    datos();
}

function modificado(r){
    if(r=="Observación agregada con éxito"){
        Swal.fire(
            'Éxito!',
            r,
            'success'
          )
    }else{
        Swal.fire(
            'Error!',
            r,
            'error'
          )
    }
    datos();
}

function errorModificar(){
    Swal.fire(
        'Error!',
        'Falló la conexión',
        'error'
    )
    datos();
}