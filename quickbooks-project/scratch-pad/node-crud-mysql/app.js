require("dotenv").config();
const express = require("express");
const port = 3000;
const app = express();
app.use(express.json());
app.use(
  express.urlencoded({
    extended: true,
  })
);
const peopleRoutes = require("./routes/peopleRoutes");
app.use("/people/", peopleRoutes);

// read
app.get("/", (req, res) => {
  res.json({ message: "ok" });
});

// Create

// update

// delete

app.listen(port, () => {
  console.log(`Example app listening at http://localhost:${port}`);
});

{
    "FullyQualifiedName": "Trees",
    "domain": "QBO",
    "Name": "Trees",
    "SyncToken": "0",
    "sparse": false,
    "Active": true,
    "Type": "Category",
    "Id": "29",
    "MetaData": {
       "CreateTime": "2015-10-06T08:50:34-07:00",
       "LastUpdatedTime": "2015-10-06T08:50:34-07:00"
    }
 }