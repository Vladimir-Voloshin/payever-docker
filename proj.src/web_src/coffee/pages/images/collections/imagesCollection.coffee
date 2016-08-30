Backbone = require("backbone")

imagesCollection = Backbone.Collection.extend({
  parse: (response, options) -> (
    response.items
  )
})

module.exports = new imagesCollection()