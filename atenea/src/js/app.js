document.addEventListener('DOMContentLoaded', function(){
    eventListeners();
    darkmode();
});

function darkmode(){

    const prefiereDarkMode = window.matchMedia('(prefers-colors-scheme: dark)');
    if(prefiereDarkMode === true){
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }
    prefiereDarkMode.addEventListener('change',function(){
        if(prefiereDarkMode === true){
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }    
    })

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click',function(){
        document.body.classList.toggle('dark-mode'); // lo agrega al body
    })
};

function eventListeners(){
    const menuMobile = document.querySelector('.mobile-menu');
    menuMobile.addEventListener('click',navegacionResponsive);

    // Mostrar campos condicionales
    const formaContacto = document.querySelectorAll('input[name="contacto[tipo-contacto]"]');
    
    formaContacto.forEach( input => {
        input.addEventListener('click',mostrarFormaContacto);
    });
};

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
};

function mostrarFormaContacto(e){

    const contactoDiv = document.querySelector('#contacto');
    const formaContacto = e.target.value;

    switch (formaContacto){
        case 'telefono' :
        case 'whatsapp' : 
            contactoDiv.innerHTML = `
                <label for="telefono">Teléfono:</label>
                <input data-cy="input-telefono" id="telefono" name="contacto[telefono]" type="tel" placeholder="Tu telefono es...">
                <p>Si eligió teléfono o whatsApp, elija la fecha y hora para el contacto</p>
                <label for="fecha">Fecha:</label>
                <input data-cy="input-fecha" id="fecha" name="contacto[fecha]" type="date">
                <label for="hora">Hora:</label>
                <input data-cy="input-hora" id="hora" name="contacto[hora]" type="time" min="09:00" max="18:00">

            `;
            break;
        case 'mail' : 
            contactoDiv.innerHTML = `
                <label for="email">Email:</label>
                <input data-cy="input-email" id="email" name="contacto[email]" type="email" placeholder="Tu Mail es...">                
            `;
            break;
        default :
            break;
    }

}
