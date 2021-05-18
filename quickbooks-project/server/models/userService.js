const dbConnection = require("./models/db");

const getUsers = async () => {
  const statement = `SELECT id, realmId , accessToken, refreshToken FROM user WHERE 1`;
  try {
    const [rows, fields] = await dbConnection.query(statement);
    return { success: true, data: rows, err: "" };
  } catch (err) {
    return { success: false, data: rows, err };
  }
};

const updateAccessTokenAllUsers = async () => {
  const statememt = `UPDATE user SET accessToken = ? , refreshToken = ?, updatedAt = ? WHERE id = ?`;
  try {
    await dbConnection.query(statememt, [
      accessToken.access_token,
      accessToken.refresh_token,
      new Date(),
      id,
    ]);
    return { success: true, err: "" };
  } catch (err) {
    return { success: true, err };
  }
};

module.exports = { getUsers, updateAccessTokenAllUsers };
