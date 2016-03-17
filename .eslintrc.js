module.exports = {
  extends: [
    './node_modules/eslint-config-airbnb/base.js'
  ],
  rules: {
    'comma-dangle': [2, 'never']
  },
  globals: {
    Backbone: false,
    $: false,
    app: true
  }
};
