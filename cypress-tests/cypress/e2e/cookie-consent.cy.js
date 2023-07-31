describe('Cookie Consent', () => {
  it('can see cookie consent', () => {
    cy.visit('http://localhost:4200/')
    cy.contains('Sütiket használunk az analitikához')
  })

  it('can deny cookies', () => {
    cy.visit('http://localhost:4200/')
    cy.get('a.cc-btn.cc-deny').click()
    cy.getCookie('cookieconsent_status').should('have.property', 'value', 'deny');
  })

  it('can allow cookies', () => {
    cy.visit('http://localhost:4200/')
    cy.get('a.cc-btn.cc-allow').click()
    cy.getCookie('cookieconsent_status').should('have.property', 'value', 'allow');
  })

  // TODO: ez még nem jó
  it('loads Google Tag Manager when cookies allowd', () => {
    cy.visit('http://localhost:4200/')
    cy.get('a.cc-btn.cc-allow').click()
    cy.contains('Kapcsolat').click()
    cy.contains('Hogy működik?').click()
  })
})
