/// <reference types="cypress"/>


describe ('Página Principal', () => {

    it('Prueba Sección Header en Página Principal', () => {
        cy.visit('/');

        // Esto es lo mismo que document.querySelector y luego textcontent o algo similar.
        cy.get('[data-cy="heading-sitio"]').should('exist'); 
        cy.get('[data-cy="heading-sitio"]').invoke('text').should('equal','Venta, Alquiler de Casas y Departamentos');
        cy.get('[data-cy="heading-sitio"]').invoke('text').should('not.equal','Alquiler de Casas y Departamentos');    
    });
    it('Prueba Sección Qué Ofrecemos en Página Principal', () => {
        cy.visit('/');

        // Esto es lo mismo que document.querySelector y luego textcontent o algo similar.
        cy.get('[data-cy="heading-queOfrecemos"]').should('exist');
        cy.get('[data-cy="heading-queOfrecemos"]').should('have.prop','tagName').should('equal','H2'); 
        cy.get('[data-cy="heading-queOfrecemos"]').invoke('text').should('equal','¿Qué ofrecemos?');
        cy.get('[data-cy="heading-queOfrecemos"]').invoke('text').should('not.equal','Sobre Nosotros');
        
        cy.get('[data-cy="iconos-servicios"]').should('exist'); // verifica que exista el div que contiene los iconos
        cy.get('[data-cy="iconos-servicios"]').find('.icono h3').should('have.length',3);
        cy.get('[data-cy="heading-icono1"]').invoke('text').should('equal','Seguridad');
        cy.get('[data-cy="heading-icono2"]').invoke('text').should('equal','Confianza');
        cy.get('[data-cy="heading-icono3"]').invoke('text').should('equal','Tiempo');

        cy.get('[data-cy="iconos-servicios"]').find('.icono img').should('have.length',3);
    });

    it('Pruebas Sección Propiedades en Página Principal', () => {
        // Revisamos que exista la sección propiedades
        cy.get('[data-cy="contenedor-anuncios"]').should('exist');
        // Revisamos que cada propiedad tenga una imagen, un título y los iconitos de habitaciones, baños y cocheras
        cy.get('[data-cy="contenedor-anuncios"]').find('.anuncio [data-cy="imagen-anuncio"]').should('have.length',3);
        cy.get('[data-cy="contenedor-anuncios"]').find('.anuncio h3').should('have.length',3);
        cy.get('[data-cy="contenedor-anuncios"]').find('.iconos-caracteristicas img').should('have.length',9);
        // revisión sobre los botones
        cy.get('[data-cy="contenedor-anuncios"]').find('.anuncio [data-cy="boton-anuncio"]').should('have.length',3);
        cy.get('[data-cy="contenedor-anuncios"]').find('.anuncio [data-cy="boton-anuncio"]').should('have.class','boton-morado');
        cy.get('[data-cy="contenedor-anuncios"]').find('.anuncio [data-cy="boton-anuncio"]').first().invoke('text').should('equal','Ver Propiedad');
        // probamos un click en el botorn
        cy.get('[data-cy="contenedor-anuncios"]').find('.anuncio [data-cy="boton-anuncio"]').first().click();
        cy.get('[data-cy="titulo-propiedad"]').should('exist');
        cy.wait(2000);
        cy.go('back'); // volver a la página principal para seguir las pruebas
    });
    it('Prueba ver todas las propiedades desde Página Principal', () => {
        cy.get('[data-cy="ver-propiedades"]').should('exist');
        cy.get('[data-cy="ver-propiedades"]').should('have.class','boton-verde');
        cy.get('[data-cy="ver-propiedades"]').invoke('attr','href').should('equal','/venta');
        cy.get('[data-cy="ver-propiedades"]').click();
        cy.get('[data-cy="titulo-propiedades"]').invoke('text').should('equal','Casas y Departamentos en Venta');
        cy.wait(2000);
        cy.go('back'); // volver a la página principal para seguir las pruebas

    });

    it('Prueba de la seccion contactos en Página Principal', () => {
        cy.get('[data-cy="contacto-homepage"]').should('exist');
        cy.get('[data-cy="contacto-homepage"]').find('h2').invoke('text').should('equal','Encuentra tu Hogar');
        cy.get('[data-cy="contacto-homepage"]').find('a').should('exist');
        cy.get('[data-cy="contacto-homepage"]').find('a').should('have.class','boton-morado');
        
        // Otra manera de visitar un sitio sin usar click
        //cy.get('[data-cy="contacto-homepage"]').find('a').invoke('attr','href').should('equal','/contacto');
        //cy.get('[data-cy="contacto-homepage"]').find('a').click();
        //cy.wait(2000);
        //cy.go('back');
        cy.get('[data-cy="contacto-homepage"]').find('a').invoke('attr','href').then( href => {
            cy.visit(href);
        });
        
        cy.get('[data-cy="titulo-contacto"]').invoke('text').should('equal','Contacto');
        cy.wait(2000);
        cy.visit('/'); // volver a la página principal para seguir las pruebas

    });

    it('Prueba de la seccion Blog y Testimoniales en la Página Principal', () => {
        cy.get('[data-cy="opiniones"]').should('exist');
        cy.get('[data-cy="opiniones"]').find('h3').invoke('text').should('equal','Opiniones');
        cy.get('[data-cy="acceso-blog"]').should('exist');
        cy.get('[data-cy="acceso-blog"]').find('h3').invoke('text').should('equal','Nuestro Blog');
        cy.get('[data-cy="acceso-blog"]').find('article').should('have.length',2);
        cy.get('[data-cy="acceso-blog"]').find('img').should('have.length',2);
        cy.get('[data-cy="acceso-blog"]').find('a').should('have.length',2);
        cy.get('[data-cy="acceso-blog"]').find('a').invoke('attr','href').then( href => {
            cy.visit(href);
        });
        cy.get('[data-cy="entrada"]').should('exist');
        cy.wait(2000);
        cy.visit('/'); // volver a la página principal para seguir las pruebas

    });
});