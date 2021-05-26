const {
  getTimeActivities,
  setActivityId,
} = require("../models/TimeActivitiesService");

// helper function for getTimeActivities
const setTimeActivitiesHelper = async (qbo, rawData) => {
  return new Promise(async (resolve) => {
    const data = {
      NameOf: rawData.nameOf,
      Hours: rawData.hours,
      Minutes: rawData.minutes,
      HourlyRate: rawData.hourlyRate,
      BillableStatus: rawData.billableStatus,
      TxnDate: rawData.txnDate,
    };

    if (rawData.itemId != null) {
      data.ItemRef = {
        value: rawData.itemId,
      };
    }

    if (rawData.empId != null) {
      data.EmployeeRef = {
        value: rawData.empId,
      };
    }

    if (rawData.customerId != null) {
      data.CustomerRef = {
        value: rawData.customerId,
      };
    }
    if (rawData.vendorId != null) {
      data.VendorRef = {
        value: rawData.vendorId,
      };
    }
    qbo.createTimeActivity(data, async (err, QueryResponse) => {
      if (err) {
        console.log(err.Fault);
      }
      try {
        await setActivityId(
          QueryResponse.Id,
          QueryResponse.SyncToken,
          rawData.Id
        );
      } catch (error) {
        console.log(err);
      }
      resolve();
    });
  });
};

// get All TimeActivity from QBO
const setTimeActivities = async (qboObjArray, userIdRealmIdMap) => {
  for (const qbo of qboObjArray) {
    const id = userIdRealmIdMap.get(qbo.realmId);
    const resp = await getTimeActivities(id);
    const data = resp.data;
    for (const d of data) {
      await setTimeActivitiesHelper(qbo, d);
    }
  }
};

module.exports = setTimeActivities;
