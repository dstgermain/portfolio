import Position from 'models/position';

class ExpCollection extends Backbone.Collection {
  constructor(...rest) {
    super(...rest);
    this.model = Position;
  }
}

export default ExpCollection;
