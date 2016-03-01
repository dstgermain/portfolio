import _ from 'underscore';
import { ItemView, CompositeView } from 'backbone.marionette';
import ItemTemplate from '../templates/item';

class Entry extends ItemView {
  constructor(...rest) {
    super(...rest);
    this.template = ItemTemplate;
    this.triggers = {
      click: 'select:entry'
    };
  }
  render() {
    this.setElement(this.template(this.model.toJSON()));
  }
}

class PostList extends CompositeView {
  constructor(...rest) {
    super(...rest);
    this.template = _.template('<div class="child"></div>');
    this.childView = Entry;
    this.childViewContainer = '.child';
  }

  onChildviewSelectEntry(child) {
    this.triggerMethod('select:entry', child.model);
  }
}

export default PostList;
