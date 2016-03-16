import { View } from 'backbone.marionette';
import navigationTemplate from 'templates/navigation';

class Header extends View {
  constructor(...rest) {
    super(...rest);
  }

  template() {
    return navigationTemplate;
  }

  events() {
    return {
      'click .logo': 'onShowIndexPage'
    };
  }

  onShowIndexPage() {
    this.triggerMethod('child:show:index');
  }

  render() {
    const date = new Date().getFullYear();
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
