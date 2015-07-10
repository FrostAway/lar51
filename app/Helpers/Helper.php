<?php

function toSlug($str) {

    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    $str = str_replace(" ", "-", str_replace("&*#39;", "", $str));
    $str = strtolower($str);
    return $str;
}

function checktrue($val1, $val2) {
    if ($val1 == $val2) {
        return true;
    }
}

function checkecho($val1, $val2, $echo = true) {
    if (is_array($val2)) {
        if (in_array($val1, $val2)) {
            if ($echo != true) {
                return 'checked';
            } else {
                echo 'checked';
            }
        }
    } else {
        if ($val1 == $val2) {
            echo 'checked';
        }
    }
}

function selected($val1, $val2) {
    if ($val1 == $val2) {
        echo 'selected';
    }
}

function list_tree($lists, $parent) {
    $output = '';
    foreach ($lists as $key => $item) {
        if ($item->parent == $parent) {
            $output.= '</li>';
            $output.='<a href="">' . $item->name . '</a>';
            unset($lists[$key]);

            $output2 = list_tree($lists, $item->id);
            if ($output2 != '') {
                $output .= '<ul>' . $output2 . '</ul>';
            }
            $output.= '</li>';
        }
    }
    return $output;
}

function get_path($url){
    return preg_replace('/\/lar51/', '', parse_url($url)['path']);
}

function get_setting($key) {
    $values = \App\Setting::where('key', $key)->get(['value'])->first();
    if (empty($values)) {
        return '';
    } else {
        return $values->value;
    }
}

function get_menus($menu_id){
    $menus = \App\Menu::where('group_id', $menu_id)->orderBy('order')->get(['id', 'name', 'parent', 'type', 'link', 'icon']);
    return \App\Menu::list_menus($menus, 0, 0);
}

function load_image($image) {
    $ext = strtolower(strchr($image, '.'));
    switch ($ext) {
        case '.jpg':
        case '.jpeg':
            $img = @imagecreatefromjpeg($image);
            break;
        case '.gif':
            $img = @imagecreatefromgif($image);
            break;
        case '.png':
            $img = @imagecreatefrompng($image);
            break;
        default:
            break;
    }
    return $img;
}

function save_image($image, $path, $type) {
    switch ($type) {
        case 'jpg':
        case 'jpeg':
            imagejpeg($image, $path);
            break;
        case 'gif':
            imagegif($image, $path);
            break;
        case 'png':
            imagepng($image, $path);
            break;
        default:
            break;
    }
}

function resize_image($image, $crop, $width, $height, $path_save, $type) {

    $img = load_image($image);

    $w = imagesx($img);
    $h = imagesy($img);

    if ($w > $width || $h > $height) {
        $ratio = $width / $w;
        $new_w = $width;
        $new_h = $h * $ratio;

        if ($new_h < $height) {
            $ratio = $height / $h;
            $new_h = $height;
            $new_w = $w * $ratio;
        }

        $newimg1 = imagecreatetruecolor($new_w, $new_h);
        imagealphablending($newimg1, false);
        imagesavealpha($newimg1, true);
        imagecopyresampled($newimg1, $img, 0, 0, 0, 0, $new_w, $new_h, $w, $h);

        if ($crop == true) {
            if ($new_h != $height || $new_w != $width) {
                $newimg2 = imagecreatetruecolor($width, $height);
                imagealphablending($newimg2, false);
                imagesavealpha($newimg2, true);
                if ($new_h > $height) {
                    $extra = $new_h - $height;
                    $x = 0;
                    $y = round($extra / 2);
                } else {
                    $extra = $new_w - $width;
                    $x = round($extra / 2);
                    $y = 0;
                }
                imagecopyresampled($newimg2, $newimg1, 0, 0, $x, $y, $width, $height, $width, $height);
                save_image($newimg2, $path_save, $type);
            } else {
                save_image($newimg1, $path_save, $type);
            }
        } else {
            save_image($newimg1, $path_save, $type);
        }
    } else {
//        $newimg1 = imagecreatetruecolor($w, $h);
//        imagecopyresampled($newimg1, $image, 0, 0, 0, 0, $w, $h, $w, $h);
    }
}
