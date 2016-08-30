Mn       = require("backbone.marionette")
_und     = require("underscore")

albumRaw = Mn.ItemView.extend(
  tagName:  'li',
  template: _und.template('<img src="./<%- fileName %>" /> <%- fileName %> &mdash; <%- id %>')
)

module.exports = albumRaw