var QuickBooks = require("node-quickbooks");
const { getUsers, updateAccessTokenAllUsers } = require("./models/userService");

const refreshTokenHelper = (qbo, id) => {
  return new Promise(async (resolve) => {
    qbo.refreshAccessToken((err, accessToken) => {
      await updateAccessTokenAllUsers();
      resolve();
    });
  });
};

const refreshAccessToken = async (qboObjArray, userIdRealmIdMap) => {
  for (const qbo of qboObjArray) {
    const id = userIdRealmIdMap.get(qbo.realmId);
    await refreshTokenHelper(qbo, id);
  }
};

const cronJob = async () => {
  const users = await getUsers();
  const { qboObjArray, userIdRealmIdMap } = getArrayOfObjects(users);
  await refreshAccessToken(qboObjArray, userIdRealmIdMap);
  await getTimeActivities(qboObjArray, userIdRealmIdMap);
};
