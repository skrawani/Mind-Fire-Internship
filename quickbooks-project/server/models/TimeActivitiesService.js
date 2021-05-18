const dbConnection = require("./db");

// helper function to give query statement for insert or update if exist for Employee Table
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

// Function to Insert or Update if already exist in Item Table
const insertUpdateTimeActivities = async (TimeActivity, userId) => {
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
  }
};

module.exports = { insertUpdateTimeActivities };
