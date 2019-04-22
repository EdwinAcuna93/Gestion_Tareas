//Funcion para calcular la fecha actual
Date.prototype.toString = function() {

    var yy =  this.getFullYear();//Extrae la el año actual
    var mm = this.getMonth()+1;//Extrae el mes actual
    var dd = this.getDate();//Extrae el dia actual

    //Valida si el mes es menor a 10 le agrega un cero
    if(mm<10) {
        mm='0'+mm;
    }

    //Valida si el dia es menor a 10 le agrega un cero
    if(dd<10) {
        dd='0'+dd;
    }    
    return yy+"/"+mm+"/"+dd; 
}

let miFecha = new Date(); //Llamar a la funcion Date
let datoFecha = miFecha ;//Asignar a una variable el resultado de la funcion
let url = document.location.href;//Obtener la url donde se envia el id y nombre del alumno
let idUsuario = url.split("=");//Cortar la url cuando encuentre el signo de "="
let User_id = idUsuario[1];//Obtener el valor del indice uno que contiene el id del alumno
let name = idUsuario[2];//Obter el valor del indice dos que contiene el nombre del alumno
let uri_dec = decodeURIComponent(name);//Decodificar el valor del nombre del alumno si tiene caracteres especiales
$('#usuario').append(uri_dec);//Asignar el valor codificado del nombre del alumno al div con id usuario


$(document).ready(datos);

function datos() {
    //Mostrar el date picker
    $(function() { $("#calendario").datepicker({ dateFormat: "yy/mm/dd"}); 
    
    //Peticion para listar las tareas por fecha de datepicker
    $("#calendario").on("change",
        function(){ 
            datoFecha = $(this).val(); 
            //Tareas Diarias y reportes
            $.ajax({
                method:"get",
                url:"http://192.168.32.55/Gestion_Tareas/public/api/tareas/tareasDiarias",
                data:{
                    users_id: User_id,
                    fecha: datoFecha
                    // token: token_desc
                },
                success:pendiente,
                error:errorTareas
            });            
        }); 
    });

    
    //Tareas Diarias y reportes
    $.ajax({
        method:"get",
        url:"http://192.168.32.55/Gestion_Tareas/public/api/tareas/tareasDiarias",
        data:{
            users_id: User_id,
            fecha: datoFecha
            // token: token_desc
        },
        success:pendiente,
        error:errorTareas
    });

    //Cambiar a tareas no cumplidas al entrar no borrar y decir a Edwin que cambie el nombre del metodo
    $.ajax({
        method:"put",
        url:"http://192.168.32.55/Gestion_Tareas/public/api/tareas/editarEstadoDiasAtras",
        data:{
            users_id: User_id,
            fecha: datoFecha
            // token: token_desc
        }
    });
}

//--------------------------------------Tareas Pendientes-----------------------------------------------
//funcion peticion lista las tareas y reportes diarios
function pendiente(r) {

    let listar = r.tarea; //Asignar a la varianble listar el json de las tareas pendientes
    let reportesDiarios = r.reporte;//Asignar a la varianble reportesDiarios el json de las reportes diarios
   
    //Limpiar los contenedores
    $("#EstadoPendiente").html("");
    $("#EstadoFinalizada").html("");
    $("#EstadoNoTerminadas").html("");
    $("#reportes").html("");
    //Listar las tareas diarias pendientes
    listar.forEach(element => {

        //Verificar el estado de la tarea si es pendiente, finalizada o no terminada
        switch (element.estado) {
            //Generar las tareas pendientes
            case 'Pendiente':                    
                $("#EstadoPendiente").append('<div class="card  border-primary ">'
                            +'<div id='+element.tituloTarea+' class="d-flex mb-3 bg-primary text-white">'
                            +'<div class="p-2 mr-auto">'+element.tituloTarea+'</div>'
                            +'<div class="btn-group btn-group-toggle">'
                            +'<button id='+element.id+' onclick="buscarTareaEditar('+element.id+')" class="btn btn-primary p-2 " data-toggle="modal" data-target="#modificarTarea" title="Editar Tarea"><i class="fas fa-pencil-alt"></i></button>'
                            +'<button id='+element.id+' onclick="buscarTareaEliminar('+element.id+')" class="btn btn-primary p-2t" data-toggle="modal" data-target="#eliminarTarea"><i class="fas fa-trash-alt" title="Eliminar Tarea"></i></button>'
                            +'</div>'

                            +'</div>'
                            +'<div id='+element.tituloTarea+' class="card-body text-primary ">'
                            +'<p class="card-text">'+element.descripcion+'</p>'
                            +'</div>'
                            +'</div><br>');

            break;

            //Generar las tareas finalizadas
            case 'Finalizada':
                $("#EstadoFinalizada").append('<div class="card  border-info ">'
                            +'<div  class="d-flex mb-3 bg-info text-white">'
                            +'<div class="p-2 mr-auto">'+element.tituloTarea+'</div>'
                            +'</div>'
                            +'<div class="card-body text-info">'
                            +'<p class="card-text">'+element.descripcion+'</p>'
                            +'</div>'
                            +'</div><br>');
            break;

            //Generar las tareas no terminadas
            case 'Incumplida':                 
                $("#EstadoNoTerminadas").append('<div class="card  border-danger ">'
                            +'<div class="d-flex mb-2 bg-danger text-white">'
                            +'<div class="p-2 mr-auto">'+element.tituloTarea+'</div>'
                            +'<div class="btn-group btn-group-toggle">'
                            +'<button id='+element.id+' onclick="buscarReasignar('+element.id+')" class="btn btn-danger p-2 " data-toggle="modal" data-target="#reasignarTarea" title="Re-Asignar Tarea"><i class="fas fa-reply"></i></button>'
                            +'</div>'
                            +'</div>'
                            +'<div class="card-body text-danger">'
                            +'<p class="card-text">'+element.descripcion+'</p>'
                            +'</div>'
                            +'</div><br>');
            break; 

            default:                
            break;
        }        
    });
    
    //Listar los reportes diarios
    reportesDiarios.forEach(element => {
        $("#reportes").append('<div class="card  border-success ">'
                            +'<div class="d-flex mb-2 bg-success text-white">'
                            +'<div class="p-2 mr-auto">'+'</div>'
                            +'<div class="btn-group btn-group-toggle">'
                            +'<button id='+element.id+' onclick="editarReporte('+element.id+')" class="btn btn-success p-2 " title="Editar Reporte" data-toggle="modal" data-target="#modificarReporte"><i class="fas fa-pencil-alt"></i></button>'
                            +'</div>'
                            +'</div>'
                            +'<div class="card-body text-success">'
                            +'<b>Descripción:'+'</b>'
                            +'<p class="card-text">'+element.descripcion+'</p>'
                            +'<b>Observación:'+'</b>'
                            +'<p class="card-text">'+element.observacion+'</p>'
                            +'</div>'
                            +'</div><br>');
    });
}

//Funcion si la peticion ajax tiene algun error
function errorTareas(r) {    
    Swal.fire(
        'Error!',
        'Falló la conexión',
        'error'
    )
}