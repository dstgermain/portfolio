import _ from 'underscore';
import { LayoutView } from 'backbone.marionette';

import PostView from '../templates/post';

class postEntry extends LayoutView {
  constructor(...rest) {
    super(...rest);
    this.template = PostView;
    this.ui = { back: '.back' };
  }
}

export default postEntry;
