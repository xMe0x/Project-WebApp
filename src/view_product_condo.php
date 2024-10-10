<?php
    if(!isset($_GET['id_product'])){
        header("location:admin_homepage.php");
        exit(); //ยุดการทำงานทันทีหลังจากการเปลี่ยนเส้นทาง
    }

    // รับค่า id_product จาก URL
    $id_product = $_GET['id_product'];

    require_once 'config/conn.php';

    // ดึงข้อมูลตาม id_product ที่ส่งเข้ามา
    $query = $conn->prepare("SELECT * FROM product_list_condo WHERE id_product = :id_product");
    $query->bindParam(':id_product', $id_product, PDO::PARAM_INT);
    $query->execute();

    // ตรวจสอบว่ามีผลลัพธ์
    if ($query->rowCount() > 0) {
        $product = $query->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "ไม่พบรายการอสังหาริมทรัพย์ที่มี id_product = " . htmlspecialchars($id_product);
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['product_name']); ?></title>
</head>
<body>
    <!-- แสดงข้อมูลสินค้า -->
    <h1><?php echo htmlspecialchars($product['product_name']); ?></h1>
    <p>รายละเอียด: <?php echo htmlspecialchars($product['Detail']); ?></p>
    <p>ราคา: <?php echo htmlspecialchars($product['price']); ?> บาท</p>
    <p>จำนวนห้องนอน: <?php echo htmlspecialchars($product['bedroom']); ?></p>
    <p>จำนวนห้องน้ำ: <?php echo htmlspecialchars($product['bathroom']); ?></p>
    <p>เมือง: <?php echo htmlspecialchars($product['city']); ?></p>
    <p>ที่อยู่: <?php echo htmlspecialchars($product['address']); ?></p>
    <p>สถานะสินค้า: <?php echo htmlspecialchars($product['status_product']); ?></p>
</body>
</html>
