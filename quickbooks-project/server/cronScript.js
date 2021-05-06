const cron = require("node-cron");
var QuickBooks = require("node-quickbooks");
const fs = require("fs");
const util = require("util");

const dbConnection = require("./models/db");

const getUsersFromDB = async () => {
  const statement = `SELECT id, realmId , accessToken, refreshToken FROM user WHERE 1`;
  const [rows, fields] = await dbConnection.query(statement);
  return JSON.parse(JSON.stringify(rows));
};

const refreshTokenHelper = (qbo, id) => {
  return new Promise(async (resolve) => {
    qbo.refreshAccessToken((err, accessToken) => {
      const statememt = `UPDATE user SET accessToken = ? , refreshToken = ?, updatedAt = ? WHERE id = ?`;
      resolve();
      dbConnection.query(
        statememt,
        [accessToken.access_token, accessToken.refresh_token, new Date(), id],
        (err, result) => {
          if (err) console.log(err);
          console.log(`Refreshed Token ${id}`);
        }
      );
    });
  });
};

const refreshAccessToken = async (qboObjArray, userIdRealmIdMap) => {
  for (const qbo of qboObjArray) {
    const id = userIdRealmIdMap.get(qbo.realmId);
    await refreshTokenHelper(qbo, id);
  }
};

const getItemsHelper = (qbo, id) => {
  return new Promise(async (resolve) => {
    qbo.refreshAccessToken((err, accessToken) => {
      const statememt = `UPDATE user SET accessToken = ? , refreshToken = ?, updatedAt = ? WHERE id = ?`;
      resolve();
      dbConnection.query(
        statememt,
        [accessToken.access_token, accessToken.refresh_token, new Date(), id],
        (err, result) => {
          if (err) console.log(err);
          console.log(`Refreshed Token ${id}`);
        }
      );
    });
  });
};

const getItems = async (qboObjArray, userIdRealmIdMap) => {
  console.log(qboObjArray);
  // for (const qbo of qboObjArray) {
  //   const id = userIdRealmIdMap.get(qbo.realmId);
  //   await qbo.findItems(
  //     {
  //       fetchAll: true,
  //     },
  //     function (err, items) {
  //       let data = JSON.stringify(items);
  //       fs.writeFileSync(`temp/items${id}.json`, data, (err) => {
  //         if (err) throw err;
  //         console.log(`Fetched Items of ${id}`);
  //       });
  //     }
  //   );
  // }
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

const asyncRefreshAccessToken = util.promisify(refreshAccessToken);

const helper = async (req, res) => {
  const users = await getUsersFromDB();
  const { qboObjArray, userIdRealmIdMap } = getArrayOfObjects(users);
  await refreshAccessToken(qboObjArray, userIdRealmIdMap);
  const items = await getItems(qboObjArray, userIdRealmIdMap);

  // console.log(qboObjArray);
  res.redirect("/");
};

// cron.schedule("* * * * *", () => {
//   //
// });

module.exports = helper;
