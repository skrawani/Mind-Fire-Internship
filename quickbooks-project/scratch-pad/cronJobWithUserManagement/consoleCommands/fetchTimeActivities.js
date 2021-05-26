const {
  insertUpdateTimeActivities,
} = require("../models/TimeActivitiesService");

const getTimeActivitiesHelper = async (qbo, userId) => {
  return new Promise(async (resolve) => {
    qbo.findTimeActivities(
      {
        fetchAll: true,
      },
      async (err, { QueryResponse: { TimeActivity } }) => {
        if (err) {
          console.log(err);
        }
        await insertUpdateTimeActivities(TimeActivity, userId);
        resolve();
      }
    );
  });
};

const getTimeActivities = async (qboObjArray, userIdRealmIdMap) => {
  for (const qbo of qboObjArray) {
    const id = userIdRealmIdMap.get(qbo.realmId);
    await getTimeActivitiesHelper(qbo, id);
  }
};

module.exports = getTimeActivities;
