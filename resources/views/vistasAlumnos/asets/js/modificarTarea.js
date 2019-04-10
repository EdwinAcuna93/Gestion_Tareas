//---------------Modificar------------------------
function buscarTareaEditar(id){
    $.ajax({
        method: 'get',
        url:'http://192.168.32.132/Gestion_Tareas/public/api/tareas/buscarTarea',
        data:{
            id:id
        },
        success:mostrarTarea,
        error:errorMostrar
    });
}

function mostrarTarea(m){
    let listar = m.tarea[0];
    console.log(listar);
    $('#idM').val(listar.id);
    $('#tituloTareaM').val(listar.tituloTarea);
    $('#prioridadM').val(listar.prioridad);
    $('#descripcionM').val(listar.descripcion);
    $('#estadoM').val(listar.estado);
    $('#fechaM').val(listar.fecha);
}

function errorMostrar(e){
    alert(e);
}

function modificar(){
    let id = $('#idM').val();
    let titulo = $('#tituloTareaM').val();
    let prioridad = $('#prioridadM').val();
    let descripcion = $('#descripcionM').val();
    let estado = $('#estadoM').val();
    let fecha = $('#fechaM').val();

    // console.log(fecha);
    $.ajax({
        method:"put",
        url:"http://192.168.32.132/Gestion_Tareas/public/api/tareas/editarTarea",
        data:{
            id: id,
            tituloTarea: titulo,
            prioridad: prioridad,
            descripcion: descripcion,
            estado: estado,
            
            fecha: fecha,                
            
            users_id: User_id
        },
        success:modificarTarea,
        error:errorModificar
    });
}

function modificarTarea(m){
    // Swal.fire(
    //     'Exito!',
    //     m,
    //     'success'
    //   )
   // alert(m);
   
   if(m=="Tarea modificada con éxito"){
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

function errorModificar(e){
    Swal.fire(
        'Error!',
        'Falló la conexión',
        'error'
    )
}