// Importing dotenv library
require("dotenv").config();

// Import libraries
const express = require("express");
const app = express();
const path = require("path");
var cors = require("cors");

// Importing Routes
const companyInfoRoutes = require("./routes/companyInfoRoutes");
const accountRoutes = require("./routes/accountRoutes");
const authRoutes = require("./routes/authRoutes");

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

// Starting the server
app.listen(PORT, () => {
  console.log(`Listening to port ${PORT}`);
});
