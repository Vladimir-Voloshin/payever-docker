_und                = require("underscore")
blockContent     = require("./imageListView.coffee")
mainViewTemplate = require("./../templates/mainView.coffee")
Mn               = require("backbone.marionette")
navigationPanel  = require("./navigationPanelView.coffee")

mainView = Mn.LayoutView.extend({
  onBeforeShow: () -> (
    this.getRegion('navigation').show(new navigationPanel(this.options))
    this.getRegion('content').show(new blockContent())
  ),
  template: _und.template(mainViewTemplate),
  regions: {
    navigation: "#images-navigation",
    content: '#images-list'
  }
})

module.exports = mainView