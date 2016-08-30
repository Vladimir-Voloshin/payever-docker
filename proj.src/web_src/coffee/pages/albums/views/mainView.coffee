albumRaw         = require('./albumRowView.coffee')
AlbumsCollection = require('./../collections/albumsCollection.coffee')
dispatcher       = require("./../../../appDispatcher/appDispatcher.coffee")
Mn               = require('backbone.marionette')

mainView = Mn.CollectionView.extend({
  collection: AlbumsCollection,
  tagName: 'ul',
  childView: albumRaw,
  onChildviewSelectEntry: (child, options) -> (
    dispatcher.trigger('showAlbumImages', {'albumId':child.model.attributes.id, 'page':1})
  )
})

module.exports = mainView