/// <reference types="cypress"/>


describe ('Rutas del sitio', () => {

    it('Prueba Navegación del Header', () => {
        cy.visit('/');

        cy.get('[data-cy="header"]').should('exist'); 
        cy.get('[data-cy="header"]').find('.navegacion a').should('have.length',5);
        cy.get('[data-cy="header"]').invoke('text').should('not.equal','Alquiler de Casas y Departamentos');    
        cy.get('[data-cy="header"]').find('.navegacion a').eq(0).invoke('text').should('equal','Nosotros');
        cy.get('[data-cy="header"]').find('.navegacion a').eq(0).invoke('attr','href').then( href => {
            cy.visit(href);
        });
        cy.get('[data-cy="titulo-nosotros"]').should('exist');
        cy.wait(2000);
        cy.visit('/');

        cy.get('[data-cy="header"]').find('.navegacion a').eq(2).invoke('text').should('equal','Venta');
        cy.get('[data-cy="header"]').find('.navegacion a').eq(2).invoke('attr','href').then( href => {
            cy.visit(href);
        });
        cy.get('[data-cy="titulo-propiedades"]').should('exist');
        cy.wait(2000);
        cy.visit('/');

        cy.get('[data-cy="header"]').find('.navegacion a').eq(3).invoke('text').should('equal','Blog');
        cy.get('[data-cy="header"]').find('.navegacion a').eq(3).invoke('attr','href').then( href => {
            cy.visit(href);
        });
        cy.get('[data-cy="titulo-blog"]').should('exist');
        cy.wait(2000);
        cy.visit('/');

        cy.get('[data-cy="header"]').find('.navegacion a').eq(4).invoke('text').should('equal','Contacto');
        cy.get('[data-cy="header"]').find('.navegacion a').eq(4).invoke('attr','href').then( href => {
            cy.visit(href);
        });
        cy.get('[data-cy="titulo-contacto"]').should('exist');
        cy.wait(2000);
        cy.visit('/');
        
    
    });

    it('Prueba Navegación del footer', () => {
        cy.visit('/');

        cy.get('[data-cy="footer"]').should('exist'); 
        cy.get('[data-cy="footer"]').find('.navegacion a').should('have.length',5);
        cy.get('[data-cy="footer"]').invoke('text').should('not.equal','Alquiler de Casas y Departamentos');    
        cy.get('[data-cy="footer"]').find('.navegacion a').eq(0).invoke('text').should('equal','Nosotros');
        cy.get('[data-cy="footer"]').find('.navegacion a').eq(0).invoke('attr','href').then( href => {
            cy.visit(href);
        });
        cy.get('[data-cy="titulo-nosotros"]').should('exist');
        cy.wait(2000);
        cy.visit('/');

        cy.get('[data-cy="footer"]').find('.navegacion a').eq(2).invoke('text').should('equal','En Venta');
        cy.get('[data-cy="footer"]').find('.navegacion a').eq(2).invoke('attr','href').then( href => {
            cy.visit(href);
        });
        cy.get('[data-cy="titulo-propiedades"]').should('exist');
        cy.wait(2000);
        cy.visit('/');

        cy.get('[data-cy="footer"]').find('.navegacion a').eq(3).invoke('text').should('equal','Blog');
        cy.get('[data-cy="footer"]').find('.navegacion a').eq(3).invoke('attr','href').then( href => {
            cy.visit(href);
        });
        cy.get('[data-cy="titulo-blog"]').should('exist');
        cy.wait(2000);
        cy.visit('/');

        cy.get('[data-cy="footer"]').find('.navegacion a').eq(4).invoke('text').should('equal','Contacto');
        cy.get('[data-cy="footer"]').find('.navegacion a').eq(4).invoke('attr','href').then( href => {
            cy.visit(href);
        });
        cy.get('[data-cy="titulo-contacto"]').should('exist');
        cy.wait(2000);
        cy.visit('/');
        
    });

});