describe('Status Page', () => {
  it('can navigate to the status page', () => {
    cy.visit('http://localhost:4200/')
    cy.contains('Állapot').click()
    cy.url().should('contain', '/status')
  })

  it('can show status content', () => {
    cy.visit('http://localhost:4200/status')

    cy.contains('A JobTraq állapota')
    cy.contains('Minden rendben?')
    cy.contains('Image by')
  })

  it('can show status information', () => {
    cy.visit('http://localhost:4200/status')

    cy.contains('Frontend')
    cy.contains('Backend')
    cy.get('.color-bar-green')
  })
})
