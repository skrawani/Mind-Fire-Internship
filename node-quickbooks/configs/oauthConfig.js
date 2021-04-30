const OAuthClient = require("intuit-oauth");

var oauthClient = new OAuthClient({
  clientId: process.env.CLIENT_ID,
  clientSecret: process.env.CLIENT_SECRET,
  environment: process.env.ENVIRONMENT, // ‘sandbox’ or ‘production’
  redirectUri: process.env.REDIRECT_URI,
});

module.exports = oauthClient;
