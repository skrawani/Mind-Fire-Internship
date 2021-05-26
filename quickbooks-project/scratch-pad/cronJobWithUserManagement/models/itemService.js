const dbConnection = require("./db");

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

const insertUpdateItems = async (Items, userId) => {
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

  let itemsDataArray = [];
  for (const item of Items) {
    const itemDataArray = [
      item.Id,
      userId,
      item.domain || "QBO",
      item.Name,
      item.FullyQualifiedName,
      item.Type,
      item.Description || "",
      item.IncomeAccountRef ? item.IncomeAccountRef.value : null,
      item.ExpenseAccountRef ? item.ExpenseAccountRef.value : null,
      item.AssetAccountRef ? item.AssetAccountRef.value : null,
      item.QtyOnHand || null,
      item.InvStartDate || null,
      item.Active || null,
      item.SyncToken,
      new Date(),
      new Date(),
    ];
    itemsDataArray.push(...itemDataArray);
  }

  await dbConnection.query(
    queryBuiderInsertWithUpdate("item", fieldsOfItem, Items.length),
    itemsDataArray
  );
};
module.exports = { insertUpdateItems };
