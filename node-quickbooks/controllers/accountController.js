const OAuthClient = require("intuit-oauth");

const test = (req, res) => {
  res.send("Account Route Working");
};

// FIXME: Api not working api call gives application error has occured
const queryAccount = (req, res) => {
  var oauthClient = req.app.get("oauthClient");
  var url =
    oauthClient.environment == "sandbox"
      ? OAuthClient.environment.sandbox
      : OAuthClient.environment.production;
  const { companyId } = req.params;
  //   let { query } = req.query;
  let query = "select * from Account";
  //   query = encodeURIComponent(query);
  console.log(query);
  console.log(oauthClient);
  oauthClient
    .makeApiCall({
      url:
        url +
        "v3/company/" +
        companyId +
        "/query?query=" +
        query +
        "&minorversion=57",
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

const getAccountDetailById = (req, res) => {
  var oauthClient = req.app.get("oauthClient");
  var url =
    oauthClient.environment == "sandbox"
      ? OAuthClient.environment.sandbox
      : OAuthClient.environment.production;
  const { companyId, accountId } = req.params;

  console.log(oauthClient);
  oauthClient
    .makeApiCall({
      url: url + "v3/company/" + companyId + "/account/" + accountId,
    })
    .then(function (authResponse) {
      console.log(authResponse);
      return res.json(JSON.parse(authResponse.text()));
    })
    .catch(function (e) {
      console.error(e);
    });
};

const createAccount = (req, res) => {
  var oauthClient = req.app.get("oauthClient");
  console.log(oauthClient);
  var url =
    oauthClient.environment == "sandbox"
      ? OAuthClient.environment.sandbox
      : OAuthClient.environment.production;
  const { companyId } = req.params;
  const body = {
    Name: "Sachin_test",
    AccountType: "Accounts Receivable",
  };
  console.log(oauthClient);
  oauthClient
    .makeApiCall({
      url: url + "v3/company/" + companyId + "/account",
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

const fullUpdateInfo = (req, res) => {};

module.exports = {
  test,
  queryAccount,
  getAccountDetailById,
  createAccount,
  fullUpdateInfo,
};
