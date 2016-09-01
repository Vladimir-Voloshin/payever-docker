imageRow         = require('./imageRowView.coffee')
ImagesCollection = require('./../collections/imagesCollection.coffee')
Mn               = require("backbone.marionette")

itemsList = Mn.CollectionView.extend({
  childView: imageRow,
  className: 'media-list',
  collection: ImagesCollection,
  tagName: 'ul'
})

module.exports = itemsList