//------------------------------------Modificar estado de la tarea a finalizada-----------------------------
function modificarEstado(id) {
    
    // $("#"+id+"").toggleClass("bg-danger");

    
    $.ajax({
        method:"put",
        url:"http://192.168.32.132/Gestion_Tareas/public/api/tareas/editarEstado",
        data:{
            id: id,
            estado: "Finalizada",
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