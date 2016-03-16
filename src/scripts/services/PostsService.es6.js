import _ from 'underscore';

class PostsService {
  static getPosts() {
    return $.ajax({
      url: '/test/stubs/posts.json'
    });
  }

  static filterPosts(posts = [], params = { orderBy: 'date', order: 'asc',
    groupBy: { attribute: 'category' } }) {
    const result = [];
    const groupedPosts = _.groupBy(posts, function groupBy(post) {
      return post[params.groupBy.attribute];
    });

    _.each(groupedPosts, function eachGroup(group, key) {
      let current = {};
      current.name = key;
      current.group = _.sortBy(group, (contact) => contact.name);
      _.sortBy(group, (contact) => contact.name);

      result.push(current);
    });

    return result;
  }
}

export default PostsService;
