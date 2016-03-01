import Post from '../models/post';

class Posts extends Backbone.Collection {
  constructor(...rest) {
    super(...rest);
    this.model = Post;
  }
}

export default Posts;
