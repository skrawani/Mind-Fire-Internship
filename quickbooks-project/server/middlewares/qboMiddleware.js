var QuickBooks = require("node-quickbooks");

var items;
module.exports = (req, res, next) => {
  console.log(req.url);
  const { accessToken } = req.session;
  if (!accessToken) {
    return res.redirect("/");
  }

  let qbo = new QuickBooks(
    process.env.CLIENT_ID,
    process.env.CLIENT_SECRET,
    accessToken.access_token /* oAuth access token */,
    false /* no token secret for oAuth 2.0 */,
    req.session.realmId,
    true /* use a sandbox account */,
    true /* turn debugging on */,
    4 /* minor version */,
    "2.0" /* oauth version */,
    accessToken.refresh_token /* refresh token */
  );

  req.app.set("qbo", qbo);
  next();
};
