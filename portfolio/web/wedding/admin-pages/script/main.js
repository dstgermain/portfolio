var app = angular.module("AdminControl", []);

app.directive("page", function () {
  return {
    restrict: "E",
    scope: {

    },
    template: '<a href="">{{ 1 + 1 }}</a>'
  }
});