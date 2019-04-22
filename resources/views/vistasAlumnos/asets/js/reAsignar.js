//---------------Re-Asignar tarea------------------------
function buscarReasignar(id){
    console.log('Buscar tareas por id: '+id);
    $.ajax({
        method: 'get',
        url:'http://192.168.32.55/Gestion_Tareas/public/api/tareas/buscarTarea',
        data:{
            id:id
        },
        success:reAsignarTarea,
        error:errorReAsignar
    });
}

function reAsignarTarea(m){
    let listar = m.tarea[0];
    console.log(listar);
    $('#idR').val(listar.id);
    $('#tituloTareaR').val(listar.tituloTarea + " (Tarea Reasignada)");
    $('#prioridadR').val(listar.prioridad);
    $('#descripcionR').val(listar.descripcion);
}

function errorReAsignar(e){
    alert(e);
}

function reAsignar(){
    let id = $('#idR').val();
    let titulo = $('#tituloTareaR').val();
    let prioridad = $('#prioridadR').val();
    let descripcion = $('#descripcionR').val();
    let fecha = $('#fechaR').val();

    // console.log(fecha);
    $.ajax({
        method:"post",
        url:"http://192.168.32.55/Gestion_Tareas/public/api/tareas/insertarTarea",
        data:{
            tituloTarea: $('#tituloTareaR').val(),
            prioridad: $('#prioridadR').val(),
            descripcion: $('#descripcionR').val(),
            estado: "Pendiente",  
            fecha: $('#fechaR').val(),                
            users_id: User_id
        },
        success:reAsignarTareaExito,
        error:errorReAsignar
    });
}

function reAsignarTareaExito(m){
    if(m=="Tarea insertada con éxito"){
        Swal.fire(
            'Éxito!',
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

function errorReAsignar(e){
    Swal.fire(
        'Error!',
        'Falló la conexión',
        'error'
    )
    datos();
}