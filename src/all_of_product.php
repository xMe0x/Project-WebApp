<?php
session_start();
require_once 'config/conn.php';

$query = $conn->query("SELECT * FROM product_list");
$rows = $query->rowCount(); 

$query_condo = $conn->query("SELECT * FROM product_list_condo");
$rows_condo = $query_condo->rowCount(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.11/dist/full.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="output.css">
    <link rel="stylesheet" href="style_index.css">
    <title>Homepage</title>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
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
                    <li><a href="list_home.php">บ้านเดี่ยว</a></li>
                    <li><a href="list_condo.php">คอนโด</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <div tabindex="0" role="button" class="text-m font-semibold leading-6"></div>
                <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box w-52 p-2 shadow z-50">
                    <li><a href="list_home.php">บ้านเดี่ยว</a></li>
                    <li><a>คอนโด</a></li>
                </ul>
            </div>
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
            <a href="#" class="-m-1.5 p-1.5">
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
                    <li><a href="list_home.php">บ้านเดี่ยว</a></li>
                    <li><a href="list_condo.php">คอนโด</a></li>
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
    
      <dialog id="my_modal_2" class="modal">
        <div class="modal-box">
          <form method="dialog">
            <h3 class="font-bold text-center text-3xl fm-f">สมัครสมาชิก</h3>
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
          </form>
          <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4  sm:rounded-lg sm:px-10">
                <form method="post" action="sigup_db.php" >
                <?php
    if (isset($_SESSION['success'])) {
        echo "<script>alert('".$_SESSION['success']."');</script>";
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo "<script>alert('".$_SESSION['error']."');</script>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['warning'])) {
        echo "<script>alert('".$_SESSION['warning']."');</script>";
        unset($_SESSION['warning']);
    }
    ?>
                    <div>
                        <label for="firstname" class="block text-sm font-medium leading-5  text-gray-700">Firstname</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input minlength="5" id="firstname" name="firstname" placeholder="John" type="text" required=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <div class="hidden absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div>
                        <label for="lastname" class="block text-sm font-medium leading-5  text-gray-700">Lastname</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input minlength="5" id="lastname" name="lastname" placeholder="Doe" type="text" required=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <div class="hidden absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
    
                    <div class="mt-6">
                      <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                          Username
                      </label>
                      <div class="mt-1 relative rounded-md shadow-sm">
                          <input id="username" name="username" placeholder="memark555" type="text" minlength="5"
                              required=""
                              class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                          <div class="hidden absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                              <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                  <path fill-rule="evenodd"
                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                      clip-rule="evenodd"></path>
                              </svg>
                          </div>
                      </div>
                  </div>
    
                    <div class="mt-6">
                        <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                            Email address
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input id="email" name="email" placeholder="user@example.com" type="email"
                                required=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <div class="hidden absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
    
                    <div class="mt-6">
                        <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                            Password
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input placeholder="******************" id="password" minlength="8" name="password" type="password" required=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        </div>
                    </div>
    
                    <div class="mt-6">
                        <label for="password_confirmation" class="block text-sm font-medium leading-5 text-gray-700">
                            Confirm Password
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input placeholder="******************" id="c_password" name="con_password" minlength="8" type="password" required=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        </div>
                    </div>
    
                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <button type="submit" name="signup"
                                class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                สร้างแอคเคาท์
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
        </div>
      </dialog>
      <div class="content1 relative isolate overflow-hidden py-16 sm:py-24 lg:py-40">
        <!-- พื้นหลังเบลอ -->
        <div class="absolute inset-0 bg-[url('img/web-1-1024x512.jpg')] bg-cover blur-xl"></div>
        
        <!-- ข้อความไม่เบลอ -->
        <div class="relative z-10">
          <h2 class="text-3xl font-bold tracking-tight text-black sm:text-7xl fm-f">Khai Thoe ขายเถอะ</h2>
          <p class="mt-4 text-lg leading-8 text-black sm:text-3xl fm-f ">เว็บขายบ้านที่ เด็ก COMSCI แนะนำเป็นอันดับ 1</p>
          <p class="mt-4 text-lg leading-8 text-black sm:text-2xl fm-f ">ชอบหลังไหนเลือกได้เลย !</p>
        </div>
      </div>
  </div>
 
  <div class="content2 mx-auto my-10">
    <div class="container-fluid">
        <p class="text-5xl text-center fm-f font-semibold">บ้านเดี่ยว</p>
        <div class="container mx-auto my-20">
            <div class="grid grid-cols-3 gap-6"> 
                <?php
                if ($rows > 0) {
                    while ($product = $query->fetch(PDO::FETCH_ASSOC)) {
                      
                        echo '<div class="max-w-md w-full">'; 
                        echo '    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden hover:shadow-3xl transition-transform transform hover:scale-105">'; 
                        echo '<a href="view_product_home.php?id_product=' . $product["id_product"] . '">';
                        echo '     <div class="relative group">';
                        echo '        <img src="img/'.$product['product_image'].'" class="object-cover w-full h-48 group-hover: transition duration-300 ease-in-out">'; 
                        echo '<div class="absolute top-4 right-4 bg-gray-100 text-xs font-bold px-3 py-2 rounded-full z-20 fm-f transform rotate-12">'.htmlspecialchars($product['status_product']).'</div>';
                        echo '        <div class="hover:bg-gray-600 group-hover:translate-y-0 pb-10 transform transition duration-300 ease-in-out absolute inset-0 bg-gradient-to-br to-indigo-600 opacity-75 flex items-center justify-center">';
                        echo '            <span class="text-white text-lg font-bold opacity-0 group-hover:opacity-100 transition duration-300 ease-in-out">กดเพื่อดู</span>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '      </a>';
                        echo '        <div class="p-6 h-56">';
                        echo '            <h2 class="text-3xl font-extrabold text-gray-800 mb-2">' . htmlspecialchars($product['product_name']) . '</h2>';
                        echo '            <p class="text-gray-600 mb-4">' . htmlspecialchars($product['Detail']) . '</p>';
                        echo '            <div class="flex items-center justify-between mb-4">';
                        echo '                <p>ราคา : </p>';
                        echo '                <span class="text-2xl font-bold text-indigo-600">' . htmlspecialchars($product['price']) . '</span>';
                        echo '                <div class="flex items-center">';
                        echo '                    <p>จำนวนห้อง : </p>';
                        echo '                    <span class="ml-1 text-gray-600">' . htmlspecialchars($product['bedroom']) . ' นอน ' . htmlspecialchars($product['bathroom']) . ' น้ำ</span>';
                        echo '                </div>';
                        echo '            </div>';
                        echo '            <div class="grid grid-cols-2 gap-2">';
                        echo '                <div class="flex items-center">';
                        echo '                    <p> จังหวัด : </p>';
                        echo '                        <span class="ml-1 text-gray-600">' . htmlspecialchars($product['city']) .'</span>';
                        echo '                </div>';
                        echo '                <div class="flex items-center mx-9">';
                        echo '                    <p>ทีอยู่ : </p>';
                        echo '                    <span class="ml-1 text-gray-600">' . htmlspecialchars($product['address']) .'</span>';
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
<div class="content2 mx-auto my-10">
    <div class="container-fluid">
        <p class="text-5xl text-center fm-f font-semibold">บ้านเดี่ยว</p>
        <div class="container mx-auto my-20">
            <div class="grid grid-cols-3 gap-6"> 
                <?php
                  if ($rows_condo > 0) {
                    while ($product_condo = $query_condo->fetch(PDO::FETCH_ASSOC)) {
                      
                        echo '<div class="max-w-md w-full">'; 
                        echo '    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden hover:shadow-3xl transition-transform transform hover:scale-105">'; 
                        echo '<a href="view_product_home.php?id_product=' . $product_condo["id_product"] . '">';
                        echo '     <div class="relative group">';
                        echo '        <img src="img/'.$product_condo['product_image'].'" class="object-cover w-full h-48 group-hover: transition duration-300 ease-in-out">'; 
                        echo '<div class="absolute top-4 right-4 bg-gray-100 text-xs font-bold px-3 py-2 rounded-full z-20 fm-f transform rotate-12">'.htmlspecialchars($product_condo['status_product']).'</div>';
                        echo '        <div class="hover:bg-gray-600 group-hover:translate-y-0 pb-10 transform transition duration-300 ease-in-out absolute inset-0 bg-gradient-to-br to-indigo-600 opacity-75 flex items-center justify-center">';
                        echo '            <span class="text-white text-lg font-bold opacity-0 group-hover:opacity-100 transition duration-300 ease-in-out">กดเพื่อดู</span>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '      </a>';
                        echo '        <div class="p-6 h-56">';
                        echo '            <h2 class="text-3xl font-extrabold text-gray-800 mb-2">' . htmlspecialchars($product_condo['product_name']) . '</h2>';
                        echo '            <p class="text-gray-600 mb-4">' . htmlspecialchars($product_condo['Detail']) . '</p>';
                        echo '            <div class="flex items-center justify-between mb-4">';
                        echo '                <p>ราคา : </p>';
                        echo '                <span class="text-2xl font-bold text-indigo-600">' . htmlspecialchars($product_condo['price']) . '</span>';
                        echo '                <div class="flex items-center">';
                        echo '                    <p>จำนวนห้อง : </p>';
                        echo '                    <span class="ml-1 text-gray-600">' . htmlspecialchars($product_condo['bedroom']) . ' นอน ' . htmlspecialchars($product_condo['bathroom']) . ' น้ำ</span>';
                        echo '                </div>';
                        echo '            </div>';
                        echo '            <div class="grid grid-cols-2 gap-2">';
                        echo '                <div class="flex items-center">';
                        echo '                    <p> จังหวัด : </p>';
                        echo '                        <span class="ml-1 text-gray-600">' . htmlspecialchars($product_condo['city']) .'</span>';
                        echo '                </div>';
                        echo '                <div class="flex items-center mx-9">';
                        echo '                    <p>ทีอยู่ : </p>';
                        echo '                    <span class="ml-1 text-gray-600">' . htmlspecialchars($product_condo['address']) .'</span>';
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
<div class="footer">
  <footer class="footer footer-center bg-neutral text-primary-content p-10">
    <aside>
      <img src="img/home.png" alt="" style="width: 50px; height: 50px;">
      <p class="font-bold">
        Khai Thoe ขายเถอะ
        <br />
        เว็บขายบ้านที่ เด็ก COMSCI แนะนำเป็นอันดับ 1
      </p>
      <p>Product by : Webgen      </p>
    </aside>
    <nav>
      <div class="grid grid-flow-col gap-4">
        <a>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            class="fill-current">
            <path
              d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
          </svg>
        </a>
        <a>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            class="fill-current">
            <path
              d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
          </svg>
        </a>
        <a>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            class="fill-current">
            <path
              d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
          </svg>
        </a>
      </div>
    </nav>
  </footer>
</div>
</body>
</html>
</body>
</html>