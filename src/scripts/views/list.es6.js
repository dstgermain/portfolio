import _ from 'underscore';
import { ItemView, CompositeView } from 'backbone.marionette';
import ItemTemplate from 'templates/item';

class PostGroup extends ItemView {
  constructor(...rest) {
    super(...rest);
    this.template = ItemTemplate;
  }

  events() {
    return {
      'click .item-container': 'onClickItem'
    };
  }

  onClickItem(e) {
    const id = $(e.currentTarget).data('id');
    Backbone.history.navigate(`portfolio/${id}`, true);
  }

  onRender() {
    this.$el = this.$el.children();
    this.$el.unwrap();
    this.setElement(this.$el);
  }
}

class PostList extends CompositeView {
  constructor(...rest) {
    super(...rest);
    this.template = _.template('<div class="groups"></div>');
    this.childView = PostGroup;
    this.childViewContainer = '.groups';
  }
}

export default PostList;
