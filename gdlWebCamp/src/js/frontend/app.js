(function (){
    'use strict';
})();

let mensajeError = {};

document.addEventListener('DOMContentLoaded', function(){

    // Lettering
    $('.nombre-sitio').lettering();

    // agregar Mapa con Leaflet
    if(document.querySelector('#map')){
        let map = L.map('map').setView([-31.657509, -63.898695], 17);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([-31.657509, -63.898695]).addTo(map)
            .bindPopup('GDLWEBCAMP 2021')
            .openPopup()
            .bindTooltip('un tooltip')
            .openTooltip()
            ;
        }

    const btnPagar = document.querySelector('#btnRegistro');
    if(btnPagar){
        btnPagar.disabled = true;
    }

    eventListeners();

    cuentaRegresiva();
    navegacionFija();
    colorBoxInvitados();
    enlaceActivo();
});

function eventListeners(){

    
    const contadorDIV = document.querySelector(".contenido-contador");
    if(contadorDIV){
        contadorDIV.addEventListener('mouseenter',contador);
    }
    
    const mobileMenu = document.querySelector('.mobile-menu');
    if(mobileMenu){
        mobileMenu.addEventListener('click',navegacionResponsive);
    }

    const programas = document.querySelectorAll('.programa-menu a');
    if(programas){
        programas.forEach(programa => {
            programa.addEventListener('click',mostrarTab);
        });
    }

    // Botón para calcular el total a pagar.
    const btnCalcular = document.querySelector('#calcular');
    if(btnCalcular){
        btnCalcular.addEventListener('click',calcular);
    }

    // Mostrar el programa según se elija algún pase.
    const cantidadPases = document.querySelectorAll('.cantidadPase');
    if(cantidadPases){
        cantidadPases.forEach(cantidadPase =>{
            cantidadPase.addEventListener('blur',mostrarPrograma);
        });
    }
    // Validar los datos del usuario 
    const datosUsuarios = document.querySelectorAll('.input-datos');
    if(datosUsuarios){
        datosUsuarios.forEach(datoUsuario => {
            datoUsuario.addEventListener('blur',validarDatos);
        });
    }
};

function navegacionFija(){

    const barra = document.querySelector('.barra');

    const observer = new IntersectionObserver(function(entries){
        
        if(entries[0].isIntersecting){
            barra.classList.remove('fijo');
        } else {
            barra.classList.add('fijo');
        }

    });

    // Registramos que estamos observando con el método observe.
    observer.observe(document.querySelector('.header'));

}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
};


function calcular(e){
    e.preventDefault();

    // primeros corroboramos que el usuario haya elegido un regalo
    const regalo = document.querySelector('#regalo');
    if(regalo.value === ''){
        alert('Debes elegir un regalo');
        regalo.focus;
    } else {
        let montoAcumulado = 0;

        const listadoProductos = document.querySelector('#lista-productos');
        listadoProductos.innerHTML = '';


        // obtenemos el div de pases
        const pases = document.querySelectorAll('.info-precios');

        // hacemos un foreach a cada pase para obtener el precio y la cantidad y efectuamos el producto.
        pases.forEach(pase =>{
            let precio = parseInt(pase.children[1].textContent.replace('$',''));
            let cantidad = pase.children[5].children[1].value;
            let tipoPase =pase.children[0].textContent;
            let monto = precio * cantidad;
            montoAcumulado = montoAcumulado + monto;
            mostrarListado(cantidad,tipoPase,monto);
        });

        const camisaEvento = document.querySelector('#camisa_evento');
        const precioCamisa = 500;
        const coefDescuento = 0.93;
        mostrarListado(camisaEvento.value, 'Camisas', camisaEvento.value * precioCamisa * coefDescuento);
        const etiquetas = document.querySelector('#etiquetas');
        const precioEtiqueta = 200;
        mostrarListado(etiquetas.value,'Etiquetas', etiquetas.value * precioEtiqueta);
        let extras = (camisaEvento.value * precioCamisa * coefDescuento) + (etiquetas.value * precioEtiqueta);

        montoAcumulado = montoAcumulado + extras;

        const DIVsumaTotal = document.querySelector('#suma-total');

        if(document.querySelector('#suma-total p')){
            DIVsumaTotal.removeChild(document.querySelector('#suma-total p'));
        }

        const sumaTotal = document.createElement('p');
        sumaTotal.classList.add('sumaTotal');
        sumaTotal.append(`${montoAcumulado}`);

        console.log(montoAcumulado);
        if(montoAcumulado !== 0){
            DIVsumaTotal.append(sumaTotal);
            const btnPagar = document.querySelector('#btnRegistro');
            btnPagar.disabled = false;
            const totalPagar = document.querySelector('#total_pagado');
            totalPagar.value = montoAcumulado;
        }
    }
}

function mostrarListado(cantidad,tipoPase,monto){

    if(cantidad === '' || cantidad === 0) {
    } else {
        const div = document.createElement('div');
    div.classList.add('item');
    const item = document.createElement('p');
    item.append(tipoPase);
    const spanCantidad = document.createElement('span');
    spanCantidad.classList.add('cantidad');
    spanCantidad.append(cantidad);
    const spanMonto = document.createElement('span');
    spanMonto.classList.add('monto');
    spanMonto.append(monto);
    div.append(spanCantidad,item,spanMonto);
    const DIVListado = document.querySelector('#lista-productos');
    DIVListado.style.display='block';
    DIVListado.append(div);
    }
}

function mostrarPrograma(e){

    let cantidad = e.target.value;
    let id = e.target.id;
    let dias = [];

    switch (id) {
        case 'pase2': 
            dias.push('viernes','sabado');
            break;
        case 'pase3':
            dias.push('viernes','sabado','domingo');
            break;
        case 'pase1':
            dias.push('viernes');
            break;
        default:
        break;
    }

    if(cantidad >0){
        for(let i=0 ; i<dias.length ; i++){

            document.querySelector(`#${dias[i]}`).style.display = 'block';
        }

    } else {
        
        let pase3dias = parseInt(document.querySelector('#pase3').value);
        let pase2dias = parseInt(document.querySelector('#pase2').value);
        let pase1dia = parseInt(document.querySelector('#pase1').value);

        if( id === 'pase3'){
            if(pase2dias > 0) {
                document.querySelector('#domingo').style.display = 'none';
            } else if(pase1dia >0){
                document.querySelector('#domingo').style.display = 'none';
                document.querySelector('#sabado').style.display = 'none';
            } else {
                document.querySelector('#domingo').style.display = 'none';
                document.querySelector('#sabado').style.display = 'none';
                document.querySelector('#viernes').style.display = 'none';
            }
        }
        else if (id === 'pase2'){
        
            
            if(pase3dias === "" || pase3dias === 0){
                if(pase1dia >0){
                    document.querySelector('#sabado').style.display = 'none';
                }
                else {
                    document.querySelector('#sabado').style.display = 'none';
                    document.querySelector('#viernes').style.display = 'none';
                }
            }
        } else {
            if((pase3dias + pase2dias) > 0){
                
            }
            else {
                document.querySelector('#viernes').style.display = 'none';
            }
        }
    }
}

function validarDatos(e){

    const errorDIV = document.querySelector('#error');
    let id = e.target.id;
    

    switch(id){
        case 'nombre':
            if(e.target.value.length <=3){
                mensajeError.nombre = 'El Nombre es obligatorio y debe tener al menos 4 caracteres';
                e.target.style.border = '1px solid Red';
            }
            else {
                e.target.style.border = '1px solid #e1e1e1';
                mensajeError.nombre = '';
            }
            break;
        case 'apellido':
            if(e.target.value.length <=3){
                mensajeError.apellido = 'El apellido es obligatorio y debe tener al menos 4 caracteres';
                e.target.style.border = '1px solid Red';
            }
            else {
                mensajeError.apellido = '';
                e.target.style.border = '1px solid #e1e1e1';
            }
            break;
        case 'email':

            if(e.target.value.length <=3 || e.target.value.indexOf('@') === -1 || e.target.value.indexOf('.') === -1){
                mensajeError.email ='El mail es obligatorio y debe ser válido';
                e.target.style.border = '1px solid Red';
            }
            else {
                e.target.style.border = '1px solid #e1e1e1';
                mensajeError.email ='';
            }
            break;
        default: 
            break;
    }
    
    if(Object.values(mensajeError).length >0){

        errorDIV.innerHTML = '';

        Object.values(mensajeError).forEach(mensaje =>{
            let i = 0;
            if(mensaje !== ""){
                errorDIV.innerHTML+= `<p>${mensaje}</p>`;
                i++;
                errorDIV.style.display = 'block';
                errorDIV.style.border = '1px solid Red';
            }
            if(i === 0){
                errorDIV.style.display = 'none';
            }
        });  
    } 
}

function mostrarTab(e){
    e.preventDefault();
    id = e.target.getAttribute('href');
    const enlaces = document.querySelectorAll('.programa-menu a');
    enlaces.forEach(enlace => {
        enlace.classList.remove('activo');
    });
    e.target.classList.add('activo');
    const programas = document.querySelectorAll('.info-curso');
    programas.forEach(programa => {
        programa.classList.add('ocultar');
    });
    document.querySelector(`${id}`).classList.remove('ocultar');
    console.log(document.querySelector(`${id}`))
}

function contador(e){
    
    const selector = '.info-contador';
    const cantidadNumeros = document.querySelectorAll(`${selector} .counter`);
    let contador = 1;
    let dataTarget = 0;
    let numeroAnimado;
    cantidadNumeros.forEach(numero =>{
        dataTarget = numero.getAttribute('data-target');
        numeroAnimado = $(`${selector}:nth-child(${contador}) .counter`);    // mezclo Jquery con Javascript... hasta aprender animaciones con Javascript

        numeroAnimado.animateNumber(
            {
              number: dataTarget,
              //color: 'green', // require jquery.color
              //'font-size': '50px',
          
              // optional custom step function
              // using here to keep '%' sign after number
            //   numberStep: function(now, tween) {
            //     var floored_number = Math.floor(now),
            //         target = $(tween.elem);
          
            //     target.text(floored_number + ' %');
            //   }
            },
            {
              easing: 'swing',
              duration: 1800
            }
          );
    
        contador++;
    });    
}

// Utilizamos el plugin de Jquery final countdown
function cuentaRegresiva(){
    $('.cuenta-regresiva').countdown('2021/12/10 09:00:00', function(event){
        $('#dias').html(event.strftime('%D'));
        $('#horas').html(event.strftime('%H'));
        $('#minutos').html(event.strftime('%M'));
        $('#segundos').html(event.strftime('%S'));
    });
}

function colorBoxInvitados(){
    if($(".invitado-info")){
        $(".invitado-info").colorbox({inline:true, width:"50%"});
    }
}

function enlaceActivo(){
    if(document.querySelector("h2.invitados")){
        document.querySelector(".enlace-invitados").classList.add('activo');
    }
    if(document.querySelector("h2.conferencias")){
        document.querySelector(".enlace-conferencias").classList.add('activo');
    }
    if(document.querySelector("h2.calendarioH2")){
        document.querySelector(".enlace-calendario").classList.add('activo');
    }
}