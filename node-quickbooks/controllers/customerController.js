const OAuthClient = require("intuit-oauth");
const oauthClient = require("../configs/oauthConfig");
const token = require("../tempToken");
const test = (req, res) => {
  res.send("Account Route Working");
};

const createCustomer = (req, res) => {
  oauthClient.setToken(token);
  var url =
    oauthClient.environment == "sandbox"
      ? OAuthClient.environment.sandbox
      : OAuthClient.environment.production;

  const { companyId } = req.params;

  const body = {
    FullyQualifiedName: "King dGroceries",
    PrimaryEmailAddr: {
      Address: "jdrew@myemail.com",
    },
    DisplayName: "King's dGroceries",
    Suffix: "Jr",
    Title: "Mr",
    MiddleName: "Bhim",
    Notes: "Here are other details.",
    FamilyName: "King",
    PrimaryPhone: {
      FreeFormNumber: "(555) 555-5555",
    },
    CompanyName: "King sGroceries",
    BillAddr: {
      CountrySubDivisionCode: "CA",
      City: "Mountain View",
      PostalCode: "94042",
      Line1: "123 Main Street",
      Country: "USA",
    },
    GivenName: "James s",
  };
  console.log(oauthClient);
  oauthClient
    .makeApiCall({
      url: url + "v3/company/" + companyId + "/customer",
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(body),
    })
    .then(function (authResponse) {
      console.log(
        "The response for API call is :" + JSON.stringify(authResponse)
      );
      return res.send(JSON.parse(authResponse.text()));
    })
    .catch(function (e) {
      console.error(e);
    });
};

const queryCustomer = (req, res) => {
  oauthClient.setToken(token);
  var url =
    oauthClient.environment == "sandbox"
      ? OAuthClient.environment.sandbox
      : OAuthClient.environment.production;

  const { companyId } = req.params;
  let apiUrl =
    url + "v3/company/" + companyId + "/query?query=" + req.query.query;
  oauthClient
    .makeApiCall({
      url: apiUrl,
    })
    .then(function (authResponse) {
      console.log(
        "The response for API call is :" + JSON.stringify(authResponse)
      );
      return res.send(JSON.parse(authResponse.text()));
    })
    .catch(function (e) {
      console.error(e);
    });
};

const readCustomer = (req, res) => {
  oauthClient.setToken(token);
  var url =
    oauthClient.environment == "sandbox"
      ? OAuthClient.environment.sandbox
      : OAuthClient.environment.production;

  const { companyId, customerId } = req.params;
  let apiUrl = url + "v3/company/" + companyId + "/customer/" + customerId;
  oauthClient
    .makeApiCall({
      url: apiUrl,
    })
    .then(function (authResponse) {
      console.log(
        "The response for API call is :" + JSON.stringify(authResponse)
      );
      return res.send(JSON.parse(authResponse.text()));
    })
    .catch(function (e) {
      console.error(e);
    });
};

const updateCustomer = (req, res) => {
  oauthClient.setToken(token);
  var url =
    oauthClient.environment == "sandbox"
      ? OAuthClient.environment.sandbox
      : OAuthClient.environment.production;

  const { companyId } = req.params;

  const body = {
    domain: "QBO",
    PrimaryEmailAddr: {
      Address: "Surf@Intuit.com",
    },
    DisplayName: "Bill's Windsurf Shop",
    PreferredDeliveryMethod: "Print",
    GivenName: "Bill",
    FullyQualifiedName: "Bill's Windsurf Shop",
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
    MiddleName: "Mac",
    Taxable: false,
    Balance: 85.0,
    SyncToken: "0",
    CompanyName: "Bill's Windsurf Shop",
    FamilyName: "Lucchini",
    PrintOnCheckName: "Bill's Wind Surf Shop",
    sparse: false,
    Id: "2",
  };
  console.log(oauthClient);
  oauthClient
    .makeApiCall({
      url: url + "v3/company/" + companyId + "/customer",
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(body),
    })
    .then(function (authResponse) {
      console.log(
        "The response for API call is :" + JSON.stringify(authResponse)
      );
      return res.send(JSON.parse(authResponse.text()));
    })
    .catch(function (e) {
      console.error(e);
    });
};

module.exports = {
  test,
  queryCustomer,
  createCustomer,
  readCustomer,
  updateCustomer,
};
