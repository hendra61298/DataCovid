const https = require("https");
const mysql = require("mysql");
require("dotenv").config();

//init db
const con = mysql.createConnection({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_NAME,
});

//function to get date formatted with diff date with (H- diff)
function getFormattedDatewithDiffDay(diff) {
  var dateSelected = new Date();
  dateSelected.setDate(dateSelected.getDate() - diff);
  day = "" + dateSelected.getDate();
  year = dateSelected.getFullYear();
  month = "" + (dateSelected.getMonth() + 1);

  if (month.length < 2) month = "0" + month;
  if (day.length < 2) day = "0" + day;

  return [year, month, day].join("-");
}

//function to get data world
function getDataCovidApiAndInsert(dateSelected, iso) {
  const options = {
    hostname: "covid-api.com",
    path:
      iso != "WORLD"
        ? `/api/reports/total?date=${dateSelected}&iso=${iso}`
        : `/api/reports/total?date=${dateSelected}`,
    method: "GET",
  };

  const req = https.request(options, (res) => {
    res.on("data", (d) => {
      let data = JSON.parse(d.toString());
      /*
      Sample Response
      {
        data: {
            date: '2022-01-22',
            last_update: '2022-01-23 04:21:13',
            confirmed: 348799023,
            confirmed_diff: 2385594,
            deaths: 5591179,
            deaths_diff: 6289,
            recovered: 0,
            recovered_diff: 0,
            active: 343207844,
            active_diff: 2379305,
            fatality_rate: 0.016
        }
      }
      */
      insertDataToDb(data["data"], iso);
    });
  });
  req.end();

  return 1;
}

function insertDataToDb(data, iso) {
  //checking if data exist
  var sql = `SELECT * FROM covid WHERE date='${data["date"]}' AND iso='${iso}'`;
  con.query(sql, function (err, result) {
    //if data still not exist
    if (result.length == 0) {
      sql = `INSERT INTO covid (deaths, active, recovered, date, iso) VALUES ('${data["deaths"]}', '${data["active"]}', '${data["recovered"]}', '${data["date"]}', '${iso}')`;
      con.query(sql, function (err, result) {
        console.log("insert success " + data["date"]);
      });
    } else {
      console.log(
        "insert skipped, because data already exist for date : " +
          data["date"] +
          " and iso : " +
          iso
      );
    }
  });

  return 1;
}

//main logic schduler
for (var i = 30; i > 0; i--) {
  //get data with world ISO World
  getDataCovidApiAndInsert(getFormattedDatewithDiffDay(i), "WORLD");

  //get data with world ISO Indonesia
  getDataCovidApiAndInsert(getFormattedDatewithDiffDay(i), "IDN");
}
