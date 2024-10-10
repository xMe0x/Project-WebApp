<?php
session_start();
require_once 'config/conn.php';

if (isset($_POST['search'])) {
  
    $text_search = $_POST['text_serch'];

    $sql = "
        SELECT * FROM (
            SELECT id_product,Detail,product_image,product_name, city, status_product, type,bedroom,bathroom,price,address
            FROM product_list
            WHERE product_name LIKE :text_search
            OR city LIKE :text_search
            OR status_product LIKE :text_search
            OR type LIKE :text_search

            UNION ALL

            SELECT id_product,Detail,product_image,product_name, city, status_product, type,bedroom,bathroom,price,address
            FROM product_list_condo
            WHERE product_name LIKE :text_search
            OR city LIKE :text_search
            OR status_product LIKE :text_search
            OR type LIKE :text_search
        ) AS combined_results
    ";


    $stmt = $conn->prepare($sql);

    
    $search_param = "%$text_search%"; 
    $stmt->bindParam(':text_search', $search_param, PDO::PARAM_STR);


    $stmt->execute();


    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Concert+One&family=Mitr:wght@200;300;400;500;600;700&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.11/dist/full.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="output.css">
  <link rel="stylesheet" href="style_index.css">
</head>
<body>
<?php



if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];


    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    <div class="navbar bg-base-100">
        <div class="flex lg:flex-1">
            <a href="#" class="-m-1.5 p-1.5">
                <img class="h-8 w-auto" src="img/home.png" alt="Home">
            </a>
            <strong>
                <h3 style="margin-left: 10px; margin-top: 5px; font-size: 1rem;" class="fm-f">Khai Thoe</h3>
            </strong>
        </div>
        <div class="flex-none gap-2">
            <div class="form-control">
                <h3 class="fm-f">User: <?= htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) ?></h3>
            </div>
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="User Avatar" src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                    </div>
                </div>
                <ul tabindex="0" class="z-50 menu menu-sm dropdown-content bg-base-100 rounded-box mt-3 w-52 p-2 shadow">
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
<?php
} elseif (isset($_SESSION['admin_login'])) {
    $admin_id = $_SESSION['admin_login'];

   
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :admin_id");
    $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

    <div class="navbar bg-base-100">
        <div class="flex lg:flex-1">
            <a href="index.php" class="-m-1.5 p-1.5">
                <img class="h-8 w-auto" src="img/home.png" alt="Home">
            </a>
            <strong>
                <h3 style="margin-left: 10px; margin-top: 5px; font-size: 1rem;" class="fm-f">Khai Thoe</h3>
            </strong>
        </div>
        <div class="flex-none gap-2">
        <a href="admin_homepage.php" class="text-m font-semibold leading-6 text-gray-900 mx-10">จัดการรายการอสังหาริมทรัพย์</a>
            <div class="form-control">
              
                <h3 class="fm-f">Admin: <?= htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) ?></h3>
            </div>
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Admin Avatar" src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                    </div>
                </div>
                <ul tabindex="0" class="z-50 menu menu-sm dropdown-content bg-base-100 rounded-box mt-3 w-52 p-2 shadow">
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
<?php
} else {
?>

    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="index.php" class="-m-1.5 p-1.5">
                <img class="h-8 w-auto" src="img/home.png" alt="Home"> 
            </a>
            <strong>
                <h3 style="margin-left: 10px; margin-top: 5px; font-size: 1rem;" class="fm-f">Khai Thoe</h3>
            </strong>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
            <a href="index.php" class="text-m font-semibold leading-6 text-gray-900">หน้าแรก</a>
            <div class="dropdown">
                <div tabindex="0" role="button" class="text-m font-semibold leading-6">ประเภท</div>
                <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box w-52 p-2 shadow z-50">
                    <li><a>บ้านเดี่ยว</a></li>
                    <li><a>คอนโด</a></li>
                </ul>
            </div>
        </div>
        <button class="btn btn-success mx-5" onclick="my_modal_3.showModal()">เข้าสู่ระบบ</button>
        <dialog id="my_modal_3" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-center text-3xl fm-f">เข้าสู่ระบบ</h3>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <form class="bg-white px-8 pt-6 pb-8 mb-4" method="post" action="signin_db.php">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" name="username" type="text" placeholder="Username" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="password" placeholder="******************" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="signin">เข้าสู่ระบบ</button>
                    </div>
                </form>
                <form method="dialog">
                    <button class="inline-block font-bold text-sm text-blue-500 hover:text-blue-800" onclick="my_modal_2.showModal()">คุณยังไม่มีบัญชี</button>
                </form>
            </div>
        </dialog>
    </nav>
<?php
}
?>

<div class="content2 mx-auto my-10">
    <div class="container-fluid">
        <p class="text-5xl text-center fm-f font-semibold">รายการที่ค้นหา</p>
        <div class="container mx-auto my-20">
            <div class="grid grid-cols-3 gap-6"> 
      <?php
    if ($results) {
        foreach ($results as $row) {
            echo '<div class="max-w-md w-full">'; 
            echo '    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden hover:shadow-3xl transition-transform transform hover:scale-105">'; 
            echo '<a href="view_product_home.php?id_product=' .htmlspecialchars( $row["id_product"]) . '">';
            echo '     <div class="relative group">';
            echo '        <img src="img/'.$row['product_image'].'" class="object-cover w-full h-48 group-hover: transition duration-300 ease-in-out">'; 
            echo '<div class="absolute top-4 right-4 bg-gray-100 text-xs font-bold px-3 py-2 rounded-full z-20 fm-f transform rotate-12">'.htmlspecialchars($row['status_product']).'</div>';
            echo '        <div class="hover:bg-gray-600 group-hover:translate-y-0 pb-10 transform transition duration-300 ease-in-out absolute inset-0 bg-gradient-to-br to-indigo-600 opacity-75 flex items-center justify-center">';
            echo '            <span class="text-white text-lg font-bold opacity-0 group-hover:opacity-100 transition duration-300 ease-in-out">กดเพื่อดู</span>';
            echo '        </div>';
            echo '    </div>';
            echo '      </a>';
            echo '        <div class="p-6 h-56">';
            echo '            <h2 class="text-3xl font-extrabold text-gray-800 mb-2">' . htmlspecialchars($row['product_name']) . '</h2>';
            echo '            <p class="text-gray-600 mb-4">' . htmlspecialchars($row['Detail']) . '</p>';
            echo '            <div class="flex items-center justify-between mb-4">';
            echo '                <p>ราคา : </p>';
            echo '                <span class="text-2xl font-bold text-indigo-600">' . htmlspecialchars($row['price']) . '</span>';
            echo '                <div class="flex items-center">';
            echo '                    <p>จำนวนห้อง : </p>';
            echo '                    <span class="ml-1 text-gray-600">' . htmlspecialchars($row['bedroom']) . ' นอน ' . htmlspecialchars($row['bathroom']) . ' น้ำ</span>';
            echo '                </div>';
            echo '            </div>';
            echo '            <div class="grid grid-cols-2 gap-2">';
            echo '                <div class="flex items-center">';
            echo '                    <p> จังหวัด : </p>';
            echo '                        <span class="ml-1 text-gray-600">' . htmlspecialchars($row['city']) .'</span>';
            echo '                </div>';
            echo '                <div class="flex items-center mx-9">';
            echo '                    <p>ทีอยู่ : </p>';
            echo '                    <span class="ml-1 text-gray-600">' . htmlspecialchars($row['address']) .'</span>';
            echo '                </div>';
            echo '            </div>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
       
        }
      } else {
        echo "<p>ไม่มีรายการอสังหาริมทรัพย์</p>";
      }
      ?>
        </div>
    </div>
    </div>
    </div>
</body>
</html>
