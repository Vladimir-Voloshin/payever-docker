appConstants     = require('./../../appConstants.coffee')
ImagesCollection = require('./collections/imagesCollection.coffee')
layout           = require('./../../appLayout.coffee')
mainView         = require('./views/mainView.coffee')

run = (albumId, page) -> (
#    TODO: make setting of the url through method
  ImagesCollection.url = appConstants.IMAGES_LIST_DATA_URL + albumId + '/page/' + page
  ImagesCollection.fetch({
    success: (imagesCollection, response, options) -> (
      mainDataView = new mainView(response.paging)
      layout.getRegion('content').show(mainDataView)
    )
  })
) 

module.exports = {run:run}