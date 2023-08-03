describe('Homepage Reports', () => {
  it('redirect to reports when no route specified', () => {
    cy.visit(Cypress.env('base_url'))
    cy.url().should('include', '/report')
  })

  it('show every chart', () => {
    cy.visit(Cypress.env('base_url') + '/report')
    cy.contains('Keresett területek')
    cy.contains('Álláshirdetések alakulása')
    cy.contains('Legnépszerűbb stack')
    cy.contains('bérsáv')
    cy.contains('Stackenkénti átlagos bér')
  })

  it('has every highlight populated', () => {
    cy.visit(Cypress.env('base_url') + '/report')
    cy.get('.chart-highlight').each(($el) => {
      cy.wrap($el).should('not.be.empty')
    })
  })

  it('reload when date changed', () => {
    cy.visit(Cypress.env('base_url') + '/report')

    cy.get('#nav-input-search')
        .type('2018-09-21')
        .click()
        .blur()

    cy.contains('nincs adatunk')
  })
})
