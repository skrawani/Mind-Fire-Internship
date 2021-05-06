const cron = require("node-cron");

module.exports = (req, res, next) => {
  cron.schedule("*/1 * * * * *", function () {
    console.log("middleware call");
  });
  next();
};
