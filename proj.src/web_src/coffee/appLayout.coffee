Mn = require("backbone.marionette")

RootView = Mn.LayoutView.extend({
  el: 'body',
  regions: {
    menu:    '#menu',
    content: '#content'
  }
})

module.exports = new RootView()