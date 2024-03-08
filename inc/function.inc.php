<?php

function connection()
{
    // $servername = "sql112.infinityfree.com";
    // $hostname = "if0_36119885";
    // $hostpwd = "bcSyAWcJQo4a";
    // $database = "if0_36119885_hashem_real_estats";
    $servername = "localhost";
    $hostname = "root";
    $hostpwd = "";
    $database = "epiz_33858518_hashem_real_estats";
    $conn = mysqli_connect($servername, $hostname, $hostpwd, $database);

    if (!$conn) {
        return "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        return $conn;
    }
}

function serial_nb_available($s)
{
    $i = 0;
    $sql = "SELECT * FROM `items` WHERE `serial_nb`='$s'";
    if ($r = connection()->query($sql)) {
        if ($r->num_rows > 0) {
            while ($row = $r->fetch_assoc()) {
                $x[$i] = $row;
                $i++;
            }
            return $x;
        }
    } else {
        return "case not available";
    }
}
function item_available()
{
    $i = 0;
    $sql = "SELECT * FROM `items`  ORDER BY `event` DESC";
    if ($r = connection()->query($sql)) {
        if ($r->num_rows > 0) {
            while ($row = $r->fetch_assoc()) {
                $x[$i] = $row;
                $i++;
            }
            return $x;
        }
    }
}
function search_item_available($txt)
{
    $i = 0;
    $sql = "SELECT * FROM items WHERE item_title LIKE '%{$txt}%' or item_category LIKE '%{$txt}%' or  item_types LIKE '%{$txt}%' or  price LIKE '%{$txt}%' or  regoin LIKE '%{$txt}%'  or  area LIKE '%{$txt}%';";
    if ($r = connection()->query($sql)) {
        if ($r->num_rows > 0) {
            while ($row = $r->fetch_assoc()) {
                $x[$i] = $row;
                $i++;
            }
            return $x;
        }
    }
}


function new_item_insert($s, $item_title, $nb1, $nb2, $price, $area, $item_types, $regoin, $category, $description, $img_path, $iframe)
{
    $sql = "INSERT INTO `items`(`serial_nb`, `item_title`, `item_category`, `regoin`, `price`, `item_types`, `img_basic`, `area`, `nb1`, `nb2`, `description`, `iframe`) VALUES ('$s','$item_title','$category','$regoin','$price','$item_types','$img_path','$area','$nb1','$nb2','$description','$iframe')";
    if (connection()->query($sql)) {
        return true;
    } else {
        return false;
    }
}

// function get_table_images($s)
// {
//     $result = '';
//     $sql = "SELECT * FROM `images` WHERE `item_serial_nb`='$s';";
//     $r = connection()->query($sql);
//     if ($r->num_rows > 0) {
//         while ($row = $r->fetch_assoc()) {
//             $result .= '<img src="' . $row["image_server_url"] . '" class="table_img"/>';
//         }
//         return $result;
//     } else {
//         return 'no images available';
//     }
// }

function get_images($s)
{
    $result = '';
    $sql = "SELECT * FROM `images` WHERE `item_serial_nb`='$s';";
    $r = connection()->query($sql);
    if ($r->num_rows > 0) {
        while ($row = $r->fetch_assoc()) {
            $result .= '  <img src = "' . $row["image_server_url"] . '" alt = "image_multi-show" class="addet_images" onclick="delete_img_by_edit_form(event, ' . $s . ',' . $row["image_id"] . ')"/>';
        }
        return $result;
    } else {
        return '<img src="../img/add_images.png" class="add_images" alt="-show" onclick="add_image(event)" />';
    }
}
function special_image_transfer($s, $file)
{
    if (isset($file)) {
        $images_name = $file["name"];
        $images_tmp_name = $file["tmp_name"];
        $images_size = $file["size"];
        $Directory = "../img/";
        $upload_target_folder = "../img/" . $s . "/" .  $s . "." . pathinfo($images_name, PATHINFO_EXTENSION);
        $upload_target_folder_mkdir = $Directory . $s . "/" .  $s . "." . pathinfo($images_name, PATHINFO_EXTENSION);

        if (!is_dir($Directory)) {
            mkdir($Directory);

            if (is_dir($Directory . $s . "/")) {
                if (move_uploaded_file($images_tmp_name, $upload_target_folder_mkdir)) {
                    resize($upload_target_folder, $upload_target_folder,  500);
                    add_logo($upload_target_folder, $upload_target_folder);
                    return $upload_target_folder;
                } else {
                    return false;
                }
            } else {
                mkdir($Directory . $s . "/");
                if (is_dir($Directory . $s . "/")) {
                    if (move_uploaded_file($images_tmp_name, $upload_target_folder_mkdir)) {
                        resize($upload_target_folder, $upload_target_folder,  500);
                        add_logo($upload_target_folder, $upload_target_folder);
                        return $upload_target_folder;
                    } else {
                        return false;
                    }
                } else {

                    return false;
                }
            }
        } else {
            if (is_dir($Directory . $s . "/")) {
                if (move_uploaded_file($images_tmp_name, $upload_target_folder_mkdir)) {
                    resize($upload_target_folder, $upload_target_folder,  500);
                    add_logo($upload_target_folder, $upload_target_folder);
                    return $upload_target_folder;
                } else {
                    return false;
                }
            } else {
                mkdir($Directory . $s . "/");
                if (is_dir($Directory . $s . "/")) {
                    if (move_uploaded_file($images_tmp_name, $upload_target_folder_mkdir)) {
                        resize($upload_target_folder, $upload_target_folder,  500);
                        add_logo($upload_target_folder, $upload_target_folder);
                        return $upload_target_folder;
                    } else {
                        return false;
                    }
                } else {

                    return false;
                }
            }
        }
    } else {
        return false;
    }
}

function images_transfer($s, $files)
{
    $s_id = 0;
    $sql = "SELECT * FROM `images` WHERE `item_serial_nb`='$s';";
    $r = connection()->query($sql);
    if ($r->num_rows > 0) {
        while ($row = $r->fetch_assoc()) {
            while ($row["image_id"] > $s_id) {
                $s_id++;
            }
            $s_id++;
        }
        if (isset($files)) {
            for ($i =  0; $i < count($files["name"]); $i++) {
                $images_name = $files["name"][$i];
                $images_tmp_name = $files["tmp_name"][$i];
                $images_size = $files["size"][$i];
                $upload_target_folder = "../img/" . $s . "/" .  $s . "_$s_id." . pathinfo($images_name, PATHINFO_EXTENSION);
                if (file_exists("../img/" . $s . "/")) {
                    if (move_uploaded_file($images_tmp_name, $upload_target_folder)) {
                        if (db_insert_images($s, $s_id, $upload_target_folder)) {
                            $s_id = $s_id + 1;
                            resize($upload_target_folder, $upload_target_folder,  500);
                            add_logo($upload_target_folder, $upload_target_folder);
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    } else {
        if (isset($files)) {
            for ($i =  0; $i < count($files["name"]); $i++) {
                $images_name = $files["name"][$i];
                $images_tmp_name = $files["tmp_name"][$i];
                $images_size = $files["size"][$i];
                $upload_target_folder = "../img/" . $s . "/" .  $s . "_$i." . pathinfo($images_name, PATHINFO_EXTENSION);
                if (file_exists("../img/" . $s . "/")) {
                    if (move_uploaded_file($images_tmp_name, $upload_target_folder)) {
                        if (db_insert_images($s, $i, $upload_target_folder)) {
                            resize($upload_target_folder, $upload_target_folder,  500);
                            add_logo($upload_target_folder, $upload_target_folder);
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    if (mkdir("../img/" . $s . "/")) {
                        if (move_uploaded_file($images_tmp_name, $upload_target_folder)) {
                            if (db_insert_images($s, $i, $upload_target_folder)) {
                                resize($upload_target_folder, $upload_target_folder,  500);
                                add_logo($upload_target_folder, $upload_target_folder);
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                }
            }
        } else {
            return false;
        }
    }
}

function db_insert_images($s, $i, $upload_target_folder)
{
    $sql1 = "SELECT * FROM `images` WHERE `item_serial_nb`='$s' AND`image_id`='$i'";
    $sql = "INSERT INTO `images`(`item_serial_nb`, `image_id`, `image_server_url`) VALUES ('$s','$i','$upload_target_folder')";

    if (connection()->query($sql1)) {
        if (connection()->query($sql)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function update_item($s, $item_title, $nb1, $nb2, $price, $area, $item_types, $regoin, $category, $description, $iframe)
{
    $sql = "UPDATE `items` SET `item_title`= '$item_title' ,`item_category`='$category',`regoin`='$regoin',`price`='$price',`item_types`= '$item_types',`area`='$area',`nb1`= '$nb1',`nb2`= '$nb2',`description`= '$description', `iframe`='$iframe' WHERE  `serial_nb`='$s';";
    if (connection()->query($sql)) {
        return serial_nb_available($s);
    } else {
        return false;
    }
}
function special_image_update($s, $file)
{
    if ($img_path = special_image_transfer($s, $file)) {
        $sql = "UPDATE `items` SET `img_basic`='$img_path' WHERE  `serial_nb`='$s';";
        if (connection()->query($sql)) {
            return $img_path;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function images_update($s, $files)
{
    if (images_transfer($s, $files)) {
        return true;
    } else {
        return false;
    }
}
function delete_img($s, $id)
{
    if ($id != '*') {

        $sql = "SELECT * FROM `images` WHERE `item_serial_nb`='$s' AND`image_id`='$id'";
        $sql1 = "DELETE FROM `images` WHERE `item_serial_nb`='$s' AND`image_id`='$id'";
        if ($r = connection()->query($sql)) {
            if ($r->num_rows > 0) {
                if ($row = $r->fetch_assoc()) {
                    if (connection()->query($sql1)) {
                        if (file_exists("../img/" . $s . "/" . basename($row["image_server_url"]))) {
                            unlink("../img/" . $s . "/" . basename($row["image_server_url"]));
                        } else {
                            return false;
                        }
                    } else {
                        if (file_exists("../img/" . $s . "/" . basename($row["image_server_url"]))) {
                            unlink("../img/" . $s . "/" . basename($row["image_server_url"]));
                            echo '</br>file is not exist';
                        } else {
                            return false;
                        }
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        $sql = "DELETE FROM `images` WHERE `item_serial_nb`='$s'";
        if ($r = connection()->query($sql)) {
            if (is_dir("../img/" . $s)) {
                $dir = "../img/" . $s;
                if (file_exists($dir)) {
                    $di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
                    $ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
                    foreach ($ri as $file) {
                        $file->isDir() ?  rmdir($file) : unlink($file);
                    }
                    rmdir($dir);
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

function delete_Case($s)
{
    $sql =  "DELETE FROM `items` WHERE `serial_nb`='$s'";
    if (connection()->query($sql)) {
        if (delete_img($s, '*')) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function resize($original, $destination, $max = 1000)
{
    $EXTENSION = pathinfo($original, PATHINFO_EXTENSION);
    switch ($EXTENSION) {
        case 'jpeg' or 'jpg':
            $source = imagecreatefromjpeg($original);
            # code...
            break;
        case 'png' or 'PNG':
            $source = imagecreatefrompng($original);
            # code...
            break;
        case 'gif':
            $source = imagecreatefromgif($original);
            # code...
            break;
        case 'webp':
            $source = imagecreatefromwebp($original);
            # code...
            break;

        default:
            echo $EXTENSION;
            break;
    }
    //resize image
    $width = imagesx($source);
    $height = imagesy($source);

    if ($width >= $height) {

        $new_width = $max;
        $ratio = $height / $width;
        $new_height = $max * $ratio;
    } else {
        $new_height = $max;
        $ratio = $width / $height;
        $new_width = $max * $ratio;
    }

    $image = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($image, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    imagejpeg($image, $destination);
    imagedestroy($image);
    imagedestroy($source);
}

function add_logo($source_file, $output)
{
    $EXTENSION = pathinfo($source_file, PATHINFO_EXTENSION);
    switch ($EXTENSION) {
        case 'jpeg' or 'jpg':
            $source = imagecreatefromjpeg($source_file);
            # code...
            break;
        case 'png' or 'PNG':
            $source = imagecreatefrompng($source_file);
            # code...
            break;
        case 'gif':
            $source = imagecreatefromgif($source_file);
            # code...
            break;
        case 'webp':
            $source = imagecreatefromwebp($source_file);
            # code...
            break;

        default:
            echo $EXTENSION;
            break;
    }
    $source_width = imagesx($source);
    $source_height = imagesy($source);

    $watermark = "../img/watermark_Logo.png";
    $logo = imagecreatefrompng($watermark);
    $logo_width = imagesx($logo);
    $logo_height = imagesy($logo);

    $centerX = ($source_width - $logo_width) / 2;
    $centerY = ($source_height - $logo_height) / 2;

    imagecopymerge($source, $logo, $centerX, $centerY, 0, 0, $logo_width, $logo_height, 25);
    //imagecopyresampled(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)

    imagejpeg($source, $output);
    imagedestroy($source);
}
