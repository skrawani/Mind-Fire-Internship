const test = (req, res) => {
  let qbo = req.app.get("qbo");

  qbo.findInvoices(function (err, invoice) {
    if (err) console.log(err);
    else res.send(invoice);
  });
};

const createInvoice = (req, res) => {
  //
  let qbo = req.app.get("qbo");
  let body = {
    Line: [
      {
        DetailType: "SalesItemLineDetail",
        Amount: 100.0,
        SalesItemLineDetail: {
          ItemRef: {
            name: "Services",
            value: "1",
          },
        },
      },
    ],
    CustomerRef: {
      value: "1",
    },
  };
  qbo.createInvoice(body, function (err, invoice) {
    if (err) console.log(err);
    else res.send(invoice);
  });
};

const deleteInvoice = (req, res) => {
  let qbo = req.app.get("qbo");
  let body = {
    SyncToken: "3",
    Id: "148",
  };
  qbo.deleteInvoice(body, function (err, invoice) {
    if (err) console.log(err);
    else res.send(invoice);
  });
};

// TODO: call  updateInvoce with suitable body
const voidInvoice = (req, res) => {
  //
};

const pdfInvoice = (req, res) => {
  const { invoiceId } = req.params;
  let qbo = req.app.get("qbo");
  qbo.getInvoicePdf(invoiceId, function (err, invoice) {
    if (err) console.log(err);
    else {
      res.setHeader("Content-Type", "application/pdf");
      res.setHeader("Content-Disposition", "attachment; filename=invoice.Pdf");
      res.setHeader("Content-Length", invoice.length);
      return res.status(200).send(invoice);
    }
  });
};

const readInvoice = (req, res) => {
  //
  const { invoiceId } = req.params;
  let qbo = req.app.get("qbo");
  qbo.getInvoice(invoiceId, function (err, invoice) {
    if (err) console.log(err);
    else res.send(invoice);
  });
};

const sendInvoicePdf = (req, res) => {
  //
  const { invoiceId } = req.params;
  const { sendTo } = req.query;
  let qbo = req.app.get("qbo");
  qbo.sendInvoicePdf(invoiceId, sendTo, function (err, invoice) {
    if (err) console.log(err);
    else res.send(invoice);
  });
};

const updateInvoice = (req, res) => {
  let qbo = req.app.get("qbo");
  let body = {
    SyncToken: "0",
    AllowIPNPayment: false,
    AllowOnlinePayment: false,
    AllowOnlineCreditCardPayment: false,
    AllowOnlineACHPayment: false,
    domain: "QBO",
    sparse: false,
    Id: "150",
    SyncToken: "0",
    MetaData: {
      CreateTime: "2021-05-01T12:02:09-07:00",
      LastUpdatedTime: "2021-05-01T12:02:09-07:00",
    },
    CustomField: [],
    DocNumber: "1043",
    TxnDate: "2021-05-01",
    CurrencyRef: {
      value: "USD",
      name: "United States Dollar",
    },
    LinkedTxn: [],
    Line: [
      {
        Id: "1",
        LineNum: 1,
        Amount: 100,
        DetailType: "SalesItemLineDetail",
        SalesItemLineDetail: {
          ItemRef: {
            value: "1",
            name: "Services",
          },
          TaxCodeRef: {
            value: "NON",
          },
        },
      },
      {
        Amount: 100,
        DetailType: "SubTotalLineDetail",
        SubTotalLineDetail: {},
      },
    ],
    TxnTaxDetail: {
      TotalTax: 0,
    },
    CustomerRef: {
      value: "1",
      name: "Amy's Bird Sanctuary",
    },
    BillAddr: {
      Id: "2",
      Line1: "4581 Finch St.",
      City: "Bayshore",
      CountrySubDivisionCode: "CA",
      PostalCode: "94326",
      Lat: "INVALID",
      Long: "INVALID",
    },
    ShipAddr: {
      Id: "2",
      Line1: "4581 Finch St.",
      City: "Bayshore",
      CountrySubDivisionCode: "CA",
      PostalCode: "94326",
      Lat: "INVALID",
      Long: "INVALID",
    },
    DueDate: "2021-05-31",
    TotalAmt: 100,
    ApplyTaxAfterDiscount: false,
    PrintStatus: "NeedToPrint",
    EmailStatus: "NotSet",
    Balance: 100,
  };
  qbo.updateInvoice(body, function (err, invoice) {
    if (err) console.log(err);
    else res.send(invoice);
  });
};

module.exports = {
  test,
  createInvoice,
  deleteInvoice,
  voidInvoice,
  pdfInvoice,
  readInvoice,
  sendInvoicePdf,
  updateInvoice,
};
