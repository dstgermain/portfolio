class Post extends Backbone.Model {
  constructor(...rest) {
    super(...rest);
  }

  defaults() {
    return {
      id: 0,
      title: '',
      category: '',
      images: [],
      url: '',
      created: new Date()
    };
  }
}

export default Post;
