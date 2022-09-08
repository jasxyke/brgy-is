var check = function() {
    if (!document.getElementById('confirm-pass').value == "")
    if (document.getElementById('pwd').value ==
      document.getElementById('confirm-pass').value) {
      document.getElementById('message').style.color = 'green';
      document.getElementById('message').innerHTML = 'passwords match';
    } else {
      document.getElementById('message').style.color = 'red';
      document.getElementById('message').innerHTML = 'passwords do not match';
    }
  }