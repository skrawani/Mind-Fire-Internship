const OAuthClient = require("intuit-oauth");
const oauthClient = require("../configs/oauthConfig");
const token = require("../tempToken");
const test = (req, res) => {
  res.send("Account Route Working");
};

const createInvoice = (req, res) => {
  oauthClient.setToken(token);
  var url =
    oauthClient.environment == "sandbox"
      ? OAuthClient.environment.sandbox
      : OAuthClient.environment.production;

  const { companyId } = req.params;
  const body = {
    Line: [
      {
        DetailType: "SalesItemLineDetail",
        Amount: 100.0,
        SalesItemLineDetail: {
          ItemRef: {
            name: "Services",
            value: "1",
          },
        },
      },
    ],
    CustomerRef: {
      value: "1",
    },
  };

  oauthClient
    .makeApiCall({
      url: url + "v3/company/" + companyId + "/invoice",
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
const deleteInvoice = (req, res) => {
  oauthClient.setToken(token);
  var url =
    oauthClient.environment == "sandbox"
      ? OAuthClient.environment.sandbox
      : OAuthClient.environment.production;

  const { companyId } = req.params;
  const body = {
    SyncToken: "3",
    Id: "99",
  };

  oauthClient
    .makeApiCall({
      url: url + "v3/company/" + companyId + "/invoice?operation=delete",
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
const voidInvoice = (req, res) => {
  oauthClient.setToken(token);
  var url =
    oauthClient.environment == "sandbox"
      ? OAuthClient.environment.sandbox
      : OAuthClient.environment.production;

  const { companyId } = req.params;
  const body = {
    SyncToken: "0",
    Id: "129",
  };

  oauthClient
    .makeApiCall({
      url: url + "v3/company/" + companyId + "/invoice?operation=void",
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
const pdfInvoice = (req, res) => {
  oauthClient.setToken(token);
  var url =
    oauthClient.environment == "sandbox"
      ? OAuthClient.environment.sandbox
      : OAuthClient.environment.production;

  const { companyId, invoiceId } = req.params;
  console.log(
    url + "v3/company/" + companyId + "/invoice/" + invoiceId + "/pdf"
  );
  oauthClient
    .makeApiCall({
      url: url + "v3/company/" + companyId + "/invoice/" + invoiceId + "/pdf",
      method: "GET",
      headers: {
        "Content-Type": "application/pdf",
        accept: "application/pdf",
      },
    })
    .then(function (authResponse) {
      console.log("The response for API call is :" + authResponse);
      //   return res.send(JSON.parse(authResponse.text()));
    })
    .catch(function (e) {
      console.error(e);
    });
};

module.exports = {
  test,
  createInvoice,
  deleteInvoice,
  voidInvoice,
  pdfInvoice,
};
