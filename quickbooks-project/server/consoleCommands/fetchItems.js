const { insertUpdateItems } = require("../models/itemService");

// helper function for getItems
const getItemsHelper = (qbo, userId) => {
  return new Promise(async (resolve) => {
    qbo.findItems(
      {
        fetchAll: true,
      },
      async (err, { QueryResponse: { Item } }) => {
        if (err) {
          console.log(err);
        }
        await insertUpdateItems(Item, userId);
        resolve();
      }
    );
  });
};

// get All Items from QBO
const getItems = async (qboObjArray, userIdRealmIdMap) => {
  for (const qbo of qboObjArray) {
    const id = userIdRealmIdMap.get(qbo.realmId);
    await getItemsHelper(qbo, id);
  }
};

module.exports = getItems;
