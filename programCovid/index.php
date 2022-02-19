<html>
    <head>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<?php
include('connection.php');

$death = 0;
$recovered = 0;
$active = 0;

$deathWorld = 0;
$recoveredWorld = 0;
$activeWorld = 0;

if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
  $dateEnd = $_GET['end_date'];
  $dateStart = $_GET['start_date'];
} else {
  // default h-7 data
  $dateEnd = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
  $dateStart = date('Y-m-d', strtotime('-8 day', strtotime(date('Y-m-d'))));
}


$sql = "SELECT * FROM covid WHERE date >= '".$dateStart."' AND date <= '".$dateEnd."';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if ($row["iso"]=="IDN"){
      $death = $death + $row["deaths"];
      $active = $active + $row["active"];
      $recovered = $recovered + $row["recovered"];
    } else if ($row["iso"]=="WORLD"){
      $deathWorld = $deathWorld + $row["deaths"];
      $activeWorld = $activeWorld + $row["active"];
      $recoveredWorld = $recoveredWorld + $row["recovered"];
    }
  }
}
?>
<body>
  <div class="card text-center">
    <div class="card-header">
      Data Covid 
    </div>  
    <div class="card-body">
      <h2 class="card-title" id="country">Data Di Indonesia</h2>
    </div>
  </div>
  <div class="container">
    <div class="row" style="vertical-align: middle;justify-content: center;align-items: center; margin:15px">
      <div class="col-sm-3">
        <input class="form-control" type="text" name="daterange"/>
      </div>
    </div>
    <div class="row" style="vertical-align: middle;justify-content: center;align-items: center;">
      <div class="col-md-4" style="margin-top:10px">
        <div class="card" style="background-color:#FAF9DF;">
            <div class="card-body">
              <h3 class="card-title">Kasus Positif</h3>
              <h2 class="card-title"><?php echo number_format($active ,0,"",".") ?></h2>
              <h6 class="card-subtitle mb-2 text-muted">Jumlah kasus positif covid-19</h6>
            </div>
        </div>
      </div>
      <div class="col-md-4" style="margin-top:10px">
        <div class="card" style="background-color:#D9E3C1;">
            <div class="card-body">
              <h3 class="card-title">Sembuh</h3>
              <h2 class="card-title"><?php echo number_format($recovered ,0,"",".") ?></h2>
              <h6 class="card-subtitle mb-2 text-muted">Jumlah Penderita yang Sembuh dari Covid-19</h6>
            </div>
        </div>
      </div>
      <div class="col-md-4" style="margin-top:10px">
        <div class="card" style="background-color:#FFE2E2;">
            <div class="card-body">
              <h3 class="card-title"> Kematian </h3>
              <h2 class="card-title"><?php echo number_format($death ,0,"",".") ?></h2>
              <h6 class="card-subtitle mb-2 text-muted">Jumlah Kematian yang Terjadi Karena Covid-19</h6>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card text-center" style="margin:25px;">
    <div class="card-body">
      <h2 class="card-title" id="country">Data Di Dunia</h2>
    </div>
  </div>
  <div class="container">
    <div class="row" style="vertical-align: middle;justify-content: center;align-items: center;">
      <div class="col-md-4" style="margin-top:10px">
        <div class="card" style="background-color:#FAF9DF;">
            <div class="card-body">
              <h3 class="card-title">Kasus Positif</h3>
              <h2 class="card-title"><?php echo number_format($activeWorld ,0,"",".") ?></h2>
              <h6 class="card-subtitle mb-2 text-muted">Jumlah kasus positif covid-19</h6>
            </div>
        </div>
      </div>
      <div class="col-md-4" style="margin-top:10px">
        <div class="card" style="background-color:#D9E3C1;">
            <div class="card-body">
              <h3 class="card-title">Sembuh</h3>
              <h2 class="card-title"><?php echo number_format($recoveredWorld ,0,"",".")?></h2>
              <h6 class="card-subtitle mb-2 text-muted">Jumlah Penderita yang Sembuh dari Covid-19</h6>
            </div>
        </div>
      </div>
      <div class="col-md-4" style="margin-top:10px">
        <div class="card" style="background-color:#FFE2E2;">
            <div class="card-body">
              <h3 class="card-title"> Kematian </h3>
              <h2 class="card-title"><?php echo number_format($deathWorld ,0,"",".") ?></h2>
              <h6 class="card-subtitle mb-2 text-muted">Jumlah Kematian yang Terjadi Karena Covid-19</h6>
            </div>
        </div>
      </div>
    </div>
  </div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    locale: {
      format: 'YYYY-MM-DD' // --------Here
    },
    ranges: {
      'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
      '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
      'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
      'Bulan Kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate:'<?php echo $dateStart ?>',
    endDate:'<?php echo $dateEnd ?>',
    maxDate: '<?php echo date('Y-m-d') ?>',
    alwaysShowCalendars: true,
  }, function(start, end, label) {
    $('input[name="daterange"]').val( start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
    window.location = "?start_date="+start.format('YYYY-MM-DD')+"&end_date="+end.format('YYYY-MM-DD')
  });
  
});
</script>
</body>
    </html>