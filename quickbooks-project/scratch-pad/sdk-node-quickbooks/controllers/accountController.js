const OAuthClient = require("intuit-oauth");

const test = (req, res) => {
  res.send("Account Route Working");
};

const findAll = (req, res) => {
  let qbo = req.app.get("qbo");
  qbo.findAccounts(1, function (e, accounts) {
    return res.send(accounts);
    // accounts.QueryResponse.Account.forEach(function (account) {
    //   console.log(account.Name);
    // });
  });
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
  //
};

const fullUpdateInfo = (req, res) => {};

module.exports = {
  test,
  queryAccount,
  getAccountDetailById,
  createAccount,
  fullUpdateInfo,
  findAll,
};
