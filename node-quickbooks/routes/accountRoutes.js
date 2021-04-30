// Import libraries
const express = require("express");
const router = express.Router();
const {
  test,
  getAccountDetailById,
  createAccount,
  queryAccount,
} = require("../controllers/accountController");

router.get("/", test);

router.get("/:companyId/account/:accountId", getAccountDetailById);
router.get("/:companyId/createAccount", createAccount);
router.get("/:companyId/query", queryAccount);

module.exports = router;
