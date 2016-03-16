import { AppRouter } from 'backbone.marionette';

import IndexController from './controllers/indexController';

const Router = AppRouter.extend({
  appRoutes: {
    '': 'index',
    'portfolio/:id': 'portfolioEntry'
  },
  initialize() {
    this.controller = new IndexController();
  }
});

export default Router;