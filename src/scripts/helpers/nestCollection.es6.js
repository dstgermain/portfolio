import _ from 'underscore';

export default function nestCollection(model, attributeName, nestedCollection) {
  // setup nested references
  for (let i = 0; i < nestedCollection.length; i++) {
    model.attributes[attributeName][i] = nestedCollection.at(i).attributes;
  }
  // create empty arrays if none

  nestedCollection.bind('add', function nestedCollectionAdd(initiative) {
    if (!model.get(attributeName)) {
      model.attributes[attributeName] = [];
    }
    model.get(attributeName).push(initiative.attributes);
  });

  nestedCollection.bind('remove', function nestedCollectionRemove(initiative) {
    const updateObj = {};
    updateObj[attributeName] = _.without(model.get(attributeName), initiative.attributes);
    model.set(updateObj);
  });

  return nestedCollection;
}
