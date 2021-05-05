const express = require("express");
const router = express.Router();
const mySqlConnection = require("../connection");

router.get("/", (req, res) => {
  mySqlConnection.query("SELECT * from people", (err, rows, fiels) => {
    if (err) {
      console.log(err);
    } else {
      res.send(rows);
    }
  });
});

module.exports = router;
