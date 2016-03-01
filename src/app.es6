import { Application } from 'backbone.marionette';

import Router from './router';

const App = new Application({
  onStart: function onStart(options) {
    const router = new Router(options);

    if (Backbone.history) {
      Backbone.history.start();
    }
  }
});

App.start();
