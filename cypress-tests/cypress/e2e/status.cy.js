describe('Status Page', () => {
  it('can navigate to the status page', () => {
    cy.visit(Cypress.env('base_url'))
    cy.contains('Állapot').click()
    cy.url().should('contain', '/status')
  })

  it('can show status content', () => {
    cy.visit(Cypress.env('base_url') + '/status')

    cy.contains('A JobTraq állapota')
    cy.contains('Minden rendben?')
    cy.contains('Image by')
  })

  it('can show status information', () => {
    cy.visit(Cypress.env('base_url') + '/status')

    cy.contains('Frontend')
    cy.contains('Backend')
    cy.get('.color-bar-green')
  })
})
