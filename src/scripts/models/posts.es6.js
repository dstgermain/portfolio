import Post from 'models/post';
import nestCollection from 'helpers/nestCollection';

const PostsCollection = Backbone.Collection.extend({ model: Post });

class Posts extends Backbone.Model {
  constructor(...rest) {
    super(...rest);
  }

  initialize() {
    this.group = nestCollection(this, 'group', new PostsCollection(this.get('group')));
  }
}

export default Posts;
