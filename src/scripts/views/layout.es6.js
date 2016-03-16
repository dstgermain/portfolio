import _ from 'underscore';
import { LayoutView } from 'backbone.marionette';

import PostList from 'views/list';
import PostEntry from 'views/post';
import NotFoundView from 'views/not_found';
import Header from 'views/header';
import Footer from 'views/footer';

import Post from 'models/post';

import indexTemplate from 'templates/index';

import PostsService from 'services/PostsService';

class Layout extends LayoutView {
  constructor(...rest) {
    super(...rest);
  }

  template() {
    return indexTemplate;
  }

  regions() {
    return {
      layout: '.layout-hook',
      footer: 'footer',
      header: 'header'
    };
  }

  childEvents() {
    return {
      'child:show:index': 'onChildShowIndex'
    };
  }

  onBeforeShow() {
    this.showChildView('header', new Header());
    this.showChildView('footer', new Footer());
  }

  onShowIndexPage() {
    const postList = new PostList({ collection: this.collection });
    this.showChildView('layout', postList);

    Backbone.history.navigate('');
  }

  findPostModel(data, entry) {
    const itemData = _.find(data, (item) => Number(item.id) === Number(entry));
    return new Post(itemData);
  }

  onShowIndexEntry(entry) {
    PostsService.getPosts().then((data) => {
      const model = this.findPostModel(data, entry);
      this.showPost(model);
    });
  }

  onChildShowIndex() {
    console.log('YEAY');
    this.triggerMethod('show:index:page');
  }

  /** Share some simple logic from our subviews */
  showPost(model) {
    if (model && model.attributes.id) {
      const entry = new PostEntry({ model });
      this.showChildView('layout', entry);
      Backbone.history.navigate(`portfolio/${model.attributes.id}`);
    } else {
      this.showErr();
    }
  }

  showErr() {
    this.showChildView('layout', new NotFoundView());
  }
}

export default Layout;
