describe('About Us Page', () => {
  it('can navigate to the about us page', () => {
    cy.visit(Cypress.env('base_url'))
    cy.contains('Hogy működik?').click()
    cy.url().should('contain', '/about-us')
  })

  it('can show about us content', () => {
    cy.visit(Cypress.env('base_url') + '/about-us')

    cy.contains('Hogyan működik?')
    cy.contains('Miben készült?')
    cy.contains('Open Source')
    cy.contains('GitHub')
    cy.contains('Image by')
  })
})
