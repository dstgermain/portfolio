import { LayoutView } from 'backbone.marionette';

import PostView from 'templates/post';

class postEntry extends LayoutView {
  constructor(...rest) {
    super(...rest);
    this.template = PostView;
  }

  onRender() {
    this.$el.addClass('open');
  }

  destroy() {
    this.$el.fadeOut(300, () => {
      this.remove();
    });
  }

  events() {
    return {
      'click .back': 'onShowIndexPage'
    };
  }

  onShowIndexPage(e) {
    e.preventDefault();
    this.triggerMethod('child:show:index', this);
  }
}

export default postEntry;
