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
        return false;
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
function user_search_item_available($txt)
{
    $i = 0;

    $sql = "SELECT * FROM items WHERE `item_title` LIKE '%{$txt}%'
     or `item_category` LIKE '%{$txt}%' 
     or  `item_types` LIKE '%{$txt}%' 
      or  `description` LIKE '%{$txt}%'
     or  `price` LIKE '%{$txt}%'
      or  `regoin` LIKE '%{$txt}%'  
      or  `area` LIKE '%{$txt}%'
      ;";

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

function user_get_images($s)
{
    $i = 0;
    $sql = "SELECT * FROM `images` WHERE `item_serial_nb`='$s';";
    $r = connection()->query($sql);
    if ($r->num_rows > 0) {
        while ($row = $r->fetch_assoc()) {
            $x[$i] = $row;
            $i++;
        }
        return $x;
    } else {
        return false;
    }
}

function get_by_type($t)
{
    if ($t == "All") {
        $i = 0;
        $sql = "SELECT * FROM `items`  ORDER BY `event` DESC";
        $r = connection()->query($sql);
        if ($r->num_rows > 0) {
            while ($row = $r->fetch_assoc()) {
                $x[$i] = $row;
                $i++;
            }
            return $x;
        } else {
            return false;
        }
    } else {
        $i = 0;
        $sql = "SELECT * FROM `items` WHERE `item_types`='$t';";
        $r = connection()->query($sql);
        if ($r->num_rows > 0) {
            while ($row = $r->fetch_assoc()) {
                $x[$i] = $row;
                $i++;
            }
            return $x;
        } else {
            return false;
        }
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
function types_count()
{
    if ($x = item_available()) {
        $list = array();
        $list["All"]["count"] = count($x);
        $list["All"]["image"] = "../img/watermark_Logo.png";
        for ($i = 0; $i < count($x); $i++) {

            if (array_key_exists($x[$i]["item_types"], $list)) {
                $list[$x[$i]["item_types"]]["count"]++;
            } else {
                $list[$x[$i]["item_types"]]["count"]  = 1;
                $list[$x[$i]["item_types"]]["image"] = $x[$i]["img_basic"];
            }
        }
        return $list;
    } else {
        return false;
    }
}
