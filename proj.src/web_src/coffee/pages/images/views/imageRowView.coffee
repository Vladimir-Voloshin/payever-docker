Mn   = require("backbone.marionette")
_und = require("underscore")

albumRaw = Mn.ItemView.extend(
  className: 'media',
  tagName:  'li',
  template: _und.template('<div class="media-left">
        <a href="#"><img class="media-object" src="./<%- fileName %>" /></a></div>
        <div class="media-body">
            <h4 class="media-heading"><%- fileName %> &mdash; <%- id %></h4>
        </div>')
)

module.exports = albumRaw