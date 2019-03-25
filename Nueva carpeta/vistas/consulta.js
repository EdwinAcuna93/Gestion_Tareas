
  $(document).ready(datos);

  function datos() {
      $.ajax({
          method:"Get",
          url:"http://192.168.32.105/apiRest/public/api/tareas/tareas",
          success:ok,
          error:error
      });
  }

  function ok(r) {
      let listar = r.tarea;
     listar.forEach(element => {
      // alert(element.prioridad);
      switch (element.prioridad) {
        case 'Alta':
                        $("#contenedor").append('<div class="alert alert-danger text-center" role="alert">'
                                  +"Titulo: "+element.tituloTarea+"<br>"
                                  +"Descripción: "+element.descripcion+'</div>');
          break;

          case 'Media':
                        $("#contenedor").append('<div class="alert alert-warning text-center" role="alert">'
                                  +"Titulo: "+element.tituloTarea+"<br>"
                                  +"Descripción: "+element.descripcion+'</div>');
          break;

          case 'Baja':
                        $("#contenedor").append('<div class="alert alert-success text-center" role="alert">'
                                  +"Titulo: "+element.tituloTarea+"<br>"
                                  +"Descripción: "+element.descripcion+'</div>');
          break;
      
        default:
          break;
      }
     });
  //$("#contenedor").text(JSON.stringify(r));

  ///
  }

  function error(r) {
      alert("Error: "+r);
  }
