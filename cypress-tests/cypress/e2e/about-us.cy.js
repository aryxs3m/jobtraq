describe('About Us Page', () => {
  it('can navigate to the about us page', () => {
    cy.visit('http://localhost:4200/')
    cy.contains('Hogy működik?').click()
    cy.url().should('contain', '/about-us')
  })

  it('can show about us content', () => {
    cy.visit('http://localhost:4200/about-us')

    cy.contains('Naprakész információ a magyar IT álláspiacról')
    cy.contains('Hogyan működik?')
    cy.contains('Miben készült?')
    cy.contains('Open Source')
    cy.contains('GitHub')
    cy.contains('Image by')
  })
})
