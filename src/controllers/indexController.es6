import { Controller, RegionManager } from 'backbone.marionette';

import Posts from '../collections/posts';
import LayoutView from '../views/layout';

class IndexController extends Controller {
  initialize() {
    this.options.regionManager = new RegionManager({
      regions: {
        main: '#app-hook'
      }
    });

    const layout = new LayoutView({
      collection: new Posts()
    });

    this.getOption('regionManager').get('main').show(layout);

    /** We want easy access to our root view later */
    this.options.layout = layout;
  }

  index() {
    const layout = this.getOption('layout');
    layout.triggerMethod('show:index:page');
  }

  portfolioEntry(entry) {
    const layout = this.getOption('layout');
    layout.triggerMethod('show:index:entry', entry);
  }
}

export default IndexController;
