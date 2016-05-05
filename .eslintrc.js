module.exports = {
  extends: [
    './node_modules/eslint-config-airbnb/base.js'
  ],
  rules: {
    'comma-dangle': [2, 'never'],
    'no-console': 0
  },
  globals: {
    Backbone: false,
    $: false,
    app: true
  }
};
