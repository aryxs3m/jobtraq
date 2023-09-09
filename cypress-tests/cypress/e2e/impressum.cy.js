describe('Impressum Page', () => {
  it('can navigate to the impressum page', () => {
    cy.visit(Cypress.env('base_url'))
    cy.contains('Impresszum').click()
    cy.url().should('contain', '/impressum')
  })

  it('can show impressum content', () => {
    cy.visit(Cypress.env('base_url') + '/impressum')

    cy.contains('Impresszum')
    cy.contains('A fejlesztőről.')

    cy.contains('Köszönetnyilvánítás')
    cy.contains('rawpixel.com')
    cy.contains('pvproductions')
    cy.contains('benzoix')
    cy.contains('senivpetro')

    cy.contains('Fejlesztő, üzemeltető')
    cy.contains('Tóth Patrik')
    cy.contains('pvga.hu')

    cy.contains('Tárhelyszolgáltató')
    cy.contains('Contabo GmbH')
    cy.contains('info@contabo.de')
  })
})
