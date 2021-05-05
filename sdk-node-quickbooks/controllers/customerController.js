const test = (req, res) => {
  res.send("Account Route Working");
};

const createCustomer = (req, res) => {
  let qbo = req.app.get("qbo");
  let body = {
    FullyQualifiedName: "smksfgg Groceries",
    PrimaryEmailAddr: {
      Address: "jdrew@myemail.com",
    },
    DisplayName: "smksfgg's Groceries",
    Suffix: "Jr",
    Title: "Mr",
    MiddleName: "Bs",
    Notes: "Here are other details.",
    FamilyName: "smksfgg",
    PrimaryPhone: {
      FreeFormNumber: "(555) 555-5555",
    },
    CompanyName: "smksf`gg Groceries",
    BillAddr: {
      CountrySubDivisionCode: "CA",
      City: "Mountain View",
      PostalCode: "94042",
      Line1: "123 Main Street",
      Country: "USA",
    },
    GivenName: "James",
  };
  qbo.createCustomer(body, function (err, customer) {
    if (err) console.log(err);
    else console.log(customer);
    res.send(customer);
  });
};

// TODO: queryCustomerFunction
const queryCustomer = (req, res) => {
  //
};

const readCustomer = (req, res) => {
  const { customerId } = req.params;
  let qbo = req.app.get("qbo");
  qbo.getCustomer(customerId, function (err, customer) {
    if (err) console.log(err);
    else res.send(customer);
  });
};

const updateCustomer = (req, res) => {
  let qbo = req.app.get("qbo");
  let body = {
    domain: "QBO",
    PrimaryEmailAddr: {
      Address: "Surf@Intuit.com",
    },
    DisplayName: "Bill's Windsusssrf Shop",
    PreferredDeliveryMethod: "Print",
    GivenName: "Bssill",
    FullyQualifiedName: "Billsss's Windsurf Shop",
    BillWithParent: false,
    Job: false,
    BalanceWithJobs: 85.0,
    PrimaryPhone: {
      FreeFormNumber: "(415) 444-6538",
    },
    Active: true,
    MetaData: {
      CreateTime: "2014-09-11T16:49:28-07:00",
      LastUpdatedTime: "2015-07-23T11:07:55-07:00",
    },
    BillAddr: {
      City: "Half Moon Bay",
      Line1: "12 Ocean Dr.",
      PostalCode: "94213",
      Lat: "37.4307072",
      Long: "-122.4295234",
      CountrySubDivisionCode: "CA",
      Id: "3",
    },
    MiddleName: "Massc",
    Taxable: false,
    Balance: 85.0,
    SyncToken: "0",
    CompanyName: "Billddd's Windsurf Shop",
    FamilyName: "Lucchsssini",
    PrintOnCheckName: "Bilsssl's Wind Surf Shop",
    sparse: false,
    Id: "23",
  };
  qbo.updateCustomer(body, function (err, customer) {
    if (err) console.log(err);
    else res.send(customer);
  });
};

module.exports = {
  test,
  queryCustomer,
  createCustomer,
  readCustomer,
  updateCustomer,
};
