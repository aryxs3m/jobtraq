describe('Cookie Consent', () => {
  it('can see cookie consent', () => {
    cy.visit(Cypress.env('base_url'))
    cy.contains('Sütiket használunk az analitikához')
  })

  it('can deny cookies', () => {
    cy.visit(Cypress.env('base_url'))
    cy.get('a.cc-btn.cc-deny').click()
    cy.getCookie('cookieconsent_status').should('have.property', 'value', 'deny');
  })

  it('can allow cookies', () => {
    cy.visit(Cypress.env('base_url'))
    cy.get('a.cc-btn.cc-allow').click()
    cy.getCookie('cookieconsent_status').should('have.property', 'value', 'allow');
  })

  // TODO: ez még nem jó
  it('loads Google Tag Manager when cookies allowd', () => {
    cy.visit(Cypress.env('base_url'))
    cy.get('a.cc-btn.cc-allow').click()
    cy.contains('Kapcsolat').click()
    cy.contains('Hogy működik?').click()
  })
})
