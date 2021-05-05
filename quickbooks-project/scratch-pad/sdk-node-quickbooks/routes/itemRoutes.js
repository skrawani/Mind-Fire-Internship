const express = require("express");
const router = express.Router();
const {
  test,
  createItem,
  getItem,
  updateItem,
} = require("../controllers/itemController");

router.get("/", test);
router.get("/createItem", createItem);
router.get("/updateItem", updateItem);
router.get("/:itemId/", getItem);

module.exports = router;
