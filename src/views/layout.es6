import _ from 'underscore';
import { LayoutView } from 'backbone.marionette';

import PostList from './list';
import PostEntry from './post';

import indexTemplate from '../templates/index';

class Layout extends LayoutView {
  constructor(...rest) {
    super(...rest);
    rest.forEach(function restForEach(item) {
      if (typeof item === 'object') {
        _.extend(this, item);
      }
    });
  }

  template() {
    return indexTemplate;
  }

  regions() {
    return {
      layout: '.layout-hook'
    };
  }

  onShowIndexPage() {
    const contactList = new PostList({ collection: this.collection });
    this.showChildView('layout', contactList);

    Backbone.history.navigate('');
  }

  onShowIndexEntry(entry) {
    const model = this.collection.get(entry);
    this.showContact(model);
  }

  onChildviewSelectEntry(child, model) {
    this.showContact(model);
  }

  onChildviewShowContactList() {
    this.triggerMethod('show:contact:list');
  }

  /** Share some simple logic from our subviews */
  showContact(model) {
    const entry = new PostEntry({ model });
    this.showChildView('layout', entry);

    Backbone.history.navigate(`portfolio/${model.id}`);
  }
}

export default Layout;
