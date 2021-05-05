require("dotenv").config();
const express = require("express");
const port = 3000;
const mysql = require("mysql");
const app = express();
app.use(express.json());
app.use(
  express.urlencoded({
    extended: true,
  })
);
const peopleRoutes = require("./routes/peopleRoutes");
app.use("/people/", peopleRoutes);

const mySqlConnection = mysql.createConnection({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASS,
  database: process.env.DATABASE,
  multipleStatements: true,
});

mySqlConnection.connect((err) => {
  if (err) console.log(err);
  else console.log("DB Connected");
});

app.get("/", (req, res) => {
  res.json({ message: "ok" });
});

app.listen(port, () => {
  console.log(`Example app listening at http://localhost:${port}`);
});
