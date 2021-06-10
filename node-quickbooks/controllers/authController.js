const OAuthClient = require("intuit-oauth");
const oauthClient = require("../configs/oauthConfig");

// function Wrapper(callback) {
//   var value = false;
//   this.set = function (v) {
//     value = v;
//     callback(this);
//   };
//   this.get = function () {
//     return value;
//   };
// }

const isAuthenticated = (req, res) => {
  res.send(oauthClient.token.access_token.length !== 0);
};

// AuthorizationUri
const authenticate = (req, res) => {
  var authUri = oauthClient.authorizeUri({
    scope: [OAuthClient.scopes.Accounting, OAuthClient.scopes.OpenId],
    state: "testState",
  }); // can be an array of multiple scopes ex : {scope:[OAuthClient.scopes.Accounting,OAuthClient.scopes.OpenId]}
  console.log(authUri);
  res.send(authUri);
};

const callback = (req, res) => {
  oauth2_token_json = true;
  oauthClient
    .createToken(req.url)
    .then(function (authResponse) {
      oauth2_token_json = authResponse;
      console.log("ORJ", oauth2_token_json);
      req.app.set("oauthClient", oauthClient);
      // console.log(oauthClient);
      oauth2_token_json = false;
    })
    .catch(function (e) {
      console.error(e);
    });

  res.send("");
};

module.exports = { isAuthenticated, authenticate, callback };
