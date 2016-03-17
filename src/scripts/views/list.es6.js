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
      'click .item-container': 'showChildPage'
    };
  }

  showChildPage(e) {
    this.triggerMethod('child:show:page', e);
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

  onChildviewChildShowPage(composite, event) {
    const postModel = _.find(
      composite.model.group.models,
      (model) => model.attributes.id === $(event.target).data('id')
    );
    this.triggerMethod('child:show:page', postModel);
  }
}

export default PostList;
