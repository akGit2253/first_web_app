timerA = setInterval(function () {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector(".user_box").innerHTML = this.responseText;
    } else {
      document.querySelector(".user_box").innerHTML =
        ' <div class="loader_box"> <span class="loader"></span></div>';
    }
  };
  xhttp.open("GET", "../includes/?", true);
  xhttp.send();

  //   xhttp.abort();
  clearInterval(timerA);
}, 200);

function serach_item(e) {
  e.preventDefault();
  const search_input = document.querySelector(".search_input");
  let search_m = search_input.value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector(".user_box").innerHTML = this.responseText;
    } else {
      document.querySelector(".user_box").innerHTML =
        ' <div class="loader_box"> <span class="loader"></span></div>';
    }
  };
  xhttp.open("GET", "../includes/?search=" + search_m, true);
  xhttp.send();
  //   xhttp.abort();
}

function mobile_serach_item(e) {
  e.preventDefault();
  const search_input = document.querySelector(".mobile_search_input");
  let search_m = search_input.value;
  console.log(search_m);

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector(".user_box").innerHTML = this.responseText;
    } else {
      document.querySelector(".user_box").innerHTML =
        ' <div class="loader_box"> <span class="loader"></span></div>';
    }
  };
  xhttp.open("GET", "../includes/?search=" + search_m, true);
  xhttp.send();
  //   xhttp.abort();
}

function get_by_type(e, type) {
  e.preventDefault();
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector(".posters").innerHTML = this.responseText;
    } else {
      document.querySelector(".posters").innerHTML =
        ' <div class="loader_box"> <span class="loader"></span></div>';
    }
  };
  xhttp.open("GET", "../includes/?get_type=" + type, true);
  xhttp.send();
}
