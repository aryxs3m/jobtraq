describe('Scraping Ethics Page', () => {
  it('can navigate to the scraping ethics page', () => {
    cy.visit(Cypress.env('base_url'))
    cy.contains('Scraping etika').click()
    cy.url().should('contain', '/our-scraping-ethics')
  })

  it('can show scraping ethics content', () => {
    cy.visit(Cypress.env('base_url') + '/our-scraping-ethics')

    cy.contains('Scraping etika')
    cy.contains('A JobTraq igyekszik "jó botként" viselkedni.')
    cy.contains('JobTraq 1.0 (https://jobtraq.hu, info@jobtraq.hu)')
    cy.contains('Image by')
  })
})
