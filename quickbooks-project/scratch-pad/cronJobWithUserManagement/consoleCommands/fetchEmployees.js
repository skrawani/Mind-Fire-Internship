const { insertUpdateEmployee } = require("../models/employeeService");

const getEmployeesHelper = async (qbo, userId) => {
  return new Promise(async (resolve) => {
    qbo.findEmployees(
      {
        fetchAll: true,
      },
      async (err, { QueryResponse: { Employee } }) => {
        if (err) {
          console.log(err);
        }
        await insertUpdateEmployee(Employee, userId);
        resolve();
      }
    );
  });
};

const getEmployees = async (qboObjArray, userIdRealmIdMap) => {
  for (const qbo of qboObjArray) {
    const id = userIdRealmIdMap.get(qbo.realmId);
    await getEmployeesHelper(qbo, id);
  }
};

module.exports = getEmployees;
