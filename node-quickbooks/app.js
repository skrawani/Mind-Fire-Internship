// Importing dotenv library
require("dotenv").config();

// Import libraries
const express = require("express");
const app = express();
const path = require("path");
var cors = require("cors");

// Importing Routes
const companyInfoRoutes = require("./routes/companyInfoRoutes");
const authRoutes = require("./routes/authRoutes");
const accountRoutes = require("./routes/accountRoutes");
const customerRoutes = require("./routes/customerRoutes");
const invoiceRoutes = require("./routes/invoiceRoutes");

// Defining gloabal variables
const PORT = process.env.PORT ? process.env.PORT : 5000;

app.use(cors());
app.options("*", cors());
app.use(express.urlencoded({ extended: true }));
app.use(express.static(path.join(__dirname, "/public")));
app.engine("html", require("ejs").renderFile);
app.set("view engine", "html");
app.use(express.json());

// Api Routes
app.use("/api/auth", authRoutes);
app.use("/api/companyInfo", companyInfoRoutes);
app.use("/api/account", accountRoutes);
app.use("/api/customer", customerRoutes);
app.use("/api/invoice", invoiceRoutes);

// Starting the server
app.listen(PORT, () => {
  console.log(`Listening to port ${PORT}`);
});
