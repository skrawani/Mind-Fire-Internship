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
