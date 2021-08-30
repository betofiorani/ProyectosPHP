/// <reference types="cypress"/>


describe ('Prueba de formulario de Contacto', () => {

    it('Prueba de campos de formulario y envío de Email', () => {
        cy.visit('/contacto');

        cy.get('[data-cy="titulo-contacto"]').invoke('text').should('equal','Contacto');
        cy.get('[data-cy="titulo-formulario"]').invoke('text').should('equal','Llene el formulario de contacto');
        cy.get('[data-cy="formulario-contacto"]').should('exist');
    });

    it('Prueba los campos del formulario', () => {
        cy.get('[data-cy="input-nombre"]').type('Beto');
        cy.get('[data-cy="input-mensaje"]').type('Probando el formulario');
        cy.get('[data-cy="select-operacion"]').select('Compra');
        cy.get('[data-cy="input-precio"]').type('20000000');
        cy.get('[data-cy="input-forma-contacto"]').check('mail');
        cy.get('[data-cy="input-email"]').type('betofiorani@gmail.com');
        cy.wait(3000);        
        cy.get('[data-cy="input-forma-contacto"]').check('whatsapp');
        cy.get('[data-cy="input-telefono"]').type('3514000000');
        cy.get('[data-cy="input-fecha"]').type('1980-11-11');
        cy.get('[data-cy="input-hora"]').type('11:00');
    
        // prueba envio mail y alerta
        cy.get('[data-cy="formulario-contacto"]').submit();

        cy.get('[data-cy="alerta-envio"]').invoke('text').should('equal','Mensaje Enviado Correctamente');
        cy.get('[data-cy="alerta-envio"]').should('have.class','alerta').and('have.class','exito');

    });

    
});