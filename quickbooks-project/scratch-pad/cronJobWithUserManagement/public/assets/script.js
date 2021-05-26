const isAuthenticated = () => {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "/api/auth/isAuthenticated", true);
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      let resp = xmlhttp.responseText;
      console.log("isAuthenticated", resp);
    }
  };
  xmlhttp.send();
};

const handleAuthenticate = () => {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "/api/auth/authenticate", true);
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      let authUri = xmlhttp.responseText;
      console.log(authUri);
      isAuthenticated();
      var parameters = "location=1,width=800,height=650";
      parameters +=
        ",left=" +
        (screen.width - 800) / 2 +
        ",top=" +
        (screen.height - 650) / 2;
      var win = window.open(authUri, "connectPopup", parameters);
      var pollOAuth = window.setInterval(function () {
        try {
          if (win.document.URL.indexOf("code") != -1) {
            window.clearInterval(pollOAuth);
            win.close();
            location.reload();
          }
        } catch (e) {
          console.log(e);
        }
      }, 100);
    }
  };
  xmlhttp.send();
};

const handleLogout = () => {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "/api/auth/logout", true);
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      let resp = xmlhttp.responseText;
      console.log("Session Cleared");
    }
  };
  xmlhttp.send();
};
