const OAuthClient = require("intuit-oauth");
const getCompanyInfo = (req, res) => {
  var oauthClient = req.app.get("oauthClient");
  var url =
    oauthClient.environment == "sandbox"
      ? OAuthClient.environment.sandbox
      : OAuthClient.environment.production;
  const { companyId } = req.params;

  console.log(oauthClient);
  oauthClient
    .makeApiCall({
      url: url + "v3/company/" + companyId + "/companyinfo/" + companyId,
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

const fullUpdateCompanyInfo = (req, res) => {
  var oauthClient = req.app.get("oauthClient");
  var url =
    oauthClient.environment == "sandbox"
      ? OAuthClient.environment.sandbox
      : OAuthClient.environment.production;
  const { companyId } = req.params;

  const body = {
    SyncToken: "3",
    domain: "QBO",
    LegalAddr: {
      City: "Mountain View",
      Country: "US",
      Line1: "2500 Garcia Ave",
      PostalCode: "94043",
      CountrySubDivisionCode: "CA",
      Id: "1",
    },
    SupportedLanguages: "en",
    CompanyName: "Larry's Bakery",
    Country: "US",
    CompanyAddr: {
      City: "Mountain View",
      Country: "US",
      Line1: "2500 Garcia Ave",
      PostalCode: "94043",
      CountrySubDivisionCode: "CA",
      Id: "1",
    },
    sparse: false,
    Id: "1",
    WebAddr: {},
    FiscalYearStartMonth: "January",
    CustomerCommunicationAddr: {
      City: "Mountain View",
      Country: "US",
      Line1: "2500 Garcia Ave",
      PostalCode: "94043",
      CountrySubDivisionCode: "CA",
      Id: "1",
    },
    PrimaryPhone: {
      FreeFormNumber: "(650)944-4444",
    },
    LegalName: "Larry's Bakery",
    CompanyStartDate: "2015-06-05",
    Email: {
      Address: "donotreply@intuit.com",
    },
    NameValue: [
      {
        Name: "NeoEnabled",
        Value: "true",
      },
      {
        Name: "IndustryType",
        Value: "Bread and Bakery Product Manufacturing",
      },
      {
        Name: "IndustryCode",
        Value: "31181",
      },
      {
        Name: "SubscriptionStatus",
        Value: "PAID",
      },
      {
        Name: "OfferingSku",
        Value: "QuickBooks Online Plus",
      },
      {
        Name: "PayrollFeature",
        Value: "true",
      },
      {
        Name: "AccountantFeature",
        Value: "false",
      },
    ],
    MetaData: {
      CreateTime: "2015-06-05T13:55:54-07:00",
      LastUpdatedTime: "2015-07-06T08:51:50-07:00",
    },
  };

  console.log(oauthClient);
  oauthClient
    .makeApiCall({
      url: url + "v3/company/" + companyId + "/companyinfo",
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(body),
    })
    .then(function (resp) {
      console.log(resp);
      return res.send("editFull" + JSON.parse(authResponse.text()));
    })
    .catch(function (e) {
      console.error(e);
    });
};

module.exports = { getCompanyInfo, fullUpdateCompanyInfo };
