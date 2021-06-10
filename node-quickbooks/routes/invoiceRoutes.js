const express = require("express");
const router = express.Router();
const {
  test,
  createInvoice,
  deleteInvoice,
  voidInvoice,
  pdfInvoice,
} = require("../controllers/invoiceController");

router.get("/", test);
router.get("/:companyId/createInvoice", createInvoice);
router.get("/:companyId/deleteInvoice", deleteInvoice);
router.get("/:companyId/voidInvoice", voidInvoice);
router.get("/:companyId/:invoiceId/pdf", pdfInvoice);

module.exports = router;
