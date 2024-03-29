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
    <meta charset="utf-8">
    <title>Capstone Project</title>
    <link href="index.css" rel="stylesheet" />
  </head>
  <body>
  <?php
    $username = "root";
    $password = "Jamie@415";
    $database ="database";
    try{
        $sql1 = "SELECT * FROM database.aapl WHERE database.aapl.Date LIKE '%2019%'";
        $sql2 = "SELECT * FROM database.fb WHERE database.fb.Date LIKE '%2019%'";
        $sql3 = "SELECT * FROM database.intc WHERE database.intc.Date LIKE '%2019%'";	
        $result1 =  $pdo->query($sql1);
        $result2 =  $pdo->query($sql2);
        $result3 =  $pdo->query($sql3);
        if($result1->rowCount() >0) {
          $aapl_date = array();
          $aapl_open = array();
          $aapl_high = array();
          $aapl_low = array();
          $aapl_close = array();
          while($row = $result1->fetch()){
            $aapl_date[] = $row["Date"];
            $aapl_open[] =$row["Open"];
            $aapl_high[] =$row["High"];
            $aapl_low[] =$row["Low"];
            $aapl_close[] = $row["Close"];
          } 
          unset($result1);
        } else {
          echo "No records matching your query were found.";
        }
        if($result2->rowCount() >0) {
          $fb_date = array();
          $fb_open = array();
          $fb_high = array();
          $fb_low = array();
          $fb_close = array();
          while($row = $result2->fetch()){
            $fb_date[] = $row["Date"];
            $fb_open[] =$row["Open"];
            $fb_high[] =$row["High"];
            $fb_low[] =$row["Low"];
            $fb_close[] = $row["Close"];
          } 
          unset($result2);
        } else {
          echo "No records matching your query were found.";
        }
        if($result3->rowCount() >0) {
          $intc_date = array();
          $intc_open = array();
          $intc_high = array();
          $intc_low = array();
          $intc_close = array();
          while($row = $result3->fetch()){
            $intc_date[] = $row["Date"];
            $intc_open[] =$row["Open"];
            $intc_high[] =$row["High"];
            $intc_low[] =$row["Low"];
            $intc_close[] = $row["Close"];
          } 
          unset($result3);
        } else {
          echo "No records matching your query were found.";
        }
        $sql4 = "SELECT * FROM database.aapl WHERE database.aapl.Date NOT LIKE '%2019%'";
        $sql5 = "SELECT * FROM database.fb WHERE database.fb.Date NOT LIKE '%2019%'";
        $sql6 = "SELECT * FROM database.intc WHERE database.intc.Date NOT LIKE '%2019%'";
        $result4 =  $pdo->query($sql4);
		$result5 =  $pdo->query($sql5);
        $result6 =  $pdo->query($sql6);
        if($result4->rowCount() >0) {
			$date2 = array();
			$aapl_open2 = array();			
			$aapl_close2 = array();
          while($row = $result4->fetch()){
			$date2[] = $row["Date"];
			$aapl_open2[] =$row["Open"];
            $aapl_close2[] = $row["Close"];
          } 
          unset($result4);
        } else {
          echo "No records matching your query were found.";
        }
        if($result5->rowCount() >0) {
			$fb_open2 = array();
			$fb_close2 = array();
			while($row = $result5->fetch()){
			  $fb_open2[] =$row["Open"];
			  $fb_close2[] = $row["Close"];
			} 
			unset($result5);
		  } else {
			echo "No records matching your query were found.";
		  }
		  if($result6->rowCount() >0) {
			$intc_open2 = array();
			$intc_close2 = array();
			while($row = $result6->fetch()){
			  $intc_open2[] =$row["Open"];
			  $intc_close2[] = $row["Close"];
			} 
			unset($result6);
		  } else {
			echo "No records matching your query were found.";
		  }					
    } catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
    }
   unset($pdo); 
?>
<header>
    <h1>Try your best to use $1000 to earn $5000! <button id='instruction'>How to play?</button></h1>
</header>
<div class="wrapper">
    <div class="container" style="float: left; margin: 10px;">
	  <div class="row">
        <div class="span12" style="float:left;border: 1px solid black; background-color: white; width: 625px; heigth: 400px; margin-bottom:30px;" >
	        <button id="line">Line Chart</button>
            <button id="candlestick">Candlestick Chart</button>
            <div id="chart">
		       <div id="aapl">
		        <canvas class="linechart" id="aapl_line" style="width: 100%; "></canvas>
                <canvas class="candlestickchart" id="aapl_candlestick" style="width: 100%"></canvas>	 
		       </div>
		       <div id="fb">
                <canvas class="linechart" id="fb_line" style="width: 100%; "></canvas>
                <canvas class="candlestickchart" id="fb_candlestick" style="width: 100%"></canvas>
	          </div>
		      <div id="intc">
	           <canvas class="linechart" id="intc_line" style="width: 100%; "></canvas>
              <canvas class="candlestickchart" id="intc_candlestick" style="width: 100%"></canvas>
	          </div>
	        </div>
         </div>
		</div>
      <div class="row">
        <div class="span10">
          <table class="table" id="myPortfolio">
            <thead>
              <tr>
                <td>Stock Name</td>
                <td>Symbol</td>
                <td>Price ($)</td>
                <td>No Of Shares</td>
              <!--<td>Buy</td>
                <td>Sell</td>-->
                <td></td>
                <td></td>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="span10">
          <h3>
            Your Total Cash Flow & Portfolio Value:
            <span id="netWorth">1000</span>
          </h3>
          <h3>Your Cash Flow: <span id="cashflow">1000</span></h3>
          <h3>Your Portfolio Value: <span id="portfolio">0</span></h3>
		  <h3>Date: <span id="today"></span></h3>
		  <button id="checkrecord">Check Transaction record</button>
		  <div id="records"style="border: 1px solid black; background-color: white;"></div>
        </div>
      </div>
    </div>
	<div class="span12" style="float:left;padding: 10px;">
    <div id="algorithm" style="border: 1px solid black; background-color: white;width: 600px;">
		<div >
		<span>function algorithm() {</span><br>
		&emsp;<span>var cashflow = [];</span><br>
		&emsp;<span>cashflow[0] = parseFloat(document.getElementById("cashflow").innerHTML);</span><br>
		&emsp;<span>var pv = [];</span><br>
		&emsp;<span>pv[0] = parseFloat(document.getElementById("portfolio").innerHTML);</span><br>
		&emsp;<span>var days = 0;</span><br>
		&emsp;<span>var aapl_quantity = [];</span><br>
		&emsp;<span>aapl_quantity[0] = parseInt(document.getElementById("sharesAAPL").innerHTML);</span><br>
		&emsp;<span>var fb_quantity = [];</span><br>
		&emsp;<span>fb_quantity[0] =  parseInt(document.getElementById("sharesFB").innerHTML);</span><br>
		&emsp;<span>var intc_quantity = [];</span><br>
		&emsp;<span>intc_quantity[0] = parseInt(document.getElementById("sharesINTC").innerHTML);</span><br>
		&emsp;<span>var aapl_buyprice = </span><input type="text" style="width: 300px" id="usercode1" value="aapl_close[0]"></input>&nbsp;<span>;</span>&nbsp;&nbsp;<br>
		&emsp;<textarea id="usercode2" rows="5" cols="72"></textarea><br>
		&emsp;<span>for (</span><input type="text" style="width: 300px" id="usercode3" value="let i = 1; i < aapl_close.length; i++"></input>&nbsp;<span>) {</span>&nbsp;&nbsp;<br>
		&emsp;<textarea id="usercode4" rows="12" cols="72"></textarea><br>&emsp;<span>days++;</span><br>
		&emsp;<textarea id="usercode5" rows="5" cols="72"></textarea><br><span>}</span><br>
		&emsp;<span>return [cashflow, pv, days, aapl_quantity</span><input type="text" style="width: 240px" id="usercode6"></input>&nbsp;<span>];</span>&nbsp;&nbsp;<br>
		<span>}</span><br>	
		 <!--  
        <form id="algorithm" style="float: left; margin: 10px;" >
		<span>Spend</span>
		&nbsp;
		<input type="number" max="100" min="0" style="width: 40px" id="percentofcashflow"></input>
		<span>% of cash flow to buy </span>
	    <select id="stock1">
        <option value="aapl">AAPL</option>
        <option value="fb">FB</option>
		<option value="intc">INTC</option>
       </select>
	   <span> if </span>
	   <select id="condition1"  onchange="fieldForPeriod()">
        <option value="price">price</option>
        <option value="ma" >MA</option>
       </select>
	   <p id="period1"> (Period = <input type="number" min="0" id="period of ma"></input> days)</p>
	   <select id="operator1">
        <option value=">">></option>
        <option value=">=">>=</option>
		<option value="<"><</option>
        <option value="<="><=</option>
       </select>
	   <span>$</span>
	   <input type="text" style="width: 40px" id="price1"></input>
	   <br>
	   <span>Sell it if </span>
	   <select id="condition2"  onchange="fieldForPeriod()">
        <option value="price">price</option>
        <option value="ma" >MA</option>
       </select>
	   <p id="period1"> (Period = <input type="number" min="0" id="period of ma2"></input> days)</p>
	   <select id="operator2">
        <option value=">">></option>
        <option value=">=">>=</option>
		<option value="<"><</option>
        <option value="<="><=</option>
       </select>
	   <span>$</span>
	   <input type="text" style="width: 40px" id="price2"></input>  	    
       </form>
	   -->
      </div>
   </div>

		<div style="display: flex; justify-content: center; align-items: center;">
        <button id="execute">Execute Your Trading Algorithm</button>
	    </div>    
  </div>	
</div>
  </body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/4.1.2/papaparse.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/luxon/2.2.0/luxon.min.js"
    integrity="sha512-oSluo60wIZQeIdcwvOUslPm9iHgUrdokcX35QFYOYxS0aFMWnd3VMhgxEObgBi3YgbDC0jZGV7VXMALlznfQtg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@0.2.1"></script>
<script src="./chartjs-chart-financial.js" type="text/javascript"></script>
<script src="algorithm.js"></script>
<script src="buttonHandler.js"></script>
<script>
//show the game instruction
$("#instruction").click(function () {
  var game_instruction = "This is a simulation game for learning algorithmic trading.\n";
  game_instruction += "You start out with $1000 and 3 Stocks to buy.\n";
  game_instruction += "The goal is to rise your portfolio value from $1000 to $5000 during 2020-01-02 to 2021-09-30.\n";
  game_instruction += "You can click the 'Buy' button of each stock to buy it and click 'Sell' button to sell it.\n";
  game_instruction += "You can also type your own trading algorithm in the placeholder and click the button below it to it.\n";
  game_instruction += "The price of the Stocks changes every second and gets updated on the page in real time.\n";
  game_instruction += "You can see your portfolio value, your cash flow and your total net worth in real time too.\n";
    alert(game_instruction);
	$("#instruction").show();
});
$(function() {
	//stock data
	stocks = [
	  {
	      name : 'Apple'
	    , symbol : 'AAPL'
	    , price : aapl_open[0]
	    , shares : '0'
		, chart : ''
	    , historicaldata : ''	
	  },	  
	  {
	      name : 'Facebook'
	    , symbol : 'FB'
	    , price : fb_open[0]
	    , shares : '0'
		, chart : ''
		, historicaldata : '<button>View Historical data</button>'
	  },		
	  {
		  name: 'Intel'
		, symbol : 'INTC'
		, price : intc_open[0]
		, shares : '0'
		, chart : ''
		, historicaldata : '<button>View Historical data</button>'
	  },
	];
	//cash flow
	var cashflow = 1000;
	var today = 0;
	$('#today').html(date[today]);
	var portfoliovalue = [];
	var c = [];
	var no_of_days = 0;
	var aapl_shares = [];
	var fb_shares = [];
	var intc_shares = [];
	var records = [];
	var counter = 0;
	//portfolio value
	var portfolioValue = function(){
		var total = 0;
		for (var key in stocks) {
			var obj = stocks[key];
			var symbol = '';
			var sharesOwned = 0;
			for (var prop in obj) {
				// get symbol value to generate id of each td 
				if (prop === 'symbol') {
					symbol = obj[prop]; 
				}
				if (prop === 'price') {
					//typecast string to float
					var priceOfThisStock = parseFloat(obj[prop]);
				}
				if (prop === 'shares') {
					//typecast string to float
					var sharesOwned = parseFloat(obj[prop]);
					total += priceOfThisStock * sharesOwned;
				}
				if (prop === 'chart') {
					var viewchart = obj[prop];
				}
				if (prop === 'historicaldata') {
					var historical = obj[prop];
				}
			}
		}
		return total; 
	}

	var changePrice = function(price,symbol,today) {
		//generate a random number between -1 to 1 as the change of the stock price
		if (symbol == 'AAPL'){
			price = aapl_open[today]; 
		}
		if (symbol == 'FB'){
			price = fb_open[today]; 
		}
		if (symbol == 'INTC'){
			price = intc_open[today]; 
		}		 
		return price;
	}

	//build the table
	for (var key in stocks) {
	   var obj = stocks[key];
	   var symbol = '';
	   var html = "<tr>";
	   
	   for (var prop in obj) {
			/*
			- grab the symbol value 
			- to use to make unique ids for tds
			*/
			if (prop === 'symbol') {
				symbol = obj[prop]; 
			}			
			if (prop === 'chart') {
				html += "<td id='" + prop + symbol + "'>"; 
				html += "<button id='"+ "view" + prop + symbol + "'>View Chart</button>"; 
				html += "</td>";				
			} 
			else {
			if (prop === 'historicaldata') {
				html += "<td id='" + prop + symbol + "'>"; 
				html += "<button id='"+ "view" + prop + symbol + "'>View Historical Data</button>"; 
				html += "</td>";				
			} else {
				if (prop !== 'price') {
				html += "<td id='"+ prop + symbol + "'>"; 
				html += obj[prop]; 
				html += "</td>";
			}else {
				html += "<td id='" + prop + symbol + "'>"; 
				html += "<span id='price'>" + obj[prop] + "</span>"; 
				html += "</td>";	
			}	
			}

		}
			//if (prop === 'shares') {
			//	html += "<td> <form> <a href='#' class='buy' id='" + symbol + "Buy" + "'>Buy</a><br>";
			//	html += "<input type='number' class='"+ symbol + "quantity"+"' id='" + symbol + "BuyQuantity" + "' min ='0' style='width: 50px'><br><span>share(s)</span></form></td>"; 
			//	html += "<td> <form> <a href='#' class='sell' id='" + symbol + "Sell" + "'>Sell</a><br>";
			//	html += "<input type='number'class='quantity' id='" + symbol + "SellQuantity" + "' min ='0' style='width: 50px'><br><span>share(s)</span></form> </td>";
			//}

 	   }
 	   html += "</tr>";
 	   $("#myPortfolio tbody").append(html);
	}

	//every second do this
	function setTable() {
			// run the price through changePrice()
			// replace the new price into the stock data
			// replace the new price of the stock into the table
		for (var key in stocks) {
			var obj = stocks[key];
			var symbol = '';

			for (var prop in obj) {
				if (prop === 'symbol') {
					symbol = obj[prop]; 
				}
				if (prop === 'price') {
					var priceOfThisStock = parseFloat(obj[prop]);
					var newPrice = changePrice(priceOfThisStock,symbol,today);
				    //change the class of the new stock price when the price is not same as the previous price
				    //in order to change the font color the price 
					
					var element = "class = ";
					if(newPrice > priceOfThisStock){
						element +="'up'>"; 
					} else if (newPrice < priceOfThisStock) {
						element +="'down'>"; 
					} else{
						element +="'unchange'>"; 
					}
					$('#'+prop+symbol).html("<span id='price'"+element+ newPrice + "</span>");
				}
				if (prop === 'shares') {
					if (symbol == 'AAPL' && aapl_shares != []){
						$('#' + 'shares' + symbol).html(aapl_shares[today]); 
						if (today == 0 && aapl_shares[today] !=0){
						    records[counter] = (date[today]+"  Buy "+aapl_shares[today]+" shares of "+symbol+"\n").toString();
							document.getElementById("records").innerHTML += records[counter]+"<br>";
							counter++;
						} else {
							if (aapl_shares[today] > aapl_shares[today-1]){
							records[counter] = (date[today]+"  Buy "+(aapl_shares[today] - aapl_shares[today-1])+" shares of "+symbol+"\n").toString();
							document.getElementById("records").innerHTML += records[counter]+"<br>";
							counter++;
						   } else if (aapl_shares[today] < aapl_shares[today-1]) {
							records[counter] = (date[today]+"  Sell "+(aapl_shares[today-1] - aapl_shares[today])+" shares of "+symbol+"\n").toString();
							document.getElementById("records").innerHTML += records[counter]+"<br>";
							counter++;
					      }
					  }	
		            }
					if (symbol == 'FB' && fb_shares != []){
						$('#' + 'shares' + symbol).html(fb_shares[today]); 
						if (today == 0 && fb_shares[today] !=0){
						    records[counter] = (date[today]+"  Buy "+fb_shares[today]+" shares of "+symbol+"\n").toString();
							document.getElementById("records").innerHTML += records[counter]+"<br>";
							counter++;
						} else {
							if (fb_shares[today] > fb_shares[today-1]){
							records[counter] = (date[today]+"  Buy "+(fb_shares[today] - fb_shares[today-1])+" shares of "+symbol+"\n").toString();
							document.getElementById("records").innerHTML += records[counter]+"<br>";
							counter++;
						   } else if (fb_shares[today] < fb_shares[today-1]) {
							records[counter] = (date[today]+"  Sell "+(fb_shares[today-1] - fb_shares[today])+" shares of "+symbol+"\n").toString();
							document.getElementById("records").innerHTML += records[counter]+"<br>";
							counter++;
					      }
					  }	
		            }
					if (symbol == 'INTC' && intc_shares != []){
						$('#' + 'shares' + symbol).html(intc_shares[today]);
						if (today == 0 && intc_shares[today] !=0){
						    records[counter] = (date[today]+"  Buy "+intc_shares[today]+" shares of "+symbol+"\n").toString();
							document.getElementById("records").innerHTML += records[counter]+"<br>";
							counter++;
						} else {
							if (intc_shares[today] > intc_shares[today-1]){
							records[counter] = (date[today]+"  Buy "+(intc_shares[today] - intc_shares[today-1])+" shares of "+symbol+"\n").toString();
							document.getElementById("records").innerHTML += records[counter]+"<br>";
							counter++;
						   } else if (intc_shares[today] < intc_shares[today-1]) {
							records[counter] = (date[today]+"  Sell "+(intc_shares[today-1] - intc_shares[today])+" shares of "+symbol+"\n").toString();
							document.getElementById("records").innerHTML += records[counter]+"<br>";
							counter++;
					      }
					  }	
		            }					
				}

			}
		}   
	}

	//every second do this
	function setPorfolio() {
		/*
			- run cash flow, portfolio value, total worth functions
			  and then put them in the dom
			- decide whether buy/sell buttons should appear 
			  and then put them or remove them from the dom
		*/
	/*	for (var key in stocks) {
			var obj = stocks[key];
			//initialize 
			var symbol = '';
			var price = 0;
			var p = 0;
			var t = 0;
			for (var prop in obj) {
				/*
				- grab the symbol value 
				- to use to make unique ids for tds
				*/
/*				if (prop === 'symbol') {
					symbol = obj[prop]; 
				}

				p = portfolioValue();
				t = cashflow + p; 

				$('#cashflow').html(cashflow);
				$('#portfolio').html(p);
				$('#netWorth').html(t);
				$('#today').html(date[today]);
				//hide all buy buttons if cashflow is 0
				if (cashflow === 0) {
					$('a').each(function() {
						//grab the id of this link and typecast it to a string
  						var id = String($(this).attr('id'));
  						//if it contains buy hide it
  						if (id.indexOf('Buy') > 0) {
  							$(this).hide();
  						}
					});
				}

				if (prop === 'price') {
					price = parseFloat(obj[prop]); 
				}

				if (prop === 'shares') {
					var sharesOwned = parseFloat(obj[prop]);
				}
			}
		}*/
		var networth = c[today]+portfoliovalue[today];
		$('#cashflow').html(c[today]);
		$('#portfolio').html(portfoliovalue[today]);
		$('#netWorth').html(networth);
		$('#today').html(date[today]);
		if (networth >= 5000){
		alert("You reach the goal!");
	    } else if (today == (date.length-1)){
			if(networth >= 1000){
				alert("You earn $"+(networth-1000));
			} else{
				alert("You lost $"+(1000-networth));
			}
		} else{
			if(today < no_of_days){
			today++;
		}
		}
	}
	//happens live
	/*$(document).on('click', "a", function(){
	    //grab the id of this link and typecast it to a string
	    var id = String($(this).attr('id'));
	    //if this is a buy button
	    if (id.indexOf('Buy') > 0) {
	    	//extract the symbol of the stock this is for
	    	symbol = id.substr(0, id.indexOf('Buy')); 
		    var q = parseInt(document.getElementById(id+'Quantity').value);
	    	//only do if cash flow is greater than share price 
	    	//add a share 
	    	//subtract share amount from cashflow			
	    	//initialize
	    	var thisObj = 0; //specific object in stocks
	    	for (var key in stocks) {
	    		var obj = stocks[key];
	    		for (var prop in obj) {
	    		
	    			if (prop === 'symbol') {
	    				if (obj[prop] === symbol) { 	    					
	    					thisObj = key; 
	    				}
	    			}
	    			if (prop === 'price') {
	    				if (key === thisObj) {
	    					var priceOfThisStock = parseFloat(obj[prop]);
							var priceOfShares = priceOfThisStock*q;
	    					if ( cashflow > priceOfShares ) {
	    						var subtractPrice = true;
	    						//since you bought a share we should 
	    						//subtract the price of the share(s)
	    						//from your cashflow
	    						cashflow = cashflow - priceOfShares;
	    					}
	    				}	    				
	    			}

	    			if (prop === 'shares') {
	    				if (key === thisObj) {
	    					//if cash flow is greater than share price
	    					if (subtractPrice) {
	    						var sharesOfThisStock = parseFloat(obj[prop]);
	    						//add 1 to the shares owned for this stock
	    						sharesOfThisStock += q;    						
	    						//and update the shares inside the stocks array
	    						obj[prop] = sharesOfThisStock; 
	    						//and update the dom
	    						$('#' + 'shares' + symbol).html(sharesOfThisStock);
	    					}
	    				}
	    			}
	    		}
	    	}
	    }

	    if (id.indexOf('Sell') > 0) {
	    	symbol = id.substr(0, id.indexOf('Sell'));
			var q = parseInt(document.getElementById(id+'Quantity').value); 
	    	var thisObj = 0; 
	    	for (var key in stocks) {
	    		var obj = stocks[key];
	    		for (var prop in obj) {    		
	    			if (prop === 'symbol') {
	    				if (obj[prop] === symbol) { 
	    					thisObj = key; 
	    				}
	    			}
	    			if (prop === 'price') {
	    				if (key === thisObj) {
	    					var priceOfThisStock = parseFloat(obj[prop]);
	    				}	    				
	    			}
	    			if (prop === 'shares') {
	    				if (key === thisObj) {
	    					var sharesOfThisStock = parseFloat(obj[prop]);
	    					if (sharesOfThisStock && sharesOfThisStock>=q) {
	    						//when a share is sold, the price of the share(s) would be add to the cashflow
								var priceOfShares = priceOfThisStock*q;
	    						cashflow = cashflow + priceOfShares;
	    						//minus the number of shares sold to the shares owned for this stock
	    						sharesOfThisStock -= q;
	    						//and update the shares inside the stocks array
	    						obj[prop] = sharesOfThisStock; 
	    						//and update the dom
	    						$('#' + 'shares' + symbol).html(sharesOfThisStock);
	    					}
	    				}
	    			}
	    		}
	    	}
	    }
		if (today < date.length-1){
			today++;
		} 
	    return false;	   
	});*/

	$(document).on("click", "#execute", function () {
    var algorithm = "function algorithm() { var cashflow = [];";
	algorithm += "cashflow[0] = parseFloat(document.getElementById('cashflow').innerHTML); var pv = [];";
	algorithm += "pv[0] = parseFloat(document.getElementById('portfolio').innerHTML); var days = 0; ";
	algorithm += "var aapl_quantity = []; aapl_quantity[0] = parseInt(document.getElementById('sharesAAPL').innerHTML);";
	algorithm += "var fb_quantity = []; fb_quantity[0] = parseInt(document.getElementById('sharesFB').innerHTML);";
	algorithm += "var intc_quantity = []; intc_quantity[0] = parseInt(document.getElementById('sharesINTC').innerHTML);";
	algorithm += "var aapl_buyprice = "+document.getElementById('usercode1').value+";"+document.getElementById('usercode2').value;
	algorithm += "for ("+document.getElementById('usercode3').value+" ) { "+document.getElementById('usercode4').value;
	algorithm += "days++;"+document.getElementById('usercode5').value+"}"+"return [cashflow, pv, days, aapl_quantity";
	algorithm += document.getElementById('usercode6').value+"];}";
    var newAlgorithm =  new Function('"use strict";return ('+algorithm+')')();
	let result  = newAlgorithm();
	console.log(result);
	c = result[0];
	portfoliovalue = result[1];
	no_of_days += result[2];
	aapl_shares = result[3];
	fb_shares = result[4];
	intc_shares = result[5];
	setInterval(setTable, 1000);
	setInterval(setPorfolio, 1000);
});
});
//reformat the date and convert it into a timestamp
function reformatDate(date, open, high, low, close){
    var candlesticks = [];
    for (let i = 0; i < date.length; i++) {
        //var newdate = date[i].toString();
        var stick = {
            x: luxon.DateTime.fromSQL(date[i].toString()).ts,
            o: parseFloat(open[i]),
            h: parseFloat(high[i]),
            l: parseFloat(low[i]),
            c: parseFloat(close[i]),
        }
        candlesticks.push(stick); 
   }
   return candlesticks;
}
//encode the data to arrays for javascript
const aapl_historical_date = <?php echo json_encode($aapl_date); ?>;
const aapl_historical_open = <?php echo json_encode($aapl_open); ?>;
const aapl_historical_high = <?php echo json_encode($aapl_high); ?>;
const aapl_historical_low = <?php echo json_encode($aapl_low); ?>;
const aapl_historical_close = <?php echo json_encode($aapl_close); ?>;
const fb_historical_date = <?php echo json_encode($fb_date); ?>;
const fb_historical_open = <?php echo json_encode($fb_open); ?>;
const fb_historical_high = <?php echo json_encode($fb_high); ?>;
const fb_historical_low = <?php echo json_encode($fb_low); ?>;
const fb_historical_close = <?php echo json_encode($fb_close); ?>;
const intc_historical_date = <?php echo json_encode($intc_date); ?>;
const intc_historical_open = <?php echo json_encode($intc_open); ?>;
const intc_historical_high = <?php echo json_encode($intc_high); ?>;
const intc_historical_low = <?php echo json_encode($intc_low); ?>;
const intc_historical_close = <?php echo json_encode($intc_close); ?>;
const date = <?php echo json_encode($date2); ?>;
const aapl_open = <?php echo json_encode($aapl_open2); ?>;
const fb_open = <?php echo json_encode($fb_open2); ?>;
const intc_open = <?php echo json_encode($intc_open2); ?>;
//plot line chart of AAPL
const aapl_data_line = {
labels: aapl_historical_date,
datasets: [
{
label: "Stock Price of AAPL",
backgroundColor: "rgb(255, 99, 132)",
borderColor: "rgb(255, 99, 132)",
data: aapl_historical_close,
},
],
};
const aapl_config = {
type: "line",
data: aapl_data_line,
options: {},
};
const aapl_linechart = new Chart(document.getElementById("aapl_line"), aapl_config);
//plot candlestick chart of AAPL
const aapl_candlesticks = reformatDate(aapl_historical_date, aapl_historical_open, aapl_historical_high, aapl_historical_low, aapl_historical_close);
const aapl_data_candlesticks = {
datasets: [
{label: "Daily Change of Stock Price of AAPL",
data: aapl_candlesticks,
},
],
};
const aapl_config2 = {
type: "candlestick",
data: aapl_data_candlesticks,
options: {},
};
const aapl_candlestick = new Chart(document.getElementById("aapl_candlestick"), aapl_config2);
//plot line chart of FB
const fb_data_line = {
labels: fb_historical_date,
datasets: [
{
label: "Stock Price of FB",
backgroundColor: "rgba(255, 159, 64)",
borderColor: "rgba(255, 159, 64)",
data: fb_historical_close,
},
],
};
const fb_config = {
type: "line",
data: fb_data_line,
options: {},
};
const fb_linechart = new Chart(document.getElementById("fb_line"), fb_config);
//plot candlestick chart of FB
const  fb_candlesticks = reformatDate(fb_historical_date, fb_historical_open, fb_historical_high, fb_historical_low, fb_historical_close);
const fb_data_candlesticks = {
datasets: [
{label: "Daily Change of Stock Price of FB",
data: fb_candlesticks,
},
],
};
const fb_config2 = {
type: "candlestick",
data: fb_data_candlesticks,
options: {},
};
const fb_candlestick = new Chart(document.getElementById("fb_candlestick"), fb_config2);
//plot line chart of INTC
const intc_data_line = {
labels: intc_historical_date,
datasets: [
{
label: "Stock Price of INTC",
backgroundColor: "rgb(54, 162, 235)",
borderColor: "rgb(54, 162, 235)",
data: intc_historical_close,
},
],
};
const intc_config = {
type: "line",
data: intc_data_line,
options: {},
};
const intc_linechart = new Chart(document.getElementById("intc_line"), intc_config);
//plot candlestick chart of INTC
const intc_candlesticks = reformatDate(intc_historical_date, intc_historical_open, intc_historical_high, intc_historical_low, intc_historical_close);
const intc_data_candlesticks = {
datasets: [
{label: "Daily Change of Stock Price of INTC",
data: intc_candlesticks,
},
],
};
const intc_config2 = {
type: "candlestick",
data: intc_data_candlesticks,
options: {},
};
const intc_candlestick = new Chart(document.getElementById("intc_candlestick"), intc_config2);
const  aapl_close = <?php echo json_encode($aapl_close2); ?>;
const fb_close = <?php echo json_encode($fb_close2); ?>;
const intc_close = <?php echo json_encode($intc_close2); ?>;
const aapl_MA = getMA(aapl_historical_close,aapl_close,20);
const fb_MA = getMA(fb_historical_close,fb_close,20);
const intc_MA = getMA(intc_historical_close,intc_close,20);
/*function algorithm() {
var cashflow = [];
cashflow[0] = parseFloat(document.getElementById("cashflow").innerHTML);
var pv[] = ;
pv[0] = parseFloat(document.getElementById("portfolio").innerHTML);
var days = 0;
var aapl_quantity = [];
aapl_quantity[0] = parseInt(document.getElementById("sharesAAPL").innerHTML);
var aapl_buyprice = aapl_close[0];
aapl_quantity[0] = aapl_quantity[0]+parseInt(cashflow[0]/aapl_close[0]);
cashflow[0] = cashflow[0] - aapl_close[0]*aapl_quantity[0];
for (let i = 1; i < aapl_close.length; i++) {
	if((aapl_close[i] > aapl_buyprice) && aapl_quantity[i-1] != 0){
		cashflow[i] = cashflow[i-1] + aapl_close[i]*aapl_quantity[i-1];
		aapl_quantity[i] = 0;
	} else if ((aapl_close[i] <= aapl_buyprice) && aapl_quantity[i-1] == 0){
		aapl_quantity[i] =  parseInt(cashflow[i-1]/aapl_close[i]);
		aapl_buyprice = aapl_close[i];
		cashflow[i] = cashflow[i-1] - aapl_close[i]*aapl_quantity[i];
	} else{
		cashflow[i] = cashflow[i-1];
		aapl_quantity[i] = aapl_quantity[i-1];
	}
	days++;
	pv[i] = parseFloat(aapl_close[i]*aapl_quantity[i]);
}
	return [cashflow,pv,days,aapl_quantity];
}; */

</script> 
