describe('Contact Page', () => {
  it('can navigate to the contact page', () => {
    cy.visit('http://localhost:4200/')
    cy.contains('Kapcsolat').click()
    cy.url().should('contain', '/contact')
  })

  it('can show contact content', () => {
    cy.visit('http://localhost:4200/contact')

    cy.contains('Kapcsolat')
    cy.contains('Minden visszajelzést szívesen fogadunk.')
    cy.contains('Online')
    cy.contains('pvga.hu')
    cy.contains('info@jobtraq.hu')
    cy.contains('Image by')
  })
})
