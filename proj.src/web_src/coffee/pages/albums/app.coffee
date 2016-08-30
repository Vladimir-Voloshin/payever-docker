layout   = require('./../../appLayout.coffee')
mainView = require('./views/mainView.coffee')

run = () -> (
  mainDataView = new mainView()
  layout.getRegion('menu').show(mainDataView)
) 

module.exports = {run:run}