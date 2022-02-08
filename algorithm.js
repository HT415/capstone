function getMA(close1, close2, period) {
  var MA = [];
  for (let i = 0; i < close2.length; i++) {
    var sum = 0;
    if (i < period) {
      var counter = period - i;
      for (let j = close1.length - 1; j > close1.length - counter; j--) {
        sum += parseFloat(close1[j]);
      }
      for (k = 0; k <= i; k++) {
        sum += parseFloat(close2[k]);
      }
    } else {
      for (k = i; k > i - period; k--) {
        sum += parseFloat(close2[k]);
      }
    }

    MA.push(sum / period);
  }
  return MA;
}

