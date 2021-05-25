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

const getTimeActivities = async (userId) => {
  const fieldsOfTimeActivity = [
    `Id`,
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
  ];
  const statememt = `SELECT ${fieldsOfTimeActivity.join(
    ", "
  )} from time_activity WHERE activityId IS NULL AND userId =  ?`;
  try {
    const [rows, fields] = await dbConnection.query(statememt, [userId]);
    return { sucess: true, data: rows, err: "" };
  } catch (err) {
    console.log(err);
    return { sucess: false, data: [], err };
  }
};

const setActivityId = async (activityId, syncToken, id) => {
  const statement = `UPDATE time_activity SET activityId = ?, syncToken = ? WHERE Id = ?`;
  console.log(statement, activityId, syncToken, id);
  try {
    dbConnection.query(statement, [activityId, syncToken, id]);
  } catch (error) {
    console.log(error);
  }
};

module.exports = {
  insertUpdateTimeActivities,
  getTimeActivities,
  setActivityId,
};
