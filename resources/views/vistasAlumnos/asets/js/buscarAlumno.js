$(document).ready(function() {
    $('#mostrar').DataTable( {
        "language": {
            "lengthMenu": "Mostrar _MENU_ ",
            "zeroRecords": "Datos no encontrados - upss",
            "info": "Mostar páginas _PAGE_ de _PAGES_",
            "infoEmpty": "Datos no encontrados",
            "infoFiltered": "(Filtrados por _MAX_ total registros)",
            "search":         "Buscar:",
            "paginate": {
                    "first":      "First",
                    "last":       "Anterior",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
            },
            "bDestroy":true,
            "iDisplayLength":10,
            "searching": false
        }
    } );

   
    
} );


//id
let id_user = sessionStorage.getItem("identificador");
let id = atob(id_user);

//token
let token = sessionStorage.getItem("acceso");
let token_desc = atob(token);
console.log('Token recibido: '+token_desc);

//rol
let rol = sessionStorage.getItem("rol");
let rol_desc = atob(rol);

//user
let user = sessionStorage.getItem("user");
let user_desc = atob(user);

//Peticion ajax para mostrar todos los usuarios
$.ajax({
method:"get",
url:"http://192.168.32.55/Gestion_Tareas/public/api/tareas/usuarios",
// data:{
//     token: token_desc
// },
success:usuarios,
error:errorUsuarios
});

function usuarios(u){
let listar = u.datos;
var t = $('#mostrar').DataTable();

listar.forEach(element => {
    t.row.add( [
        element.id,
        element.name,
        element.email,
        '<button id='+element.id+' onclick="enviar('+ element.id+',\''+element.name+'\')" class="btn btn-secondary btn-sm" >Ver perfil del alumno</button>'
     ] ).draw( false );
});

}

function errorUsuarios(e){    
    Swal.fire(
        'Error!',
        'Falló la conexión',
        'error'
    )
}

function enviar(id, name){
console.log(id);
console.log(name);    
document.location.href = "alumno.html?="+id+'='+name;
}  