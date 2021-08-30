/// <reference types="cypress"/>


describe ('Prueba de Autenticación de usuarios', () => {

    it('Prueba de campos de formulario y envío de Email', () => {
        cy.visit('/login');

        cy.get('[data-cy="titulo-login"]').should('exist');
        cy.get('[data-cy="titulo-login"]').should('have.text','Iniciar Sesión');
        cy.get('[data-cy="formulario-login"]').should('exist');

        // Ambos campos son obligatorios
        cy.get('[data-cy="formulario-login"]').submit();
        cy.get('[data-cy="alerta-login"]').should('exist');
        cy.get('[data-cy="alerta-login"]').first().should('have.class','error');
        cy.get('[data-cy="alerta-login"]').first().should('have.text','Debes colocar un email válido');
        cy.get('[data-cy="alerta-login"]').last().should('have.class','error');
        cy.get('[data-cy="alerta-login"]').last().should('have.text','Debes colocar un password con al menos 1 mayúscula y 1 número');

        // El usuario existe
        cy.get('[data-cy="login-mail"]').type('betofiorani@gmail.com');
        cy.get('[data-cy="login-password"]').type('1234');
    });
});