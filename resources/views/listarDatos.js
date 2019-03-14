
                    $(document).ready(inicio);

                    function inicio(){                                   
                      listar();
                    }
                     
                    function listar(){
                        $.ajax({
                            method:"Get",
                            url:"http://127.0.0.1:8000/api/tareas/listar",
                             success:function(dato){                       
                                 console.log(dato);
                                 var listar = "";   
                                 dato.forEach(element => {
                                 listar = listar+'<tr>'+'<td>'+element.id+'</td>'+
                                                        '<td>'+element.tituloTarea+'</td>'+
                                                        '<td>'+element.prioridad+'</td>'+
                                                        '<td>'+element.descripcion+'</td>'+'</tr>';
                            });
                            $("#mostrar").html(listar);            
                             },
                            error:function(data){
                                alert("Error al iniciar session: "+data.error);
                            }

                        });
                    }
                    
                    // listar.forEach(element => {
                    //     console.log(element);
                    // });