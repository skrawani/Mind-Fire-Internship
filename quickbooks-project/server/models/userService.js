const dbConnection = require("./db");

// Get All users from DB
const getUsers = async () => {
  const statement = `SELECT id, realmId , accessToken, refreshToken FROM user WHERE 1`;
  try {
    const [rows, fields] = await dbConnection.query(statement);
    return rows;
  } catch (err) {
    console.log(err);
    return [];
  }
};

// Update access token of a user
const updateAccessTokenAllUsers = async (id, accessToken) => {
  const statememt = `UPDATE user SET accessToken = ? , refreshToken = ?, updatedAt = ? WHERE id = ?`;
  try {
    await dbConnection.query(statememt, [
      accessToken.access_token,
      accessToken.refresh_token,
      new Date(),
      id,
    ]);
  } catch (err) {
    console.log(err);
  }
};

module.exports = { getUsers, updateAccessTokenAllUsers };
