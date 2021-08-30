

document.addEventListener('DOMContentLoaded',function(){   

    eventListeners();

});

function eventListeners(){

    //registrar evento para administradores
    const btCrearAdmin = document.querySelector('#form-crear-admin button');
    if(btCrearAdmin){ 
        btCrearAdmin.addEventListener("click",abmAdmin);
    }
    const btEliminar = document.querySelectorAll('.borrar-registro');
    if(btEliminar){ 
        btEliminar.forEach(boton => {

            boton.addEventListener("click",abmAdmin);

        });
    }

    //registrar evento para eventos
    const btCrearEvento = document.querySelector('#form-crear-evento button');
    if(btCrearEvento){ 
        btCrearEvento.addEventListener("click",abmEvento);
    }
    const btEliminarEvento = document.querySelectorAll('.borrar-evento');
    if(btEliminarEvento){ 
        btEliminarEvento.forEach(boton => {

            boton.addEventListener("click",abmEvento);

        });
    }

    //registrar evento para categorias
    const btCrearCategoria = document.querySelector('#form-crear-categoria button');
    if(btCrearCategoria){ 
        btCrearCategoria.addEventListener("click",abmCategoria);
    }
    const btEliminarCategoria = document.querySelectorAll('.borrar-categoria');
    if(btEliminarCategoria){ 
        btEliminarCategoria.forEach(boton => {

            boton.addEventListener("click",abmCategoria);

        });
    }

    //registrar evento para Invitados
    const btCrearInvitado = document.querySelector('#form-crear-invitado button');
    if(btCrearInvitado){ 
        btCrearInvitado.addEventListener("click",abmInvitado);
    }
    const btEliminarInvitado = document.querySelectorAll('.borrar-invitado');
    if(btEliminarInvitado){ 
        btEliminarInvitado.forEach(boton => {

            boton.addEventListener("click",abmInvitado);

        });
    }
};

function abmAdmin(e){
    e.preventDefault();

    let accion;
    let usuario;
    let nombre;
    let password;
    let repetirPassword;
    let imagen;
    let id = '';
    
    if(e.target.getAttribute('data-accion')=== 'eliminar' || e.target.parentElement.getAttribute('data-accion') === 'eliminar'){
        accion = 'eliminar';
        id = e.target.getAttribute('data-id') || e.target.parentElement.getAttribute('data-id');

    } else {
        accion = document.querySelector('#accion').value;
        usuario = document.querySelector('#usuario').value;
        nombre = document.querySelector('#nombre').value;
        password = document.querySelector('#password').value;
        repetirPassword = document.querySelector('#repetir-password').value;
        imagen = document.querySelector('#imagen').value;

    }
    
    if(password === repetirPassword){
        if(accion === 'crear'){
        
            // validar que todos los campos estén llenos
            if(usuario !== '' && nombre !== '' && password !== ''){
                
                guardarUsuario(usuario,nombre,imagen,password,accion,id);   
    
            }
            else {
    
                swal({
                    title: 'Error',
                    text: 'Usuario, Nombre y Password son obligatorios',
                    type: 'error'
                })
                .then (result => {
                    if(result.value){
                        document.querySelector('#usuario').focus();
                    }
                });
                
            }
        } else {
            
            if(accion === 'actualizar'){
                
                guardarUsuario(usuario,nombre,imagen,password,accion,id);
                
            } 
            if(accion === 'eliminar'){
    
                Swal.fire({
                    title: 'Estás Seguro?',
                    text: "No podrás recuperar este Administrador!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'SI, quiero eliminarlo!',
                    cancelButtonText: 'cancelar'
                  }).then((result) => {
                    if (result.value) {
                        // eliminar el registro del dom
                        guardarUsuario(usuario,nombre,imagen,password,accion,id);
                        const registroBorrar = document.querySelector(`#registro-${id}`);
                        registroBorrar.parentElement.removeChild(registroBorrar);
                       
                        Swal.fire(
                        'Borrada!',
                        `Administrador ID ${id} eliminado exitosamente`,
                        'success'
                      )
                    }
                  });
            }   
        }
    } else {
        const resultadoPassword = document.querySelector('#resultado-password'); 
        const inputPassword = document.querySelector('#password');
        const inputRepetirPassword = document.querySelector('#repetir-password');
        resultadoPassword.textContent = 'Las Passwords no coinciden';
        inputPassword.classList.add('error');
        inputRepetirPassword.classList.add('error');

    }
}

function guardarUsuario(usuario,nombre,imagen,password,accion,id){

    if(id === ''){
        id = document.querySelector('#admin-id').value;
    }

    // ajax 
    let xhr = new XMLHttpRequest();

    // armamos un FormData para pasar los datos
    let datos = new FormData();
    datos.append('usuario[usuario]',usuario);
    datos.append('usuario[nombre]',nombre);
    datos.append('usuario[imagen]',imagen);
    datos.append('usuario[password]',password);
    datos.append('accion',accion);
    datos.append('id',id);

    // abrimos la conexion
    xhr.open('POST','/admin/crear',true);

    // on load
    xhr.onload = function(){
        
        if(this.status === 200){
            //console.log(xhr.responseText);
            let respuesta = JSON.parse(xhr.responseText);

            if(respuesta.respuesta === 'exito'){
                if(respuesta.tipo === 'crear'){
                    
                    swal({
                        title: 'Administrador Creado',
                        text: respuesta.texto,
                        type: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    
                    document.querySelector('#usuario').value = '';
                    document.querySelector('#nombre').value = '';
                    document.querySelector('#password').value = '';
                    document.querySelector('#imagen').value = '';

                } else if(respuesta.tipo === 'actualizar') {
                    
                    swal({
                        title: 'Administrador Actualizado',
                        text: respuesta.texto,
                        type: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    window.location.href = 'listar';

                }
                
            } else {
                swal({
                    title: 'Error',
                    text: respuesta.texto,
                    type: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });    
            }
        }
    };

    // mandamos los datos al servidor
    xhr.send(datos);
}

// Funciones para Eventos
function abmEvento(e){
    e.preventDefault();

    let accion;
    let nombre_evento;
    let fecha_evento;
    let hora_evento;
    let clave;
    let categoria_id;
    let invitado_id;
    let evento_id = '';

    //inicializamos un formdata
    let datos = new FormData();

    if(e.target.getAttribute('data-accion')=== 'eliminar' || e.target.parentElement.getAttribute('data-accion') === 'eliminar'){
        accion = 'eliminar';
        evento_id = e.target.getAttribute('data-id') || e.target.parentElement.getAttribute('data-id');
        console.log(evento_id);
        datos.append('accion',accion);
        datos.append('id',evento_id);

    } else {
        accion = document.querySelector('#accion').value;
        nombre_evento = document.querySelector('#nombre_evento').value;
        fecha_evento = document.querySelector('#fecha_evento').value;
        hora_evento = document.querySelector('#hora_evento').value;
        clave = document.querySelector('#clave').value;
        categoria_id = document.querySelector('#categorias').value;
        invitado_id = document.querySelector('#invitados').value;

        // armamos un FormData para pasar los datos
        datos.append('evento[nombre_evento]',nombre_evento);
        datos.append('evento[fecha_evento]',fecha_evento);
        datos.append('evento[hora_evento]',hora_evento);
        datos.append('evento[clave]',clave);
        datos.append('evento[categoria_id]',categoria_id);
        datos.append('evento[invitado_id]',invitado_id);
        datos.append('accion',accion);
        datos.append('id',evento_id);
    }
    
    if(accion === 'crear'){

        // validar que todos los campos estén llenos
        if(nombre_evento !== '' && fecha_evento !== '' && hora_evento !== '' && clave !== '' && categoria_id !== '' && invitado_id !== ''){
            
            guardarEvento(datos);   
        }
        else {
            
            swal({
                title: 'Error',
                text: 'Todos los campos son obligatorios',
                type: 'error'
            })
            .then (result => {
                if(result.value){
                    document.querySelector('#nombre_evento').focus();
                }
            });
            
        }
    } else {
        
        if(accion === 'actualizar'){
            
            guardarEvento(datos);
            
        } 
        if(accion === 'eliminar'){

            Swal.fire({
                title: 'Estás Seguro?',
                text: "No podrás recuperar este Evento!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, quiero eliminarlo!',
                cancelButtonText: 'cancelar'
                }).then((result) => {
                if (result.value) {
                    // eliminar el registro del dom
                    guardarEvento(datos);
                    const registroBorrar = document.querySelector(`#registro-${evento_id}`);
                    registroBorrar.parentElement.removeChild(registroBorrar);
                    
                    Swal.fire(
                    'Borrada!',
                    `Evento ID ${id} eliminado exitosamente`,
                    'success'
                    )
                }
                });
        }   
    }
    
}

function guardarEvento(datos){

    if(datos.get('id') === '' || datos.get('id') === null){
        evento_id = document.querySelector('#evento-id').value;
        datos.append('id',evento_id);
    }

    // ajax 
    let xhr = new XMLHttpRequest();

    // abrimos la conexion
    xhr.open('POST','/evento/crear',true);

    // on load
    xhr.onload = function(){
        
        if(this.status === 200){
            console.log(xhr.responseText);
            let respuesta = JSON.parse(xhr.responseText);

            if(respuesta.respuesta === 'exito'){
                if(respuesta.tipo === 'crear'){
                    
                    swal({
                        title: 'Evento Creado',
                        text: respuesta.texto,
                        type: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    
                    document.querySelector('#nombre_evento').value = '';
                    document.querySelector('#fecha_evento').value = '';
                    document.querySelector('#hora_evento').value = '';
                    document.querySelector('#clave').value = '';
                    document.querySelector('#categoria_id').value = '';
                    document.querySelector('#invitado').value = '';

                } else if(respuesta.tipo === 'actualizar') {
                    
                    swal({
                        title: 'Evento Actualizado',
                        text: respuesta.texto,
                        type: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    window.location.href = 'listar';

                }
                
            } else {
                swal({
                    title: 'Error',
                    text: respuesta.texto,
                    type: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });    
            }
        }
    };

    // mandamos los datos al servidor
    xhr.send(datos);
}

// Funciones para Categorias
function abmCategoria(e){
    e.preventDefault();

    let accion;
    let cat_evento;
    let icono;
    let categoria_id = '';

    //inicializamos un formdata
    let datos = new FormData();

    if(e.target.getAttribute('data-accion')=== 'eliminar' || e.target.parentElement.getAttribute('data-accion') === 'eliminar'){
        accion = 'eliminar';
        categoria_id = e.target.getAttribute('data-id') || e.target.parentElement.getAttribute('data-id');
        
        datos.append('accion',accion);
        datos.append('id',categoria_id);

    } else {
        accion = document.querySelector('#accion').value;
        cat_evento = document.querySelector('#cat_evento').value;
        icono = document.querySelector('#icono').value;

        // armamos un FormData para pasar los datos
        datos.append('categoria[cat_evento]',cat_evento);
        datos.append('categoria[icono]',icono);
        datos.append('accion',accion);
        datos.append('id',categoria_id);
    }
    
    if(accion === 'crear'){

        // validar que todos los campos estén llenos
        if(cat_evento !== '' && icono !== ''){
            
            guardarCategoria(datos);   
        }
        else {
            
            swal({
                title: 'Error',
                text: 'Todos los campos son obligatorios',
                type: 'error'
            })
            .then (result => {
                if(result.value){
                    document.querySelector('#cat_evento').focus();
                }
            });
            
        }
    } else {
        
        if(accion === 'actualizar'){
            
            guardarCategoria(datos);
            
        } 
        if(accion === 'eliminar'){

            Swal.fire({
                title: 'Estás Seguro?',
                text: "No podrás recuperar esta Categoría!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, quiero eliminarla!',
                cancelButtonText: 'cancelar'
                }).then((result) => {
                if (result.value) {
                    // eliminar el registro del dom
                    guardarCategoria(datos);
                    const registroBorrar = document.querySelector(`#registro-${categoria_id}`);
                    registroBorrar.parentElement.removeChild(registroBorrar);
                    
                    Swal.fire(
                    'Borrada!',
                    `Categoría ID ${id} eliminada exitosamente`,
                    'success'
                    )
                }
                });
        }   
    }
    
}

function guardarCategoria(datos){

    if(datos.get('id') === '' || datos.get('id') === null){
        categoria_id = document.querySelector('#categoria-id').value;
        datos.append('id',categoria_id);
    }

    // ajax 
    let xhr = new XMLHttpRequest();

    // abrimos la conexion
    xhr.open('POST','/categoria/crear',true);

    // on load
    xhr.onload = function(){
        
        if(this.status === 200){
            //console.log(xhr.responseText);
            let respuesta = JSON.parse(xhr.responseText);

            if(respuesta.respuesta === 'exito'){
                if(respuesta.tipo === 'crear'){
                    
                    swal({
                        title: 'Categoría Creada',
                        text: respuesta.texto,
                        type: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    
                    document.querySelector('#cat_evento').value = '';
                    document.querySelector('#icono').value = '';
                    
                } else if(respuesta.tipo === 'actualizar') {
                    
                    swal({
                        title: 'Categoría Actualizada',
                        text: respuesta.texto,
                        type: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    window.location.href = 'listar';

                }
                
            } else {
                swal({
                    title: 'Error',
                    text: respuesta.texto,
                    type: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });    
            }
        }
    };

    // mandamos los datos al servidor
    xhr.send(datos);
}

// Funciones para Invitados
function abmInvitado(e){
    e.preventDefault();

    let nombre;
    let apellido;
    let descripcion;
    let url_imagen;
    let invitado_id = '';

    //inicializamos un formdata
    let datos = new FormData();

    if(e.target.getAttribute('data-accion')=== 'eliminar' || e.target.parentElement.getAttribute('data-accion') === 'eliminar'){
        accion = 'eliminar';
        invitado_id = e.target.getAttribute('data-id') || e.target.parentElement.getAttribute('data-id');
        
        datos.append('accion',accion);
        datos.append('id',invitado_id);

    } else {

        // almacenamos los datos del formulario
        let formSubir = document.querySelector('#form-crear-invitado');

        datos = new FormData(formSubir);

        accion = document.querySelector('#accion').value;
      
    }
    
    if(accion === 'crear'){

        // validar que todos los campos estén llenos
        if(nombre !== '' && apellido !== '' && descripcion !== ''){
            
            guardarInvitado(datos);   
        }
        else {
            
            swal({
                title: 'Error',
                text: 'Todos los campos son obligatorios',
                type: 'error'
            })
            .then (result => {
                if(result.value){
                    document.querySelector('#nombre_invitado').focus();
                }
            });
            
        }
    } else {
        
        if(accion === 'actualizar'){
            
            guardarInvitado(datos);
            
        } 
        if(accion === 'eliminar'){

            Swal.fire({
                title: 'Estás Seguro?',
                text: "No podrás recuperar este Invitado!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, quiero eliminarlo!',
                cancelButtonText: 'cancelar'
                }).then((result) => {
                if (result.value) {
                    // eliminar el registro del dom
                    guardarInvitado(datos);
                    const registroBorrar = document.querySelector(`#registro-${invitado_id}`);
                    registroBorrar.parentElement.removeChild(registroBorrar);
                    
                    Swal.fire(
                    'Borrada!',
                    `Invitado ID ${id} eliminado exitosamente`,
                    'success'
                    )
                }
                });
        }   
    }
    
}

function guardarInvitado(datos){


    if(datos.get('id') === '' || datos.get('id') === null){
        invitado_id = document.querySelector('#invitado-id').value;
        datos.append('id',invitado_id);
    }

    // ajax 
    let xhr = new XMLHttpRequest();

    // abrimos la conexion
    xhr.open('POST','/invitado/crear',true);

    // on load
    xhr.onload = function(){
        
        if(this.status === 200){
            console.log(xhr.responseText);
            let respuesta = JSON.parse(xhr.responseText);

            if(respuesta.respuesta === 'exito'){
                if(respuesta.tipo === 'crear'){
                    
                    swal({
                        title: 'Invitado Creado',
                        text: respuesta.texto,
                        type: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    
                    document.querySelector('#nombre_invitado').value = '';
                    document.querySelector('#apellido_invitado').value = '';
                    document.querySelector('#descripcion').value = '';
                    
                    
                } else if(respuesta.tipo === 'actualizar') {
                    
                    swal({
                        title: 'Invitado Actualizado',
                        text: respuesta.texto,
                        type: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    window.location.href = 'listar';

                }
                
            } else {
                swal({
                    title: 'Error',
                    text: respuesta.texto,
                    type: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });    
            }
        }
    };

    // mandamos los datos al servidor
    xhr.send(datos);
}
