import { LayoutView } from 'backbone.marionette';

import NotFoundTemplate from 'templates/not_found';

class NotFoundView extends LayoutView {
  constructor(...rest) {
    super(...rest);
    this.template = NotFoundTemplate;
  }

  ui() {
    return {
      back: '.back'
    };
  }
}

export default NotFoundView;
