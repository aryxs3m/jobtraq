describe('Homepage Reports', () => {
  it('redirect to reports when no route specified', () => {
    cy.visit('http://localhost:4200')
    cy.url().should('include', '/report')
  })

  it('show every chart', () => {
    cy.visit('http://localhost:4200/report')
    cy.contains('Keresett területek')
    cy.contains('Álláshirdetések alakulása')
    cy.contains('Legnépszerűbb stack')
    cy.contains('bérsáv')
    cy.contains('Stackenkénti átlagos bér')
  })

  it('has every highlight populated', () => {
    cy.visit('http://localhost:4200/report')
    cy.get('.chart-highlight').each(($el) => {
      cy.wrap($el).should('not.be.empty')
    })
  })

  it('reload when date changed', () => {
    cy.visit('http://localhost:4200/report')

    cy.get('#nav-input-search')
        .type('2018-09-21')
        .click()
        .blur()

    cy.contains('nincs adatunk')
  })
})
