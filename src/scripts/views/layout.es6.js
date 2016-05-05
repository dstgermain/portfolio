import _ from 'underscore';
import { LayoutView } from 'backbone.marionette';

import PostList from 'views/list';
import PostEntry from 'views/post';
import NotFoundView from 'views/not_found';
import Header from 'views/header';
import Footer from 'views/footer';
import AboutPage from 'views/aboutPage';
import ResumePage from 'views/resumePage';

import Post from 'models/post';

import indexTemplate from 'templates/index';

import PostsService from 'services/PostsService';

class Layout extends LayoutView {
  constructor(...rest) {
    super(...rest);
    _.extend(this, rest[0]);
    this.template = indexTemplate;
  }

  regions() {
    return {
      layout: '.layout-hook',
      entry: '.entry',
      footer: 'footer',
      header: 'header'
    };
  }

  childEvents() {
    return {
      'child:show:index': 'onChildShowIndex',
      'child:show:page': 'onChildShowPage',
      'child:show:about': 'onChildShowAbout',
      'child:show:resume': 'onChildShowResume'
    };
  }

  onBeforeShow() {
    this.showChildView('header', new Header());
    this.showChildView('footer', new Footer());
  }

  onShowIndexPage() {
    if (this.postView) this.postView.destroy();
    const postList = new PostList({ collection: this.collection_one });
    this.showChildView('layout', postList);

    Backbone.history.navigate('');
  }

  findPostModel(data, entry) {
    const itemData = _.find(data, (item) => Number(item.id) === Number(entry));
    return new Post(itemData);
  }

  onShowIndexEntry(entry) {
    const postList = new PostList({ collection: this.collection_one });
    this.showChildView('layout', postList);

    PostsService.getPosts().then((data) => {
      const model = this.findPostModel(data, entry);
      this.showPost(model);
    });
  }

  onChildShowIndex() {
    if (this.postView) this.postView.destroy();
    this.triggerMethod('show:index:page');
  }

  onChildShowPage(composite, post) {
    this.showPost(post);
  }

  /** Share some simple logic from our subviews */
  showPost(model) {
    if (model && model.attributes.id) {
      this.postView = new PostEntry({ model });
      this.showChildView('entry', this.postView);
      Backbone.history.navigate(`portfolio/${model.attributes.id}`);
    } else {
      this.showErr();
    }
  }

  onShowAboutPage() {
    if (this.postView) this.postView.destroy();
    this.aboutPage = new AboutPage();
    Backbone.history.navigate('about');
    this.showChildView('layout', this.aboutPage);
  }

  onChildShowAbout() {
    this.triggerMethod('show:about:page');
  }

  onShowResumePage() {
    if (this.postView) this.postView.destroy();
    this.resumePage = new ResumePage({ collection: this.collection_two });
    Backbone.history.navigate('resume');
    this.showChildView('layout', this.resumePage);
  }

  onChildShowResume() {
    this.triggerMethod('show:resume:page');
  }

  showErr() {
    this.showChildView('layout', new NotFoundView());
  }
}

export default Layout;
