// Import libraries
const express = require("express");
const {
  authenticate,
  callback,
  isAuthenticated,
} = require("../controllers/authController");
const router = express.Router();

router.get("/authenticate", authenticate);
router.get("/callback", callback);
router.get("/isAuthenticated", isAuthenticated);

module.exports = router;
