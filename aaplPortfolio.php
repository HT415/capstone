<?php
$username = "root";
$password = "Jamie@415";
$database = "database";
try {
  $pdo = new PDO("mysql:host=localhost;database=$database", $username, $password);
  // Set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
  die("ERROR: Could not connect. " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>AAPL Historical Price</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/4.1.2/papaparse.js"></script>
  <link href="index.css" rel="stylesheet" />
 </head>
 <body>
 <?php
    $username = "root";
    $password = "Jamie@415";
    $database ="database";
    try{
        $sql = "SELECT * FROM database.aapl WHERE database.aapl.Date LIKE '%2019%'";
        $result =  $pdo->query($sql);
        if($result->rowCount() >0) {
          $date = array();
          $open = array();
          $high = array();
          $low = array();
          $close = array();
          while($row = $result->fetch()){
            $date[] = $row["Date"];
            $open[] =$row["Open"];
            $high[] =$row["High"];
            $low[] =$row["Low"];
            $close[] = $row["Close"];
          } 
          unset($result);
        } else {
          echo "No records matching your query were found.";
        }
    } catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
    }
   unset($pdo); 
?>
  <div class="container">
   <div class="table-responsive">
    <h1>AAPL Historical Price <button onclick="exportTableToCSV('aapl.csv')">Download Historical Data</button></h1>
    <br />
    <table id="aapl_table" style="width: 420px">
    <thead>
    <tr>
      <th>Date</th>
      <th>Open</th>
      <th>High</th>
      <th>Low</th>
      <th>Close</th>
    </tr>
  </thead>
  <tbody></tbody>
  </table>
   </div>
  </div>
 </body>
</html>
<script>
  const date = <?php echo json_encode($date); ?>;
  const open = <?php echo json_encode($open); ?>;
  const high = <?php echo json_encode($high); ?>;
  const low = <?php echo json_encode($low); ?>;
  const close = <?php echo json_encode($close); ?>;
  stock_data = processData(date, open, high, low, close);
  for (var key in stock_data) {
	   var obj = stock_data[key];
	   var symbol = '';
	   var html = "<tr>";
	   
	   for (var prop in obj) {
       html += "<td>"; 
			 html += obj[prop]; 
			 html += "</td>";
 	   }
 	   html += "</tr>";
 	   $("#aapl_table tbody").append(html);
	}
function processData(date, open, high, low, close){
var data = [];
for (let i = 0; i < date.length; i++) {
  var record = {
  d: date[i],
  o: open[i],
  h: high[i],
  l: low[i],
  c: close[i],
}
  data.push(record); 
}
return data;
}
</script>
<script src="downloadCSV.js"></script>