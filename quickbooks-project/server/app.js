// Importing dotenv library
require("dotenv").config();

// Import libraries
const express = require("express"),
  app = express(),
  path = require("path"),
  cors = require("cors"),
  session = require("express-session");

// Importing Routes
const authRoutes = require("./routes/authRoutes");
const accountRoutes = require("./routes/accountRoutes");
const customerRoutes = require("./routes/customerRoutes");
const invoiceRoutes = require("./routes/invoiceRoutes");
const itemRoutes = require("./routes/itemRoutes");

// imporing middlewares
const qboMiddleware = require("./middlewares/qboMiddleware");
const helper = require("./cronScript");

app.use(
  session({
    key: "session_cookie_name",
    secret: "session_cookie_secret",
    resave: false,
    saveUninitialized: false,
  })
);

// Defining gloabal variables
const PORT = process.env.PORT ? process.env.PORT : 8000;

app.use(cors());
app.options("*", cors());
app.use(express.urlencoded({ extended: true }));
app.use(express.static(path.join(__dirname, "/public")));
app.engine("html", require("ejs").renderFile);
app.set("view engine", "html");
app.use(express.json());

app.use("/cron", helper);
// Api Routes
app.use("/api/auth", authRoutes);

app.use(qboMiddleware);
app.use("/api/account", accountRoutes);
app.use("/api/customer", customerRoutes);
app.use("/api/invoice", invoiceRoutes);
app.use("/api/item", itemRoutes);

// Starting the server
app.listen(PORT, () => {
  console.log(`Listening to port ${PORT}`);
});
