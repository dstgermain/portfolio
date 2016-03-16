import Posts from 'models/posts';

class PostsGroup extends Backbone.Collection {
  constructor(...rest) {
    super(...rest);
    this.model = Posts;
  }
}

export default PostsGroup;
