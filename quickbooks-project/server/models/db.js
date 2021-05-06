// const mysql = require("mysql");

// const mySqlConnection = mysql.createConnection({
//   host: process.env.DB_HOST,
//   user: process.env.DB_USER,
//   password: process.env.DB_PASS,
//   database: process.env.DB_NAME,
//   multipleStatements: true,
// });

// mySqlConnection.connect((err) => {
//   if (err) console.log(err);
//   else console.log("DB Connected");
// });

// module.exports = mySqlConnection;

const mysql = require("mysql2");
// Create the connection pool. The pool-specific settings are the defaults

const pool = mysql
  .createPool({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASS,
    database: process.env.DB_NAME,
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0,
  })
  .promise();

module.exports = pool;
