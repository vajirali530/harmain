<?php

require_once './vendor/autoload.php';
require_once './constant.php';



if(isset($_POST['submit_contact_form']) && $_POST['submit_contact_form'] == 'submit_contact_form'){

    try {
    
        $error = [];
        
        // if(verifyCaptchaScore($_POST['recaptcha_response'])){
            $email = $_POST["user_email"];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['user_email'] = "Not a valid Email";
            }
            $name = $_POST["user_name"];
            if (!preg_match("/^[a-zA-Z-' ]*$/",$name) || trim($name) == "") {
                $error['user_name'] = "Not a valid Name";
            }

            $phone = $_POST["user_phone"];
            if (!preg_match("/^[0-9]+[- ]?[0-9]+[- ]?[0-9]+$/",$phone)) {
                $error['user_phone'] = "Not a valid Phone";
            }

            $user_requirement = $_POST["user_requirement"];
            if (trim($user_requirement) == "") {
                $error['user_requirement'] = "Field Required";
            }

            if(count($error) > 0){
                throw new Exception(json_encode($error));
            }
            else{
                ob_start(); // start output buffer
                require_once './emailtemplates/contact_email_template.php';
                $message = ob_get_contents(); // get contents of buffer
                
                ob_end_clean();
                if(sendmail(ADMIN_EMAIL, 'Mominsara Developers', $message, null)){
                    ob_start(); // start output buffer
                    require_once './emailtemplates/contact_thankyou_template.php';
                    $message = ob_get_contents(); // get contents of buffer
                    ob_end_clean();
                    sendmail($email, 'Mominsara Developers', $message, null);

                    http_response_code(200);
                    echo json_encode(['success'=> 'Form submited successfully']);
                    exit;
                }
                else{
                    http_response_code(400);
                    echo json_encode(['toast'=>'Error while sending mail']);
                    exit;
                }
            }
        // }else{
        //     http_response_code(400);
        //     echo json_encode(['toast'=>'Captcha validation failed.']);
        //     exit;
        // }
        
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode(['error'=> json_decode($e->getMessage())]);
        exit;
    }
}

if(isset($_FILES['file']) &&  !empty($_FILES['file'])) {
    try {
        $error = [];
        $images = $_FILES['file']['name'];
        $images_size = $_FILES['file']['size'];
        $image_tmp_name = $_FILES['file']['tmp_name'];
        $json_data = file_get_contents('./json/data.json');
        $json_decode = json_decode($json_data, true);

        foreach($images as $name) {
            if (!in_array(pathinfo($name, PATHINFO_EXTENSION), ['png', 'jpg', 'jpeg']) ) {
                $error['file_type'] = "Invalid file type";
            }
        }
        foreach($images_size as $size) {
            if($size > 3145728){
                $error['file_size'] = "Invalid size of image";
            }
        }

        if(count($error) > 0){
            throw new Exception(json_encode($error));
        } else  {
            $desired_width="600";
            foreach($image_tmp_name as $key => $tmp_name) {
                $dest = 'images/gallery/thumb/'.$images[$key];
                $compressed_image = make_thumb($tmp_name, $dest, $desired_width);
                move_uploaded_file($tmp_name, "images/gallery/".$images[$key]);
                array_push($json_decode['gallery_images'], ['name' => $images[$key]]);
            }
            $json_data = json_encode($json_decode, JSON_FORCE_OBJECT);
            file_put_contents('./json/data.json', $json_data);
            http_response_code(200);
            echo json_encode(['success'=> 'Form submited successfully']);
            exit;
        }

    } catch(Exception $e) {
        http_response_code(400);
        echo json_encode(['error'=> json_decode($e->getMessage())]);
        exit;
    }
}

function make_thumb($src, $dest, $desired_width) {

    $image_detail = getimagesize($src);
    if($image_detail['mime'] == 'image/png') {
        $source_image = imagecreatefrompng($src);
    } elseif ($image_detail['mime'] == 'image/jpeg') {
        $source_image = imagecreatefromjpeg($src);
    }

    /* read the source image */
    $width = imagesx($source_image);
    $height = imagesy($source_image);

    /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desired_height = floor($height * ($desired_width / $width));

    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

    /* create the physical thumbnail image to its destination */
    if($image_detail['mime'] == 'image/png') {
        imagepng($virtual_image, $dest);
    } elseif ($image_detail['mime'] == 'image/jpeg') {
        imagejpeg($virtual_image, $dest);
    }
}
