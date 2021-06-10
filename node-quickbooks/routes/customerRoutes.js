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
router.get("/:companyId/createCustomer", createCustomer);
router.get("/:companyId/query", queryCustomer);
router.get("/:companyId/updateCustomer", updateCustomer);
router.get("/:companyId/:customerId", readCustomer);

module.exports = router;
