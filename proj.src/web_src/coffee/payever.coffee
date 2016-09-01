Backbone = require("backbone")
Mn       = require("backbone.marionette")
router   = require('./router.coffee')

payever = Mn.Application.extend({});

payeverApp = new payever({
  router: new router({pushState: true})
})

payeverApp.addInitializer(() ->
  Backbone.history.start();
  require('./pages/albums/app.coffee').run()
  require('./appDispatcher/actionsRegister.coffee')
)

payeverApp.start({})