import { Application } from 'backbone.marionette';
import sass from '../scss/main.scss'; // eslint-disable-line no-unused-vars

import Router from './router';

const App = new Application({
  onStart: function onStart(options) {
    this.router = new Router(options);

    if (Backbone.history) {
      Backbone.history.start();
    }
  }
});

App.start();
