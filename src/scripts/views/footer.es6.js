import { View } from 'backbone.marionette';

class Footer extends View {
  constructor(...rest) {
    super(...rest);
  }

  render() {
    const date = new Date().getFullYear();
    this.$el.html(`<span class="copyright">&copy; ${date}</span>`);
    return this;
  }

  onRender() {
    // this.$el = this.$el.children();
    // this.$el.unwrap();
    // this.setElement(this.$el);
  }
}

export default Footer;
