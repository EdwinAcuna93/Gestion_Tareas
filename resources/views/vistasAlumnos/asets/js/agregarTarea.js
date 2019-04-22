 // cuando se presione el boton se llama a la funcion para añadir una nueva tarea  
 $('#submit').click(function(){
    agregar();
});

//Limpiar inputs y textArea del modal agregar
function limpiarAgregar(){
    
    document.getElementById('tituloTarea').value="";
    document.getElementById('descripcion').value="";
    document.getElementById('fecha').value="";

}
// funcion para agregar una tarea nueva
function agregar(){


    $.ajax({
        method:"post",
        url:"http://192.168.32.55/Gestion_Tareas/public/api/tareas/insertarTarea",
        data:{
            tituloTarea: $('#tituloTarea').val(),
            prioridad: $('#prioridad').val(),
            descripcion: $('#descripcion').val(),
            estado: "Pendiente",                
            fecha: $('#fecha').val(),               
            users_id: User_id
            // token: token_desc
        },
        success:mensaje,
        error:error
    })
}
function mensaje(r){    
    if(r=="Tarea insertada con éxito"){
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
function error(r){
    Swal.fire(
        'Error!',
        'Falló la conexión',
        'error'
    )
    datos();
}