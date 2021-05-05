var request = require("request");

var Tokens = require("csrf");
var csrf = new Tokens();
var QuickBooks = require("node-quickbooks");
QuickBooks.setOauthVersion("2.0");

const isAuthenticated = (req, res) => {
  res.send(req.session.accessToken !== undefined);
};

// OAUTH 2 makes use of redirect requests
function generateAntiForgery(session) {
  console.log(session);
  session.secret = csrf.secretSync();
  return csrf.create(session.secret);
}

// AuthorizationUri
const authenticate = (req, res) => {
  var redirecturl =
    QuickBooks.AUTHORIZATION_URL +
    "?client_id=" +
    process.env.CLIENT_ID +
    "&redirect_uri=" +
    encodeURIComponent(process.env.REDIRECT_URI) + //Make sure this path matches entry in application dashboard
    "&scope=com.intuit.quickbooks.accounting" +
    "&response_type=code" +
    "&state=" +
    generateAntiForgery(req.session);
  console.log(redirecturl);
  res.send(redirecturl);
};

const callback = (req, res) => {
  console.log("in callback");
  var auth = Buffer.from(
    process.env.CLIENT_ID + ":" + process.env.CLIENT_SECRET
  ).toString("base64");

  var postBody = {
    url: "https://oauth.platform.intuit.com/oauth2/v1/tokens/bearer",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/x-www-form-urlencoded",
      Authorization: "Basic " + auth,
    },
    form: {
      grant_type: "authorization_code",
      code: req.query.code,
      redirect_uri: process.env.REDIRECT_URI, //Make sure this path matches entry in application dashboard
    },
  };

  request.post(postBody, function (err, r, data) {
    if (err) {
      console.log(err);
    }
    req.session.realmId = req.query.realmId;
    req.session.accessToken = JSON.parse(r.body);
    req.session.cookie.maxAge = 1000 * 60 * 60;
    req.session.save();
  });

  res.send(
    '<!DOCTYPE html><html lang="en"><head></head><body><script>window.opener.location.reload(); window.close();</script></body></html>'
  );
};

const logout = (req, res) => {
  //
  req.session.destroy();
  res.redirect("/");
};
module.exports = { isAuthenticated, authenticate, callback, logout };
