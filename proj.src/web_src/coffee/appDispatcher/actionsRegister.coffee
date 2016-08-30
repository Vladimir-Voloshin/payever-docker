Backbone   = require("backbone")
dispatcher = require("./appDispatcher.coffee")

dispatcher.on('showAlbumImages', (options) -> (
  Backbone.history.navigate('/album/' + options.albumId + '/page/' + options.page, {trigger: true})
))

module.exports = {}