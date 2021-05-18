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

// Function to Insert or Update if already exist in Employee Table
const insertUpdateEmployee = async (Employees, userId) => {
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
    `updatedAt`,
    `createdAt`,
  ];

  let employeeDataArray = [];

  for (const employee of Employees) {
    const employeeRecord = [
      employee.Id,
      userId,
      employee.domain || "QBO",
      employee.PrimaryEmailAddr ? employee.PrimaryEmailAddr.Address : null,
      employee.PrimaryPhone ? employee.PrimaryPhone.FreeFormNumber : null,
      employee.DisplayName,
      employee.FamilyName,
      employee.BillableTime || false,
      employee.SyncToken,
      employee.Active,
      new Date(),
      new Date(),
    ];
    employeeDataArray.push(...employeeRecord);
  }

  await dbConnection.query(
    queryBuiderInsertWithUpdate(`employee`, fieldsOfEmployee, Employees.length),
    employeeDataArray
  );
};

module.exports = { insertUpdateEmployee };
