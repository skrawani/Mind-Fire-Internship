// importing required node modules
require("dotenv").config({ path: __dirname + "/.env" });
const QuickBooks = require("node-quickbooks");
const dbConnection = require("./models/db");

// importing required modules
const { getUsers, updateAccessTokenAllUsers } = require("./models/userService");
const getItems = require("./consoleCommands/fetchItems");
const getEmployees = require("./consoleCommands/fetchEmployees");
const getTimeActivities = require("./consoleCommands/fetchTimeActivities");

// helper function for refreshTokenAccess
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

// refresh Access token for all users before any QBO operations
const refreshAccessToken = async (qboObjArray, userIdRealmIdMap) => {
  for (const qbo of qboObjArray) {
    const id = userIdRealmIdMap.get(qbo.realmId);
    await refreshTokenHelper(qbo, id);
  }
};

// generate array of QBO objects for all `users` and generate a map [realmId => user] to get userId when needed
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
  // get all APP users from DB
  const users = await getUsers();

  const { qboObjArray, userIdRealmIdMap } = getArrayOfObjects(users);

  await refreshAccessToken(qboObjArray, userIdRealmIdMap);

  // Fetch Items for all users from QBO
  await getItems(qboObjArray, userIdRealmIdMap);

  // Fetch Employees for all users from QBO
  await getEmployees(qboObjArray, userIdRealmIdMap);

  // Fetch TimeActivities for all users from QBO
  await getTimeActivities(qboObjArray, userIdRealmIdMap);

  //   closing the db connection after all operations
  dbConnection.end();
};

// invoking cronJob function()
cronJob();
