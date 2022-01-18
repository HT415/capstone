//hide the game instruction 
$("p").hide();
$("#hide").hide();
//show the game instruction
$("#instruction").click(function () {
  $("p").show();
  $("#instruction").hide();
  $("#hide").show();
});
//hide the game instruction again
$("#hide").click(function () {
  $("#instruction").show();
  $("p").hide();
  $("#hide").hide();
});
//only show the line chart of AAPL
$(".candlestickchart").hide();
$("#fb").hide();
$("#intc").hide();
//show the candlestick chart and hide the line chart 
$("#candlestick").click(function () {
  $(".linechart").hide();
  $(".candlestickchart").show();
});
//show the line chart and hide the candlestick chart again
$("#line").click(function () {
  $(".linechart").show();
  $(".candlestickchart").hide();
});
//show the chart of AAPL and hide the charts of other stocks
$(document).on("click", "#viewchartAAPL", function () {
  $("#aapl").show();
  $("#fb").hide();
  $("#intc").hide();
});
//show the chart of FB and hide the charts of other stocks
$(document).on("click", "#viewchartFB", function () {
  $("#fb").show();
  $("#aapl").hide();
  $("#intc").hide();
});
//show the chart of INTC and hide the charts of other stocks
$(document).on("click", "#viewchartINTC", function () {
  $("#intc").show();
  $("#aapl").hide();
  $("#fb").hide();
});
//pop up the historical data of AAPL
$(document).on("click", "#viewhistoricaldataAAPL", function () {
  window.open("aaplPortfolio.php", "AAPL Historical Data", "width=500, height=500");
});
//pop up the historical data of FB
$(document).on("click", "#viewhistoricaldataFB", function () {
  window.open("fbPortfolio.php", "FB Historical Data", "width=500, height=500");
});
//pop up the historical data of INTC
$(document).on("click", "#viewhistoricaldataINTC", function () {
  window.open("intcPortfolio.php", "INTC Historical Data", "width=500, height=500");
});