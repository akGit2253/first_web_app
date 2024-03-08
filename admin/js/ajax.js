timerA = setInterval(function () {
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector(".admin_box").innerHTML = this.responseText;
    } else {
      document.querySelector(".admin_box").innerHTML =
        ' <div class="loader_box"> <span class="loader"></span></div>';
    }
  };

  xhttp.open("GET", "../inc/?", true);

  xhttp.send();

  //   xhttp.abort();

  clearInterval(timerA);
}, 100);

function new_case(e) {
  e.preventDefault();

  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector(".admin_box").innerHTML = this.responseText;
    } else {
      document.querySelector(".admin_box").innerHTML =
        ' <div class="loader_box"> <span class="loader"></span></div>';
    }
    single_File = new DataTransfer();
    multi_Files = new DataTransfer();
  };

  xhttp.open("GET", "../inc/?new", true);

  xhttp.send();

  //   xhttp.abort();
}

function edit_case(e, case_nb) {
  e.preventDefault();

  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector(".admin_box").innerHTML = this.responseText;

      edit_form_multi_img(e, case_nb);
    } else {
      document.querySelector(".admin_box").innerHTML =
        ' <div class="loader_box"> <span class="loader"></span></div>';
    }
  };

  xhttp.open("GET", "../inc/?edit=" + case_nb, true);

  xhttp.send();

  //   xhttp.abort();
}

function delete_case(e, case_nb) {
  e.preventDefault();

  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector(".admin_box").innerHTML = this.responseText;
    } else {
      document.querySelector(".admin_box").innerHTML =
        ' <div class="loader_box"> <span class="loader"></span></div>';
    }
  };

  xhttp.open("GET", "../inc/?delete=" + case_nb, true);

  xhttp.send();

  //   xhttp.abort();
}

function back_btn(e) {
  e.preventDefault();

  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector(".admin_box").innerHTML = this.responseText;
    } else {
      document.querySelector(".admin_box").innerHTML =
        ' <div class="loader_box"> <span class="loader"></span></div>';
    }
  };

  xhttp.open("GET", "../inc/?", true);

  xhttp.send();

  //   xhttp.abort();
}

function new_form_submit(e) {
  e.preventDefault();
  let forms = document.querySelector(".form_new");

  document.querySelector(".article").scrollTop = 0;
  let errorText = document.querySelector(".error_loader");

  errorText.innerHTML = ' <span class="loader"></span>';
  //Ajax

  let xhr = new XMLHttpRequest();

  xhr.open("POST", "../inc/?", true);

  xhr.upload.onprogress = (event) => {
    errorText.innerHTML =
      "<span>Uploading..." +
      parseInt((event.loaded / event.total) * 100) +
      "%</span>" +
      '<progress class="progress_bar" value = "' +
      event.loaded +
      '" max="' +
      event.total +
      '"></progress>';
  };
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;

        console.log(data);
        errorText.innerHTML = data;
        new_case(e);
        //   edit_case(e, data);
      } else {
        errorText.innerHTML = '<span class="">server no response</span>';
      }
    }
  };

  console.log(forms);

  let formData = new FormData(forms);

  // append button name to post the button

  formData.append("upload", "upload");

  xhr.send(formData);
}

function edit_form_submit(e, case_nb) {
  e.preventDefault();

  let forms = document.querySelector(".form_edit");

  document.querySelector(".article").scrollTop = 0;
  let errorText = document.querySelector(".error_loader");

  errorText.innerHTML = ' <span class="loader"></span>';
  //Ajax

  let xhr = new XMLHttpRequest();

  xhr.open("POST", "../inc/?", true);

  xhr.upload.onprogress = (event) => {
    errorText.innerHTML =
      "<span>Uploading..." +
      parseInt((event.loaded / event.total) * 100) +
      "%</span>" +
      '<progress class="progress_bar" value = "' +
      event.loaded +
      '" max="' +
      event.total +
      '"></progress>';
  };
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;

        console.log(data);

        errorText.innerHTML = data;

        edit_form_multi_img(e, case_nb);
        edit_case(e, case_nb);
      }
    }
  };

  console.log(forms);

  let formData = new FormData(forms);

  // append button name to post the button

  formData.append("edit_case", case_nb);

  xhr.send(formData);
}

// function edit_form_multi_img(e, case_nb) {

//   e.preventDefault();

//   let multi_files_output = document.querySelector(".image_multi-show");

//   var xhttp = new XMLHttpRequest();

//   xhttp.onreadystatechange = function () {

//     if (this.readyState == 4 && this.status == 200) {

//       multi_files_output.innerHTML = this.responseText;

//     } else {

//       multi_files_output.innerHTML =

//         ' <div class="loader_box"> <span class="loader"></span></div>';

//     }

//   };

//   xhttp.open("GET", "../inc/?images_of_edit=" + case_nb, true);

//   xhttp.send();

//   //   xhttp.abort();

// }

function serach_item(e) {
  e.preventDefault();

  const search_input = document.querySelector(".search_input_admin");

  let search_m = search_input.value;

  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector(".admin_box").innerHTML = this.responseText;
    } else {
      document.querySelector(".admin_box").innerHTML =
        ' <div class="loader_box"> <span class="loader"></span></div>';
    }
  };

  xhttp.open("GET", "../inc/?search_admin=" + search_m, true);

  xhttp.send();

  //   xhttp.abort();
}

function mobile_serach_item(e) {
  e.preventDefault();

  const search_input = document.querySelector(".mobile_serach_input_admin");

  let search_m = search_input.value;

  console.log(search_m);

  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector(".admin_box").innerHTML = this.responseText;
    } else {
      document.querySelector(".admin_box").innerHTML =
        ' <div class="loader_box"> <span class="loader"></span></div>';
    }
  };

  xhttp.open("GET", "../inc/?search_admin=" + search_m, true);

  xhttp.send();

  //   xhttp.abort();
}
