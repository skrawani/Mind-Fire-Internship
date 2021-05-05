const mysql = require("mysql");

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

module.exports = mySqlConnection;
