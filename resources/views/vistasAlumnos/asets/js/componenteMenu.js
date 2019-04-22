$(document).ready(function(){
    
    var URLactual = window.location.pathname; //utilizada para detemrinar que tab del menu activar
    URLactual = URLactual.split('/').pop();
    URLactual = URLactual.split('.');
    $('.' + URLactual[0] ).addClass('active2');

});

//  componente para mostrar menu si no esta logueado
Vue.component('menu-basico', {
    template: `
    <nav class="navbar navbar-expand-lg navbar-light bg-menu sticky-top">
        <!-- imagen de logo  -->
        <a class="navbar-brand" href="../SitioWeb/index.html">            
            <img src="asets/img/gloriaKriete copia.png" alt="" class="rounded logocds">
            <img src="asets/img/logo-fundacion-borja copia.png" alt="" class="rounded logocds">
            <img src="asets/img/Logo_usaid3 copia.png" alt="" class="rounded logocds">
        </a>
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- links del menu -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item index"> 
                    <a class="nav-link" href="../SitioWeb/index.html">Inicio<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item quienes_somos">
                    <a class="nav-link" href="../SitioWeb/quienes_somos.html">Quienes somos</a>
                </li>
                <li class="nav-item main-publicacion">
                    <a class="nav-link" href="../PublicacionesEventos/main-publicacion.html">Publicaciones y eventos</a>
                </li>
                <li class="nav-item contactanos" >
                    <a class="nav-link" href="../SitioWeb/contactanos.html">Contactanos</a>
                </li>
                <li class="nav-item login2-0">
                    <a class="nav-link btn btn-primary" id="b-sesion" href="../../SitioWeb/login2-0.html">Iniciar Sesion</a>
                </li>
            </ul>

        </div>
    </nav>

`,
});

Vue.component('menu-log', {
    props: ['user','rol','id'],
    template: `
    <nav class="navbar navbar-expand-lg navbar-light bg-menu sticky-top" id="menuA">
        <!-- imagen de logo  -->
        <a class="navbar-brand" href="../../SitioWeb/index.html">
            <img src="asets/img/gloriaKriete copia.png" width="7%" height="7%" alt="" class="rounded logocds">
            <img src="asets/img/logo-fundacion-borja copia.png" width="7%" height="7%" alt="" class="rounded logocds mt-3">
            <img src="asets/img/Logo_usaid3 copia.png" width="7%" height="7%" alt="" class="rounded logo2 mt-3">

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- links del menu -->
            <ul class="navbar-nav ml-auto p-2">
                <li class="nav-item index" >
                    <a class="nav-link " href="../../SitioWeb/index.html">Inicio<span class="sr-only">(current)</span></a>
                </li>
                
                <li class="nav-item contactanos" >
                    <section v-if="rol=='alumno'">
                    <a class="nav-link"  @click="tareaAlumno(id)" >Tareas-Alumno</a> 
                    <div class="dropdown-divider"></div>
                    </section>
                    <a class="nav-link" href="../../GestionTareas/vistasAlumnos/admin.html" >Tareas-Docente</a> 
                </li>
                <li class="nav-item dropdown  mr-5">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{user}}</a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" @click="cerrar">Cerrar Sesi&oacute;n</a>          
                    </div>          
                </li>
            </ul>
        </div>
    </nav>
    
`,
methods:{
    cerrar:function() {
        var acc=sessionStorage.getItem("acceso");
        var acceso=atob(acc);
        axios.post('http://proyectosfgk.org/cdsah/apiRest/public/api/auth/logout',{
                token:acceso,
            })
        .then(response => {
            sessionStorage.removeItem("acceso");
            sessionStorage.removeItem("user");
                    sessionStorage.removeItem("rol");
            window.location="../../SitioWeb/index.html";
        })
        .catch(error => {
            sessionStorage.removeItem("acceso");
            sessionStorage.removeItem("user");
            sessionStorage.removeItem("rol");
            // window.location="login.html";
           
            window.location="../SitioWeb/login2-0.html"; 
        });
    },
    tareaAlumno:function(id) {
        window.location="../GestionTareas/alumno/vistaAlumno.html?="+id;
    }
}
});


new Vue({
    el: "#app",
    data:{
        menuAcceso:true,
        usuario:'',
    },
    created(){
        this.cargar(); 
    },
    methods:{
        cargar: function () {
            var acc=sessionStorage.getItem("acceso");
            if (acc!="" && acc!=null) {
                var acceso=atob(acc);
                axios.post('http://proyectosfgk.org/cdsah/apiRest/public/api/auth/refresh',{
                        token:acceso,
                    })
                .then(response => {
                    sessionStorage.removeItem("acceso");
                    var acceso2=btoa(response.data.access_token);
                    var user=btoa(response.data.user.name);
                    var rol=btoa(response.data.rol.name);
                    var id=btoa(response.data.user.id);
                    sessionStorage.setItem("acceso",acceso2);
                    sessionStorage.setItem("user",user);
                    sessionStorage.setItem("rol",rol);
                    sessionStorage.setItem("identificador",id);
                    // this.usuario=response.data.user.name;
                    this.usuario=atob(sessionStorage.getItem("user"));
                    this.rol=response.data.rol.name;
                    this.id=response.data.user.id;
                    this.menuAcceso=true;
                })
                .catch(error => {
                    sessionStorage.removeItem("acceso");
                    sessionStorage.removeItem("user");
                    sessionStorage.removeItem("rol");
                    sessionStorage.removeItem("identificador",id);
                    // window.location="login.html";
                    this.menuAcceso=false;
                //window.location="login2-0.html"; 
                });
        
            
            }else{
                // this.Acceso=`<menu-basico></menu-basico>`;
                this.menuAcceso=false;
            }
        },


    }

});