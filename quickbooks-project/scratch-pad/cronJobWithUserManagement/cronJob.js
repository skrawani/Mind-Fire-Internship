require("dotenv").config({ path: __dirname + "/.env" });
const QuickBooks = require("node-quickbooks");
const dbConnection = require("./models/db");

const { getUsers, updateAccessTokenAllUsers } = require("./models/userService");
const getItems = require("./consoleCommands/fetchItems");
const getEmployees = require("./consoleCommands/fetchEmployees");
const getTimeActivities = require("./consoleCommands/fetchTimeActivities");

const refreshTokenHelper = (qbo, id) => {
  return new Promise(async (resolve) => {
    qbo.refreshAccessToken(async (err, accessToken) => {
      if (err) {
        console.log(err);
        resolve();
        return;
      }
      await updateAccessTokenAllUsers(id, accessToken);
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

const getArrayOfObjects = (users) => {
  const qboObjArray = [];
  var userIdRealmIdMap = new Map();
  for (const user of users) {
    qboObjArray.push(
      new QuickBooks(
        process.env.CLIENT_ID,
        process.env.CLIENT_SECRET,
        user.accessToken /* oAuth access token */,
        false /* no token secret for oAuth 2.0 */,
        user.realmId,
        true /* use a sandbox account */,
        false /* turn debugging on */,
        4 /* minor version */,
        "2.0" /* oauth version */,
        user.refreshToken /* refresh token */
      )
    );
    userIdRealmIdMap.set(user.realmId, user.id);
  }
  return { qboObjArray, userIdRealmIdMap };
};

const cronJob = async () => {
  const users = await getUsers();
  //   console.log(users);
  const { qboObjArray, userIdRealmIdMap } = getArrayOfObjects(users);
  //   console.log(qboObjArray);
  await refreshAccessToken(qboObjArray, userIdRealmIdMap);
  await getItems(qboObjArray, userIdRealmIdMap);
  await getEmployees(qboObjArray, userIdRealmIdMap);
  await getTimeActivities(qboObjArray, userIdRealmIdMap);

  console.log("Cron Job Completed");
  //   closing the db connection after all operations
  dbConnection.end();
};

cronJob();
