// Import libraries
const express = require("express");
const {
  authenticate,
  callback,
  isAuthenticated,
  logout,
} = require("../controllers/authController");
const router = express.Router();

router.get("/authenticate", authenticate);
router.get("/callback", callback);
router.get("/isAuthenticated", isAuthenticated);
router.get("/logout", logout);

module.exports = router;
