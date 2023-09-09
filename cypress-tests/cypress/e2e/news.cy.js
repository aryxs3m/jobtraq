describe('News', () => {
  let newsUrl;

  it('can navigate to a news page', () => {
    cy.visit(Cypress.env('base_url'))
    cy.contains('Tovább olvasom').first().click()
    cy.url().should('contain', '/news/')
    cy.url().then(url => newsUrl = url)
  })

  it('can show news subpage', () => {
    cy.visit(newsUrl)

    // has header
    cy.get('.page-header h3');
    cy.get('.page-header p');

    // content
    cy.get('.news-content p.lead');
    cy.get('.news-content div.markdown-content');

    // comments
    cy.contains('Hozzászólások');
  })

  it('can send new comment', () => {
    cy.visit(newsUrl)

    cy.get('#comment-name').type('Cypress Test')
    cy.get('#comment-text').type('Cypress test comment message.')
    cy.get('button[type="submit"]').click()

    cy.contains('Hozzászólásod beküldésre került')

    cy.contains('Cypress Test')
    cy.contains('Cypress test comment message.')
  })

  it('cannot send empty comment form', () => {
    cy.visit(newsUrl)

    cy.get('button[type="submit"]').click()

    cy.contains('Hozzászólásod beküldésre került').should('not.exist')
  })

  it('cannot send invalid comment form', () => {
    cy.visit(newsUrl)

    cy.get('#comment-name').type('a')
    cy.get('#comment-text').type('b')
    cy.get('button[type="submit"]').click()

    cy.contains('Hozzászólásod beküldésre került').should('not.exist')

    cy.contains('Név megadása kötelező')
  })
})
