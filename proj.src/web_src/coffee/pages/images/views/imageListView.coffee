imageRow         = require('./imageRowView.coffee')
ImagesCollection = require('./../collections/imagesCollection.coffee')
Mn               = require("backbone.marionette")

itemsList = Mn.CollectionView.extend({
  collection: ImagesCollection,
  tagName: 'ul',
  childView: imageRow
})

module.exports = itemsList