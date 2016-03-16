import _ from 'underscore';
import { LayoutView } from 'backbone.marionette';

import NotFoundTemplate from 'templates/not_found';

class NotFoundView extends LayoutView {
  constructor(...rest) {
    super(...rest);
  }

  template() { return NotFoundTemplate; }

  ui() {
    return {
      back: '.back'
    };
  }
}

export default NotFoundView;
