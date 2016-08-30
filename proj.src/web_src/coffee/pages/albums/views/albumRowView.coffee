Mn = require("backbone.marionette")
_und  = require("underscore")

albumRaw = Mn.ItemView.extend(
  tagName:  'li',
  template: _und.template('<%- albumName %>'),
  triggers: {
    click: 'select:entry'
  }
)

module.exports = albumRaw