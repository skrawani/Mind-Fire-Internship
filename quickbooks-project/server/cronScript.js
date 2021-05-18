var QuickBooks = require("node-quickbooks");
const dbConnection = require("./models/db");

const queryBuiderInsertWithUpdate = (tableName, fields, noOfObjects) => {
  const statement = `INSERT INTO ${tableName} ( ${fields.join(
    ", "
  )} ) VALUES ${`( ${"?, ".repeat(fields.length).slice(0, -2)}), `
    .repeat(noOfObjects)
    .slice(0, -2)} ON DUPLICATE KEY UPDATE ${fields
    .slice(0, -1)
    .map((field) => {
      return field + ` = VALUES ( ${field} )`;
    })
    .join(", ")} `;
  return statement;
};

const getUsersFromDB = async () => {
  const statement = `SELECT id, realmId , accessToken, refreshToken FROM user WHERE 1`;
  const [rows, fields] = await dbConnection.query(statement);
  return rows;
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
    qbo.findItems(
      {
        fetchAll: true,
      },
      async (err, { QueryResponse }) => {
        let itemsDataArray = [];

        const fieldsOfItem = [
          `itemId`,
          `userId`,
          `domain`,
          `name`,
          `fullyQualifiedName`,
          `type`,
          `description`,
          `incomeAccountId`,
          `expenseAccountId`,
          `assetAccountId`,
          `qtyOnHand`,
          `invStartDate`,
          `active`,
          `syncToken`,
          `updatedAt`,
          `createdAt`,
        ];
        const statememt = `INSERT INTO  item ( ${fieldsOfItem.join(
          ", "
        )} ) VALUES ${`( ${"?, ".repeat(16).slice(0, -2)}), `
          .repeat(QueryResponse.Item.length)
          .slice(0, -2)} ON DUPLICATE KEY UPDATE ${fieldsOfItem
          .slice(0, -1)
          .map((field) => {
            return field + ` = VALUES ( ${field} )`;
          })
          .join(", ")} `;

        for (const item of QueryResponse.Item) {
          const {
            Id,
            domain,
            Name,
            FullyQualifiedName,
            Type,
            Description,
            IncomeAccountRef,
            ExpenseAccountRef,
            AssetAccountRef,
            QtyOnHand,
            InvStartDate,
            Active,
            SyncToken,
          } = item;
          const itemDataArray = [
            Id,
            id,
            domain || "QBO",
            Name,
            FullyQualifiedName,
            Type,
            Description || "",
            IncomeAccountRef ? IncomeAccountRef.value : null,
            ExpenseAccountRef ? ExpenseAccountRef.value : null,
            AssetAccountRef ? AssetAccountRef.value : null,
            QtyOnHand || null,
            InvStartDate || null,
            Active || null,
            SyncToken,
            new Date(),
            new Date(),
          ];
          itemsDataArray.push(...itemDataArray);
        }

        resolve();
        const [rows] = await dbConnection.query(statememt, itemsDataArray);
        // console.log(rows);
      }
    );
  });
};

const getItems = async (qboObjArray, userIdRealmIdMap) => {
  // console.log(qboObjArray, userIdRealmIdMap);
  for (const qbo of qboObjArray) {
    const id = userIdRealmIdMap.get(qbo.realmId);
    await getItemsHelper(qbo, id);
  }
};

const getEmployeesHelper = async (qbo, id) => {
  return new Promise(async (resolve) => {
    qbo.findEmployees(
      {
        fetchAll: true,
      },
      async (err, { QueryResponse: { Employee } }) => {
        let employeeDataArray = [];
        console.log(Employee);
        const fieldsOfEmployee = [
          `empId`,
          `userId`,
          `domain`,
          `email`,
          `phone`,
          `displayName`,
          `familyName`,
          `billableTime`,
          `syncToken`,
          `active`,
          `createdAt`,
          `updatedAt`,
        ];

        for (const item of Employee) {
          const {
            Id,
            domain,
            PrimaryEmailAddr,
            PrimaryPhone,
            DisplayName,
            FamilyName,
            BillableTime,
            SyncToken,
            Active,
          } = item;
          const employeeRecord = [
            Id,
            id,
            domain || "QBO",
            PrimaryEmailAddr ? PrimaryEmailAddr.Address : null,
            PrimaryPhone ? PrimaryPhone.FreeFormNumber : null,
            DisplayName,
            FamilyName,
            BillableTime || false,
            SyncToken,
            Active,
            new Date(),
            new Date(),
          ];
          employeeDataArray.push(...employeeRecord);
        }

        resolve();
        const statememt = dbConnection.format(
          `INSERT INTO  employee ( ${fieldsOfEmployee.join(
            ", "
          )} ) VALUES ${`( ${"?, "
            .repeat(fieldsOfEmployee.length)
            .slice(0, -2)}), `
            .repeat(Employee.length)
            .slice(0, -2)} ON DUPLICATE KEY UPDATE ${fieldsOfEmployee
            .slice(0, -1)
            .map((field) => {
              return field + ` = VALUES ( ${field} )`;
            })
            .join(", ")} `,
          employeeDataArray
        );
        console.log(statememt);
        const [rows, fields] = await dbConnection.query(statememt);
        console.log(rows);
      }
    );
  });
};

const getEmployees = async (qboObjArray, userIdRealmIdMap) => {
  // console.log(qboObjArray, userIdRealmIdMap);
  for (const qbo of qboObjArray) {
    const id = userIdRealmIdMap.get(qbo.realmId);
    await getEmployeesHelper(qbo, id);
  }
};

const getTimeActivitiesHelper = async (qbo, userId) => {
  return new Promise(async (resolve) => {
    qbo.findTimeActivities(
      {
        fetchAll: true,
      },
      async (err, { QueryResponse: { TimeActivity } }) => {
        if (err) {
          console.log(err);
          return;
        }
        const fieldsOfTimeActivity = [
          `activityId`,
          `userId`,
          `domain`,
          `nameOf`,
          `hours`,
          `minutes`,
          `hourlyRate`,
          `billableStatus`,
          `description`,
          `itemId`,
          `employeeId`,
          `customerId`,
          `txnDate`,
          `syncToken`,
          `updatedAt`,
          `createdAt`,
        ];
        let TimeActivityDataArray = [];
        for (const activity of TimeActivity) {
          const TimeActivityRecord = [
            activity.Id,
            userId,
            activity.domain,
            activity.NameOf,
            activity.Hours,
            activity.Minutes,
            activity.HourlyRate || 0,
            activity.BillableStatus,
            activity.Description || "",
            activity.ItemRef ? activity.ItemRef.value : null,
            activity.EmployeeRef ? activity.EmployeeRef.value : null,
            activity.CustomerRef ? activity.CustomerRef.value : null,
            activity.TxnDate || null,
            activity.SyncToken,
            new Date(),
            new Date(),
          ];
          TimeActivityDataArray.push(...TimeActivityRecord);
        }
        resolve();
        const statememt = dbConnection.format(
          queryBuiderInsertWithUpdate(
            "time_activity",
            fieldsOfTimeActivity,
            TimeActivity.length
          ),
          TimeActivityDataArray
        );
        try {
          await dbConnection.query(statememt);
        } catch (err) {
          console.log(err);
          return;
        }
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

const helper = async (req, res) => {
  const users = await getUsersFromDB();
  const { qboObjArray, userIdRealmIdMap } = getArrayOfObjects(users);
  await refreshAccessToken(qboObjArray, userIdRealmIdMap);
  // await getItems(qboObjArray, userIdRealmIdMap);
  // await getEmployees(qboObjArray, userIdRealmIdMap);
  await getTimeActivities(qboObjArray, userIdRealmIdMap);

  // console.log(qboObjArray);
  res.redirect("/");
};

module.exports = helper;
