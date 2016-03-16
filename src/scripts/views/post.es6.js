import { LayoutView } from 'backbone.marionette';

import PostView from 'templates/post';

class postEntry extends LayoutView {
  constructor(...rest) {
    super(...rest);
  }

  events() {
    return {
      'click .back': 'onShowIndexPage'
    };
  }

  onShowIndexPage(e) {
    e.preventDefault();
    this.triggerMethod('child:show:index');
  }

  template() { return PostView; }
}

export default postEntry;
