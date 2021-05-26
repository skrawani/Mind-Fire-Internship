// Importing dotenv library
require("dotenv").config();

// Import libraries
const express = require("express"),
  app = express(),
  path = require("path"),
  cors = require("cors"),
  session = require("express-session"),
  MySQLStore = require("express-mysql-session")(session),
  MongoStore = require("connect-mongo");

// imporing middlewares
const qboMiddleware = require("./middlewares/middlewareQBO");

// Importing Routes
const authRoutes = require("./routes/authRoutes");
const accountRoutes = require("./routes/accountRoutes");
const customerRoutes = require("./routes/customerRoutes");
const invoiceRoutes = require("./routes/invoiceRoutes");
const itemRoutes = require("./routes/itemRoutes");

var options = {
  host: "localhost",
  port: 3306,
  user: "root",
  password: "pass123",
  database: "session_test",
};
var sessionStore = new MySQLStore(options);

app.use(
  session({
    key: "session_cookie_name",
    secret: "session_cookie_secret",
    store: sessionStore,
    resave: false,
    saveUninitialized: false,
  })
);

// app.use(
//   session({
//     secret: "hey",
//     resave: true,
//     saveUninitialized: true,
//     store: MongoStore.create({ mongoUrl: process.env.DB_URL }),
//     cookie: {},
//   })
// );

// Defining gloabal variables
const PORT = process.env.PORT ? process.env.PORT : 8000;

app.use(cors());
app.options("*", cors());
app.use(express.urlencoded({ extended: true }));
app.use(express.static(path.join(__dirname, "/public")));
app.engine("html", require("ejs").renderFile);
app.set("view engine", "html");
app.use(express.json());

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
