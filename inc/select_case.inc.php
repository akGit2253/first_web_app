<?php

include_once "function.inc.php";
if (isset($_POST["edit_case"])) {
    if (
        !empty($_POST["title"]) &&
        !empty($_POST["nb1"]) &&
        !empty($_POST["nb2"]) &&
        !empty($_POST["area"]) &&
        !empty($_POST["price"]) &&
        !empty($_POST["regoin"]) &&
        !empty($_POST["category"]) &&
        !empty($_POST["description"]) &&
        !empty($_POST["iframe"])
    ) {
        $item_title = $_POST["title"];
        $nb1 = $_POST["nb1"];
        $nb2 = $_POST["nb2"];
        $item_types = $_POST["type"];
        $area = $_POST["area"];
        $price = $_POST["price"];
        $regoin = $_POST["regoin"];
        $category = $_POST["category"];
        $description = $_POST["description"];
        $iframe = $_POST["iframe"];
        $case_nb = $_POST["edit_case"];


        if (update_item($case_nb, $item_title, $nb1, $nb2, $price, $area, $item_types, $regoin, $category, $description, $iframe)) {

            echo 'Case Edit succesfully!!</br>';
        } else {
            echo 'Error incorrect Edit case !!</br>';
        }
    } else {
        echo '!!input is empty!!';
    }

    if (isset($_FILES["special_image"])) {
        $file = $_FILES["special_image"];
        if ($img_path = special_image_update($case_nb, $file)) {
            echo 'special_image Edit succesfully!!</br>';
        } else {
            echo 'Error incorrect Edit case !!</br>';
        }
    } else {
        echo '!!input is empty!!';
    }
    if (isset($_FILES["images"])) {
        $files = $_FILES["images"];
        if (!images_update($case_nb, $files)) {
            echo 'images Edit succesfully!!</br>';
        } else {
            echo 'Error incorrect Edit case !!</br>';
        }
    } else {
        echo '!!input is empty!!';
    }
} elseif (isset($_POST["upload"])) {
    if (
        !empty($_POST["title"]) &&
        !empty($_POST["nb1"]) &&
        !empty($_POST["nb2"]) &&
        !empty($_POST["type"]) &&
        !empty($_POST["area"]) &&
        !empty($_POST["price"]) &&
        !empty($_POST["regoin"]) &&
        !empty($_POST["category"]) &&
        !empty($_POST["description"]) &&
        !empty($_POST["iframe"]) &&
        isset($_FILES["special_image"]) &&
        isset($_FILES["images"])
    ) {
        $item_title = $_POST["title"];
        $nb1 = $_POST["nb1"];
        $nb2 = $_POST["nb2"];
        $item_types = $_POST["type"];
        $area = $_POST["area"];
        $price = $_POST["price"];
        $regoin = $_POST["regoin"];
        $category = $_POST["category"];
        $description = $_POST["description"];
        $iframe = $_POST["iframe"];
        $file = $_FILES["special_image"];
        $files = $_FILES["images"];
        $case_nb = time();


        if ($img_path = special_image_transfer($case_nb, $file)) {
            if (new_item_insert($case_nb, $item_title, $nb1, $nb2, $price, $area, $item_types, $regoin, $category, $description, $img_path, $iframe)) {

                echo 'new case addet succesfully<' . $case_nb . '></br>';

                if (!images_transfer($case_nb, $files)) {
                    echo "succesfully images import";
                } else {
                    echo '!!the images not addet plaese try to edit this case to confirm whether the operation was successful or not !!';
                }
            } else {
                echo 'Error incorrect create case !!</br>';
            }
        } else {
            echo '!!the special image not addet plaese try to edit this case to confirm whether the operation was successful or not !!';
        }
    } else {
        echo '!!input is empty!!';
    }
} elseif (isset($_POST["delete_img_by_edit_form"])) {
    if (!delete_img($_POST["delete_img_by_edit_form_case_nb"], $_POST["delete_img_by_edit_form_id"])) {
        echo "img deleted from server";
    } else {
        echo "img not deleted from server";
    }
} else {
    if (isset($_GET["edit"]) && !empty($_GET["edit"]) && serial_nb_available($_GET["edit"]) != "case not available") {
        if (serial_nb_available($_GET["edit"])) {
            echo   '
                        <div class="list">
                            <div class="list_item">
                                <div onclick="back_btn(event)" class="form--button-in in__case">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="back_icon" viewBox=" 0 0 512 512">
                                        <path d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM217.4 376.9L117.5 269.8c-3.5-3.8-5.5-8.7-5.5-13.8s2-10.1 5.5-13.8l99.9-107.1c4.2-4.5 10.1-7.1 16.3-7.1c12.3 0 22.3 10 22.3 22.3l0 57.7 96 0c17.7 0 32 14.3 32 32l0 32c0 17.7-14.3 32-32 32l-96 0 0 57.7c0 12.3-10 22.3-22.3 22.3c-6.2 0-12.1-2.6-16.3-7.1z" />
                                    </svg>
                                </div>
                            </div>
                        </div>';

            $response = serial_nb_available($_GET["edit"]);
            for ($i = 0; $i < count($response); $i++) {

                switch ($response[$i]["item_types"]) {
                    case "land":
                        $type = '<select name="type" class="in type">
                                        <option value="land" selected>land</option>
                                        <option value="Apartment">Apartment</option>
                                        <option value="building">building</option>
                                        <option value="Garage">Garage</option>
                                    </select>
                                    ';
                        break;
                    case "Apartment":
                        $type = '<select name="type" class="in type">
                                        <option value="land">land</option>
                                        <option value="Apartment" selected>Apartment</option>
                                        <option value="building">building</option>
                                        <option value="Garage">Garage</option>
                                    </select>
                                    ';
                        break;
                    case "Garage":
                        $type = '<select name="type" class="in type">
                                        <option value="land">land</option>
                                        <option value="Apartment">Apartment</option>
                                        <option value="building">building</option>
                                        <option value="Garage" selected>Garage</option>
                                    </select>
                                    ';
                        break;
                    case "building":
                        $type = '<select name="type" class="in type">
                                        <option value="land">land</option>
                                        <option value="Apartment">Apartment</option>
                                        <option value="building" selected>building</option>
                                        <option value="Garage">Garage</option>
                                    </select>
                                    ';
                        break;
                    default:
                        $type = '<select name="type" class="in type">
                                        <option value="land">land</option>
                                        <option value="Apartment">Apartment</option>
                                        <option value="building">building</option>
                                        <option value="Garage">Garage</option>
                                    </select>
                                    ';
                        break;
                }

                switch ($response[$i]["item_category"]) {
                    case "rent":
                        $category = '<select name="category" class="in category">
                                        <option value="rent" selected>rent</option>
                                        <option value="sale">sale</option>
                                        <option value="as_agreed">as_agreed</option>
                                    </select>
                                    ';
                        break;
                    case "sale":
                        $category = '<select name="category" class="in category">
                                        <option value="rent">rent</option>
                                        <option value="sale" selected>sale</option>
                                        <option value="as_agreed">as_agreed</option>
                                    </select>
                                    ';
                        break;
                    case "as_agreed":
                        $category = '<select name="category" class="in category">
                                        <option value="rent">rent</option>
                                        <option value="sale" >sale</option>
                                        <option value="as_agreed" selected>as_agreed</option>
                                    </select>
                                    ';
                        break;
                    default:
                        $category = '<select name="category" class="in category">
                                        <option value="rent">rent</option>
                                        <option value="sale">sale</option>
                                        <option value="as_agreed">as_agreed</option>
                                    </select>
                                    ';
                        break;
                }

                switch ($response[$i]["regoin"]) {
                    case "harouf":
                        $regoin = '<select name="regoin" class="in regoin">
                                            <option value="nabatiyeh">nabatiyeh</option>
                                            <option value="harouf" selected>harouf</option>
                                            <option value="toul">toul</option>
                                            <option value="kfour">kfour</option>
                                            <option value=" ">other</option>
                                        </select>
                                    ';
                        break;
                    case "toul":
                        $regoin = '<select name="regoin" class="in regoin">
                                            <option value="nabatiyeh">nabatiyeh</option>
                                            <option value="harouf">harouf</option>
                                            <option value="toul" selected>toul</option>
                                            <option value="kfour">kfour</option>
                                            <option value=" ">other</option>
                                        </select>
                                    ';
                        break;
                    case "kfour":
                        $regoin = '<select name="regoin" class="in regoin">
                                            <option value="nabatiyeh">nabatiyeh</option>
                                            <option value="harouf" >harouf</option>
                                            <option value="toul">toul</option>
                                            <option value="kfour"selected>kfour</option>
                                            <option value=" ">other</option>
                                        </select>
                                    ';
                        break;
                    case "nabatiyeh":
                        $regoin = '<select name="regoin" class="in regoin">
                                            <option value="nabatiyeh"selected>nabatiyeh</option>
                                            <option value="harouf" >harouf</option>
                                            <option value="toul">toul</option>
                                            <option value="kfour">kfour</option>
                                            <option value=" ">other</option>
                                        </select>
                                    ';
                        break;
                    case " ":
                        $regoin = '<select name="regoin" class="in regoin">
                                            <option value="nabatiyeh"selected>nabatiyeh</option>
                                            <option value="harouf" >harouf</option>
                                            <option value="toul">toul</option>
                                            <option value="kfour">kfour</option>
                                            <option value=" " selected>other</option>
                                        </select>
                                    ';
                        break;
                    default:
                        $regoin = '<select name="regoin" class="in regoin">
                                            <option value="nabatiyeh">nabatiyeh</option>
                                            <option value="harouf">harouf</option>
                                            <option value="toul">toul</option>
                                            <option value="kfour">kfour</option>
                                            <option value=" ">other</option>
                                        </select>
                                    ';
                        break;
                }

                $edit_form = ' <form method="post" onsubmit="edit_form_submit(event,' . $response[$i]["serial_nb"] . ')" class="form form_edit" enctype="multipart/form-data">
                                    <caption>
                                        <h1>Edit Case</h1>
                                        <span class="error_loader"></span>
                                    </caption>

                                    <input type="text" class="in title" name="title"   placeholder="title" value="' . $response[$i]["item_title"] . '">
                                    <input type="number" class="in room" name="nb1"    placeholder="first number..."  value="' . $response[$i]["nb1"] . '">
                                    <input type="number" class="in room" name="nb2"    placeholder="second number..."  value="' . $response[$i]["nb2"] . '">
                                    <input type="number" class="in area" name="area"   placeholder="area"  value="' . $response[$i]["area"] . '">
                                    <input type="number" class="in price" name="price" placeholder="price"  value="' . $response[$i]["price"] . '">
                               
                                    ' . $type . $category . '
                                   

                                    <textarea name="description" class="in description" placeholder="description...">' . $response[$i]["description"] . '</textarea>

                                    <div class="in_location_box">
                                        <span class="in_title">location:</span>
                                        ' . $regoin . '

                                        <textarea placeholder="iframe..." class="in iframe" name="iframe" rows="4" cols="50">' . $response[$i]["iframe"] . '</textarea>
                            
                                    </div>

                                    <div class="in_image_box">
                                        <span class="in_title">special_image:</span>
                                        <div class="image_single-show">
                                            <img src = "' . $response[$i]["img_basic"] . '" alt = "image_single-show"class="addet_images" onclick="unSelect_img_single(event)"/>
                                        </div>
                                        <input type="file" name="special_image" class="special_image_input hidden" onchange="image_single()" accept="image/*">

                                        <span class="in_title">images:</span>
                                        <div class="image_multi-show"></div>
                                        
                                        <span class="in_title">new images:</span>
                                        <div class="image_multi-new">
                                            <img src="../img/add_images.png" class="add_images" alt="-show" onclick="add_image_edit(event)" />
                                        </div>
                                        <input type="file" name="images[]" class="multi_file_input hidden" multiple onchange="image_multi_edit(event)" accept="image/*">

                                    </div>

                                    <div class="form--button">
                                        <input type="submit" onsubmit="edit_form_submit(event,' . $response[$i]["serial_nb"] . ')" class="form--button-in in-edit" name="edit" value="Edit Case">
                                    </div>

                                </form>';


                echo $edit_form;
            }
        } else {
            echo  serial_nb_available($_GET["edit"]);
        }
    } elseif (isset($_GET["delete"]) && !empty($_GET["delete"]) && serial_nb_available($_GET["delete"]) != "case not available") {
        echo   '
                <div class="list">
                    <div class="list_item">
                        <div onclick="back_btn(event)" class="form--button-in in__case">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="back_icon" viewBox=" 0 0 512 512">
                                <path d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM217.4 376.9L117.5 269.8c-3.5-3.8-5.5-8.7-5.5-13.8s2-10.1 5.5-13.8l99.9-107.1c4.2-4.5 10.1-7.1 16.3-7.1c12.3 0 22.3 10 22.3 22.3l0 57.7 96 0c17.7 0 32 14.3 32 32l0 32c0 17.7-14.3 32-32 32l-96 0 0 57.7c0 12.3-10 22.3-22.3 22.3c-6.2 0-12.1-2.6-16.3-7.1z" />
                            </svg>
                        </div>
                    </div>
                </div>';
        if (delete_Case($_GET["delete"])) {
            echo "<h1>deleted Case<" . $_GET["delete"] . "></h1>";
        } else {
            echo "<h1>deleted Case<" . $_GET["delete"] . "></h1>";
        }
    } elseif (isset($_GET["new"])) {
        $new_form = '<form onsubmit="new_form_submit(event)" class="form form_new" >
            <caption>
                <h1>New Case</h1>
                <span class="error_loader"></span>
            </caption>

            <input type="text" class="in title" name="title"   placeholder="title">
            <input type="number" class="in room" name="nb1"   placeholder="first number..." >
            <input type="number" class="in room" name="nb2"   placeholder="second number..." >
            <input type="number" class="in area" name="area"   placeholder="area" >
            <input type="number" class="in price" name="price" placeholder="price">

            <select name="type" class="in type">
                <option value="land">land</option>
                <option value="Apartment">Apartment</option>
                <option value="building">building</option>
                <option value="Garage">Garage</option>
            </select>
            <select name="category" class="in category">
                <option value="rent">rent</option>
                <option value="sale">sale</option>
                <option value="as_agreed">as_agreed</option>
            </select>

            <textarea name="description" class="in description" placeholder="description..."></textarea>

            <div class="in_location_box">
                <span class="in_title">location:</span>
                <select name="regoin" class="in regoin">
                    <option value="nabatiyeh">nabatiyeh</option>
                    <option value="harouf">harouf</option>
                    <option value="toul">toul</option>
                    <option value="kfour">kfour</option>
                    <option value=" ">other</option>
                </select>

                <textarea placeholder="iframe..." class="in iframe" name="iframe" rows="4" cols="50"></textarea>
            </div>

            <div class="in_image_box">
                <span class="in_title">special_image:</span>
                <div class="image_single-show">
                    <img src="../img/add_images.png" class="add_images" alt="-show" onclick="add_special_image(event)">
                </div>
                <input type="file" name="special_image" class="special_image_input hidden" onchange="image_single(event)" accept="image/*">

                <span class="in_title">images:</span>
                <div class="image_multi-show">
                    <img src="../img/add_images.png" class="add_images" alt="-show" onclick="add_image(event)">
                </div>
                <input type="file" name="images[]" class="multi_file_input hidden" multiple onchange="image_multi(event)" accept="image/*">

            </div>

            <div class="form--button">
                <input type="submit" class="form--button-in in-upload" name="upload" value="upload">
            </div>

        </form>
                            ';
        echo   '
                <div class="list">
                    <div class="list_item">
                        <div onclick="back_btn(event)" class="form--button-in in__case">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="back_icon" viewBox=" 0 0 512 512">
                                <path d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM217.4 376.9L117.5 269.8c-3.5-3.8-5.5-8.7-5.5-13.8s2-10.1 5.5-13.8l99.9-107.1c4.2-4.5 10.1-7.1 16.3-7.1c12.3 0 22.3 10 22.3 22.3l0 57.7 96 0c17.7 0 32 14.3 32 32l0 32c0 17.7-14.3 32-32 32l-96 0 0 57.7c0 12.3-10 22.3-22.3 22.3c-6.2 0-12.1-2.6-16.3-7.1z" />
                            </svg>
                        </div>
                    </div>
                </div>';
        echo $new_form;
    } elseif (isset($_GET["images_of_edit"])) {
        if (get_images($_GET["images_of_edit"])) {
            echo get_images($_GET["images_of_edit"]);
        } else {
            echo  serial_nb_available($_GET["images_of_edit"]);
        }
    } elseif (isset($_GET["search_admin"])) {
        if (search_item_available($_GET["search_admin"])) {
            $search_result = search_item_available($_GET["search_admin"]);
            echo   '
                        <div class="list">
                            <div class="list_item">
                                <div onclick="new_case(event)" class="form--button-in in__case">Add new case</div>
                            </div>';
            for ($i = 0; $i < count($search_result); $i++) {

                echo
                ' <div class="list_item">
            <div onclick="edit_case(event, ' . $search_result[$i]["serial_nb"] . ')" class="list_item_link">
                <img class="list_item_image" src="' . $search_result[$i]["img_basic"] . '" alt="">
                <span class="list_item_title">' . $search_result[$i]["item_title"] . '</span>
                <span class="list_item_regoin">' . $search_result[$i]["regoin"] . '</span>
                <span class="list_item_type">' . $search_result[$i]["item_types"] . '</span>
                <span class="list_item_category">' . $search_result[$i]["item_category"] . '</span>
                <span class="list_item_price">' . $search_result[$i]["price"] . '$</span>
            </div>
             <div onclick="delete_case(event,' . $search_result[$i]["serial_nb"] . ')" class="form--button-in in__case">delete</a>
             </div>';

                echo '</div>';
            }
        } else {
            echo   '
        <div class="list">
            <div class="list_item">
                <div onclick="new_case(event)" class="new_case form--button-in in__case">Add new case</div>
            </div></div>';
        }
    } else {
        if (item_available()) {
            $response = item_available();
            echo   '
                        <div class="list">
                            <div class="list_item">
                                <div onclick="new_case(event)" class="form--button-in in__case">Add new case</div>
                            </div>';
            for ($i = 0; $i < count($response); $i++) {

                echo
                ' <div class="list_item">
            <div onclick="edit_case(event, ' . $response[$i]["serial_nb"] . ')" class="list_item_link">
                <img class="list_item_image" src="' . $response[$i]["img_basic"] . '" alt="">
                <span class="list_item_title">' . $response[$i]["item_title"] . '</span>
                <span class="list_item_regoin">' . $response[$i]["regoin"] . '</span>
                <span class="list_item_type">' . $response[$i]["item_types"] . '</span>
                <span class="list_item_category">' . $response[$i]["item_category"] . '</span>
                <span class="list_item_price">' . $response[$i]["price"] . '$</span>
            </div>
             <div onclick="delete_case(event,' . $response[$i]["serial_nb"] . ')" class="form--button-in in__case">delete</a>
             </div>';

                echo '</div>';
            }
        } else {
            echo   '
        <div class="list">
            <div class="list_item">
                <div onclick="new_case(event)" class="new_case form--button-in in__case">Add new case</div>
            </div></div>';
        }
    }
}

// if (isset($_POST['call'])) {
// } else  else if (isset($_POST["edit"])) {
// } else  if (isset($_POST["delete_index"])) {
// } else {
// }
