import { Controller, RegionManager } from 'backbone.marionette';

import PostsGroup from 'collections/postsGroup';
import ExpCollection from 'collections/expCollection';
import LayoutView from 'views/layout';

import PostsService from 'services/PostsService';

class IndexController extends Controller {
  initialize() {
    this.options.regionManager = new RegionManager({
      regions: {
        navigation: '#navigation',
        main: '#app-hook',
        footer: '#footer'
      }
    });

    this.postsGroup = new PostsGroup();
    this.expCollection = new ExpCollection();

    const layout = new LayoutView({
      collection_one: this.postsGroup,
      collection_two: this.expCollection
    });

    this.getOption('regionManager').get('main').show(layout);

    /** We want easy access to our root view later */
    this.options.layout = layout;

    PostsService.getPosts().then((data) => {
      const filtered = PostsService.filterPosts(data);
      this.postsGroup.reset(filtered);
    });

    PostsService.getExp().then((data) => {
      this.expCollection.reset(data);
    });
  }

  index() {
    const layout = this.getOption('layout');
    layout.triggerMethod('show:index:page');
  }

  portfolioEntry(entry) {
    const layout = this.getOption('layout');
    layout.triggerMethod('show:index:entry', entry);
  }

  aboutPage() {
    const layout = this.getOption('layout');
    layout.triggerMethod('show:about:page');
  }

  resumePage() {
    const layout = this.getOption('layout');
    layout.triggerMethod('show:resume:page');
  }
}

export default IndexController;
