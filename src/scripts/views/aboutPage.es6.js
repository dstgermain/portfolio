import { View } from 'backbone.marionette';
import aboutTemplate from 'templates/about';

class AboutPage extends View {
  constructor(...rest) {
    super(...rest);
    this.template = aboutTemplate;
  }

  render() {
    this.$el.html(this.template());
  }

  onRender() {
    this.$el = this.$el.children();
    this.$el.unwrap();
    this.setElement(this.$el);
  }
}

export default AboutPage;
