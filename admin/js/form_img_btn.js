let single_File = new DataTransfer();

let multi_Files = new DataTransfer();

// single_File_new

function add_special_image(e) {
  e.preventDefault();

  var single_File_input = document.querySelector(".special_image_input");

  single_File_input.click();
}

function image_single(e) {
  var single_File_input = document.querySelector(".special_image_input");

  let single_old_file = single_File_input.files;

  console.log(single_old_file);

  single_File.items.add(single_File_input.files[0]);

  console.log(single_File);

  let result = single_File.files;

  display_input(result, 1);
}

function unSelect_img_single() {
  var single_File_input = document.querySelector(".special_image_input");

  document.querySelector(".image_single-show").innerHTML =
    '<img src="../img/add_images.png" class="add_images" alt="-show" onclick="add_special_image(event)" />';

  single_File = new DataTransfer();

  single_File_input.files = single_File.files;

  console.log({ single_File_input });
}

// multi_Files_new

function add_image(e) {
  e.preventDefault();

  var multi_files_input = document.querySelector(".multi_file_input");

  let multi_files_input_files = multi_files_input.files;

  console.log(multi_files_input_files);

  multi_files_input.click();
}

function image_multi(e) {
  e.preventDefault();

  var multi_files_input = document.querySelector(".multi_file_input");

  let multi_files_input_files = multi_files_input.files;

  console.log(multi_files_input_files);

  for (let index = 0; index < multi_files_input_files.length; index++) {
    multi_Files.items.add(multi_files_input_files[index]);
  }

  console.log(multi_Files);

  let result = multi_Files.files;

  multi_files_input.files = result;

  console.log(multi_files_input.files);

  display_input(result, 0);
}

function unSelect_img_multi(e, id) {
  e.preventDefault();

  var multi_files_input = document.querySelector(".multi_file_input");

  let multi_files_input_files = multi_files_input.files;

  multi_Files.items.remove(id);

  result = multi_Files.files;

  multi_files_input.files = result;

  final = multi_files_input_files;

  // console.log({ final });

  display_input(final, 0);
}

// display image before upload

const display_input = (display, s_or_m) => {
  let single_File_output = document.querySelector(".image_single-show");

  let multi_files_output = document.querySelector(".image_multi-show");

  if (s_or_m == 1) {
    console.log(display[0]);

    single_File_output.innerHTML =
      '<img src = "' +
      URL.createObjectURL(display[0]) +
      ' " alt = "image_single-show" class="addet_images" onclick="unSelect_img_single()"/>';
  } else {
    multi_files_output.innerHTML = "";

    multi_files_output.innerHTML +=
      '<img src="../img/add_images.png"  class="add_images" alt="-show" onclick="add_image(event)" />';

    for (let index = 0; index < display.length; index++) {
      multi_files_output.innerHTML +=
        '<img src = " ' +
        URL.createObjectURL(display[index]) +
        ' " alt = "image_multi-show"class="addet_images" onclick="unSelect_img_multi(event,' +
        index +
        ')"/>';
    }
  }
};

function delete_img_by_edit_form(e, case_nb, id) {
  e.preventDefault();

  let errorText = document.querySelector(".error_loader");

  errorText.innerHTML = '<span class="loader"></span>';

  //Ajax

  let xhr = new XMLHttpRequest();

  xhr.open("POST", "../inc/?", true);

  xhr.onprogress = () => {
    errorText.innerHTML = '<span class="loader"></span>';
  };

  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;

        console.log(data);

        errorText.innerHTML = data;

        edit_form_multi_img(e, case_nb);
      }
    }
  };

  let formData = new FormData();

  // append button name to post the button

  formData.append("delete_img_by_edit_form", "delete_img_by_edit_form");

  formData.append("delete_img_by_edit_form_case_nb", case_nb);

  formData.append("delete_img_by_edit_form_id", id);

  xhr.send(formData);
}

function edit_form_multi_img(e, case_nb) {
  e.preventDefault();

  let multi_files_output = document.querySelector(".image_multi-show");

  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      multi_files_output.innerHTML = this.responseText;
    } else {
      multi_files_output.innerHTML =
        ' <div class="loader_box"> <span class="loader"></span></div>';
    }
  };

  xhttp.open("GET", "../inc/?images_of_edit=" + case_nb, true);

  xhttp.send();

  //   xhttp.abort();
}

let single_File_edit = new DataTransfer();

let multi_Files_edit = new DataTransfer();

// single_File_edit

function special_image_edit(e) {
  var single_File_input = document.querySelector(".special_image_input");

  document.querySelector(".image_single-show").innerHTML =
    '<img src="../img/add_images.png" class="add_images" alt="-show" onclick="add_special_image(event)" />';

  single_File_edit = new DataTransfer();

  single_File_input.files = single_File_edit.files;

  console.log({ single_File_input });
}

function add_image_edit(e) {
  e.preventDefault();

  var multi_files_input = document.querySelector(".multi_file_input");

  let multi_files_input_files = multi_files_input.files;

  console.log(multi_files_input_files);

  multi_files_input.click();
}

function image_multi_edit(e) {
  e.preventDefault();

  var multi_files_input = document.querySelector(".multi_file_input");

  let multi_files_input_files = multi_files_input.files;

  console.log(multi_files_input_files);

  for (let index = 0; index < multi_files_input_files.length; index++) {
    multi_Files_edit.items.add(multi_files_input_files[index]);
  }

  console.log(multi_Files_edit);

  let result = multi_Files_edit.files;

  multi_files_input.files = result;

  console.log(multi_files_input.files);

  display_input_edit(result, 0);
}

function unSelect_img_multi_edit(e, id) {
  e.preventDefault();

  var multi_files_input = document.querySelector(".multi_file_input");

  let multi_files_input_files = multi_files_input.files;

  multi_Files_edit.items.remove(id);

  result = multi_Files_edit.files;

  multi_files_input.files = result;

  final = multi_files_input_files;

  // console.log({ final });

  display_input_edit(final, 0);
}

// display image before addet

const display_input_edit = (display, s_or_m) => {
  let single_File_output = document.querySelector(".image_single-show");

  let multi_files_output = document.querySelector(".image_multi-new");

  if (s_or_m == 1) {
    console.log(display[0]);

    single_File_output.innerHTML =
      '<img src = "' +
      URL.createObjectURL(display[0]) +
      ' " alt = "image_single-show" class="addet_images" onclick="unSelect_img_single()"/>';
  } else {
    multi_files_output.innerHTML = "";

    multi_files_output.innerHTML +=
      '<img src="../img/add_images.png"  class="add_images" alt="-show" onclick="add_image_edit(event)" />';

    for (let index = 0; index < display.length; index++) {
      multi_files_output.innerHTML +=
        '<img src = " ' +
        URL.createObjectURL(display[index]) +
        ' " alt = "image_multi-show"class="addet_images" onclick="unSelect_img_multi_edit(event,' +
        index +
        ')"/>';
    }
  }
};
