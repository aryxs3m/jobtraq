describe('Contact Page', () => {
  it('can navigate to the contact page', () => {
    cy.visit(Cypress.env('base_url'))
    cy.contains('Kapcsolat').click()
    cy.url().should('contain', '/contact')
  })

  it('can show contact content', () => {
    cy.visit(Cypress.env('base_url') + '/contact')

    cy.contains('Kapcsolat')
    cy.contains('Minden visszajelzést szívesen fogadunk.')
    cy.contains('Online')
    cy.contains('pvga.hu')
    cy.contains('info@jobtraq.hu')
    cy.contains('Image by')
  })
})
