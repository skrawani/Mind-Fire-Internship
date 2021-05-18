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
  for (const qbo of qboObjArray) {
    const id = userIdRealmIdMap.get(qbo.realmId);
    await getItemsHelper(qbo, id);
  }
};

module.exports = getItems;
