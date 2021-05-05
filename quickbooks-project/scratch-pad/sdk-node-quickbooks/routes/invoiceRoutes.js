const express = require("express");
const router = express.Router();
const {
  test,
  createInvoice,
  deleteInvoice,
  voidInvoice,
  updateInvoice,
  pdfInvoice,
  readInvoice,
  sendInvoicePdf,
} = require("../controllers/invoiceController");

router.get("/", test);
router.get("/createInvoice", createInvoice);
router.get("/deleteInvoice", deleteInvoice);
router.get("/voidInvoice", voidInvoice);
router.get("/updateInvoice", updateInvoice);
router.get("/:invoiceId/", readInvoice);
router.get("/:invoiceId/pdf", pdfInvoice);
router.get("/:invoiceId/pdf/send", sendInvoicePdf);

module.exports = router;
