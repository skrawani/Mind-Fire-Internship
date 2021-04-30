// Import libraries
const express = require("express");
const {
  getCompanyInfo,
  fullUpdateCompanyInfo,
} = require("../controllers/companyInfoController");
const router = express.Router();
router.get("/", (req, res) => {
  res.send("hey");
});
router.get("/fullUpdateCompanyInfo/:companyId", fullUpdateCompanyInfo);
router.get("/:companyId", getCompanyInfo);

module.exports = router;
