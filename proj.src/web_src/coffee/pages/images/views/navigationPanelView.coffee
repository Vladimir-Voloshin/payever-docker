_und                   = require("underscore")
dispatcher          = require("./../../../appDispatcher/appDispatcher.coffee")
Mn                  = require("backbone.marionette")
navigationPanelView = require("./../templates/navigationPanelView.coffee")

navigationPanel = Mn.ItemView.extend({
  events: {
    'click #scrollBack': 'scrollBack',
    'click #scrollForward': 'scrollForward',
    'click #pageButton': 'goToPage'
  },
  serializeData: () -> ({
    currentPos: +this.options.currentPage,
    firstPage:  +this.options.currentPage == 1,
    lastPage:   +this.options.currentPage == +this.options.pagesTotal,
    totalPages: +this.options.pagesTotal
  })
  template: _und.template(navigationPanelView),
  goToPage: (e) -> (
    dispatcher.trigger('showAlbumImages', {'albumId':this.options.albumId, 'page':e.currentTarget.attributes['page'].value})
  ),
  scrollBack: () -> (
    if(this.options.currentPage == 1)
      return
    dispatcher.trigger('showAlbumImages', {'albumId':this.options.albumId, 'page':parseInt(this.options.currentPage)-1})
  ),
  scrollForward: () -> (
    if(+this.options.currentPage == +this.options.pagesTotal)
      return
    dispatcher.trigger('showAlbumImages', {'albumId':this.options.albumId, 'page':parseInt(this.options.currentPage)+1})
  )
})

module.exports = navigationPanel