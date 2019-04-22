//------------------------------------Modificar estado de la tarea a finalizada-----------------------------
function modificarEstado(id) {
    $.ajax({
        method:"put",
        url:"http://192.168.32.55/Gestion_Tareas/public/api/tareas/editarEstado",
        data:{
            id: id,
            estado: "Finalizada",
            // token: token_desc
        },
        success:modificado,
        error:errorModificar
    });

}

//funcion para verificar si la funcion cambio a finalizada
function modificado(t) {
    datos();
}

//funcion para verificar si la funcion no cambio a finalizada
function errorModificar(e) {
    alert("Error: "+e);
    
}