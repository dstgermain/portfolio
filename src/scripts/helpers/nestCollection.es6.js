import _ from 'underscore';

export default function nestCollection(model, attributeName, nestedCollection) {
  // setup nested references
  const tempModel = model;
  for (let i = 0; i < nestedCollection.length; i++) {
    tempModel.attributes[attributeName][i] = nestedCollection.at(i).attributes;
  }

  // create empty arrays if none
  nestedCollection.bind('add', (initiative) => {
    if (!tempModel.get(attributeName)) {
      tempModel.attributes[attributeName] = [];
    }
    tempModel.get(attributeName).push(initiative.attributes);
  });

  nestedCollection.bind('remove', (initiative) => {
    const updateObj = {};
    updateObj[attributeName] = _.without(tempModel.get(attributeName), initiative.attributes);
    model.set(updateObj);
  });

  return nestedCollection;
}
