<?php
session_start();
require_once 'config/conn.php';

if(isset($_POST['insert'])){
    $price = $_POST['price'];
    $product_image = $_POST['product_image'];
    $Detail = $_POST['Detail'];
    $city = $_POST['city'];
    $status_product = $_POST['status_product'];
    $date_listed = $_POST['date_listed'];
    $address = $_POST['address'];
    $bedroom = $_POST['bedroom'];
    $bathroom = $_POST['bathroom'];
    $type = $_POST['type'];
    $product_name = $_POST['product_name']; // ต้องมีค่าจากฟอร์ม
    
    if($type == "คอนโด"){
        $stmt = $conn->prepare("INSERT INTO product_list_condo (product_name, Detail, price, bedroom, bathroom,product_image,city,status_product,address,type,date_listed) VALUES (:product_name, :detail, :price, :bedroom, :bathroom,:product_image,:city,:status_product,:address,:type,:date_listed)");

    $stmt->bindValue(':product_name', $product_name);
    $stmt->bindValue(':detail', $Detail);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':bedroom', $bedroom);
    $stmt->bindValue(':bathroom', $bathroom);
    $stmt->bindValue(':product_image', $product_image);
    $stmt->bindValue(':city', $city);
    $stmt->bindValue(':status_product', $status_product);
    $stmt->bindValue(':address', $address);
    $stmt->bindValue(':type', $type);
    $stmt->bindValue(':date_listed', $date_listed);


    }else{
        $stmt = $conn->prepare("INSERT INTO product_list (product_name, Detail, price, bedroom, bathroom,product_image,city,status_product,address,type,date_listed) VALUES (:product_name, :detail, :price, :bedroom, :bathroom,:product_image,:city,:status_product,:address,:type,:date_listed)");

        $stmt->bindValue(':product_name', $product_name);
        $stmt->bindValue(':detail', $Detail);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':bedroom', $bedroom);
        $stmt->bindValue(':bathroom', $bathroom);
        $stmt->bindValue(':product_image', $product_image);
        $stmt->bindValue(':city', $city);
        $stmt->bindValue(':status_product', $status_product);
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':type', $type);
        $stmt->bindValue(':date_listed', $date_listed);
    }


    
    // รัน statement
    if($stmt->execute()) {
        $_SESSION['success'] = 'เพิ่มข้อมูลสำเร็จ';
        header("location:admin_homepage.php");
        exit(); // ปิดการทำงานของสคริปต์หลังจาก redirect
    } else {
        $_SESSION['error'] = 'มีข้อผิดพลาด';
        header("location:admin_homepage.php");
        exit(); // ปิดการทำงานของสคริปต์หลังจาก redirect
    }

    // ปิด statement
    $stmt->close();
}
?>
