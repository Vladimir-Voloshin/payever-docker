Mn = require("backbone.marionette")

router = Mn.AppRouter.extend({
  appRoutes: {
    ''                     : 'albums',
    'album/:id/'           : 'albumImages',
    'album/:id/page/:page' : 'albumImagesPaged'
  },
  
  controller: {
    albums: () ->
      require('./pages/albums/app.coffee').run()
      
    albumImages: (albumId) ->
      require('./pages/images/app.coffee').run(albumId)

    albumImagesPaged: (albumId, page) ->
      require('./pages/images/app.coffee').run(albumId, page)
  }
})

module.exports = router