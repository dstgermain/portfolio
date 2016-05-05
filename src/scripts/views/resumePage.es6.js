import { CompositeView, ItemView } from 'backbone.marionette';
import resumeTemplate from 'templates/resume';
import _ from 'underscore';

class ResumeItem extends ItemView {
  constructor(...rest) {
    super(...rest);
    this.template = resumeTemplate;
  }

  onRender() {
    this.$el = this.$el.children();
    this.$el.unwrap();
    this.setElement(this.$el);
  }
}

class ResumePage extends CompositeView {
  constructor(...rest) {
    super(...rest);
    this.template = _.template(`
      <div class="page resume"></div>`);
    this.childView = ResumeItem;
    this.childViewContainer = '.resume';
  }

  onRenderTemplate() {
    this.$el.append('<img src="/img/ring.svg" class="loading" alt="Loading">');
  }

  onRenderCollection() {
    if ($('.loading').length) { $('.loading').remove(); }
  }
}

export default ResumePage;
