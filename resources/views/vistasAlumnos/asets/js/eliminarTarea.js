//---------------Eliminar------------------------
function buscarTareaEliminar(id){
    $.ajax({
        method: 'get',
        url:'http://192.168.32.132/Gestion_Tareas/public/api/tareas/buscarTarea',
        data:{
            id:id
        },
        success:mostrarTareaEliminar,
        error:errorMostrarEliminar
    });
}

function mostrarTareaEliminar(m){
    let listar = m.tarea[0];
    console.log(listar);
    $('#idE').val(listar.id);
    $('#tituloTareaE').show().html(listar.tituloTarea);
    $('#prioridadE').show().html(listar.prioridad);
    $('#descripcionE').show().html(listar.descripcion);
    $('#estadoE').show().html(listar.estado);
    $('#fechaE').show().html(listar.fecha);
}

function errorMostrarEliminar(e){
    alert(e);
}

function eliminar(){
    let id = $('#idE').val();
    console.log("Id Eliminar: "+id);

    // console.log(fecha);
    $.ajax({
        method:"delete",
        url:"http://192.168.32.132/Gestion_Tareas/public/api/tareas/eliminarTarea",
        data:{
            id: id
        },
        success:eliminarTarea,
        error:errorModificar
    });
}

function eliminarTarea(m){
    // Swal.fire(
    //     'Exito!',
    //     m,
    //     'success'
    //   )
   // alert(m);
    // 

    if(m=="Tarea eliminada con éxito"){
        Swal.fire(
            'Exito!',
            m,
            'success'
        )
    }else{
        Swal.fire(
            'Error!',
            m,
            'error'
        )
    }

    datos();
}

function errorEliminar(e){
    Swal.fire(
        'Error!',
        'Falló la conexión',
        'error'
    )
    datos();
}