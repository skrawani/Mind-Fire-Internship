const test = (req, res) => {
  let qbo = req.app.get("qbo");

  qbo.findItems(function (err, invoice) {
    if (err) console.log(err);
    else res.send(invoice);
  });
};

// Create Item or Cateogary
const createItem = (req, res) => {
  //
  let qbo = req.app.get("qbo");
  let body = {
    SubItem: true,
    Type: "Category",
    Name: "Cedsar",
    ParentRef: {},
  };
  qbo.createItem(body, function (err, item) {
    if (err) console.log(err);
    else res.send(item);
  });
};

const queryBundle = (req, res) => {
  //
};
const queryCategory = (req, res) => {
  //
};
const queryItem = (req, res) => {
  //
};

const getItem = (req, res) => {
  const { itemId } = req.params;
  let qbo = req.app.get("qbo");
  qbo.getItem(itemId, function (err, item) {
    if (err) console.log(err);
    else res.send(item);
  });
};

const updateItem = (req, res) => {
  let qbo = req.app.get("qbo");
  let body = {
    FullyQualifiedName: "Rock Fountain",
    domain: "QBO",
    Id: "20",
    Name: "Rock Founstain",
    TrackQtyOnHand: true,
    Type: "Inventory",
    PurchaseCost: 125,
    QtyOnHand: 2,
    IncomeAccountRef: {
      name: "Sales of Product Income",
      value: "79",
    },
    AssetAccountRef: {
      name: "Inventory Asset",
      value: "81",
    },
    Taxable: true,
    sparse: false,
    Active: true,
    SyncToken: "0",
    InvStartDate: "2021-05-19",
    UnitPrice: 275,
    ExpenseAccountRef: {
      name: "Cost of Goods Sold",
      value: "80",
    },
    PurchaseDesc: "Rock Fountain",
    Description: "New, updated description for Rock Fountain",
  };
  qbo.updateItem(body, function (err, invoice) {
    if (err) console.log(err);
    else res.send(invoice);
  });
};

module.exports = {
  test,
  createItem,
  getItem,
  updateItem,
};
