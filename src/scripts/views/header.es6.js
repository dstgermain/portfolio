import { View } from 'backbone.marionette';
import navigationTemplate from 'templates/navigation';

class Header extends View {
  constructor(...rest) {
    super(...rest);
    this.template = navigationTemplate;
  }

  events() {
    return {
      'click .home': 'onShowIndexPage',
      'click .about': 'onShowAboutPage'
    };
  }

  onShowIndexPage() {
    this.triggerMethod('child:show:index');
  }

  onShowAboutPage() {
    this.triggerMethod('child:show:about');
  }

  render() {
    this.$el.html(this.template());
    return this;
  }

  onRender() {
    this.$el = this.$el.children();
    this.$el.unwrap();
    this.setElement(this.$el);
  }
}

export default Header;
