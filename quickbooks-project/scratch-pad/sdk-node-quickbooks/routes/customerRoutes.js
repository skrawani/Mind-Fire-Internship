const express = require("express");
const router = express.Router();
const {
  test,
  createCustomer,
  queryCustomer,
  readCustomer,
  updateCustomer,
} = require("../controllers/customerController");

router.get("/", test);
router.get("/createCustomer", createCustomer);
router.get("/query", queryCustomer);
router.get("/updateCustomer", updateCustomer);
router.get("/:customerId", readCustomer);

module.exports = router;
