describe('Privacy Policy Page', () => {
  it('can navigate to the privacy policy page', () => {
    cy.setCookie('cookieconsent_status', 'allow') // disable cookie consent window
    cy.visit(Cypress.env('base_url'))
    cy.get('footer').contains('Adatvédelem').click()
    cy.url().should('contain', '/privacy-policy')
  })

  it('can show privacy policy content', () => {
    cy.visit(Cypress.env('base_url') + '/privacy-policy')

    cy.contains('Adatvédelem')

    cy.contains('Tartalomjegyzék')
    cy.contains('adatkezelő')
    cy.contains('cookie')
    cy.contains('Tóth Patrik EV')
    cy.contains('fogyasztóvédelem')
  })
})
