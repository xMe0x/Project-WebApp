<?php
session_start();
require_once 'config/conn.php';

$query = $conn->query("SELECT * FROM product_list");
$rows = $query->rowCount(); 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List_home</title>
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
<?php if(isset($_SESSION['user_login'])) {
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
        <div class="flex-none gap-2">
        <div class=" lg:flex lg:gap-x-12 mx-5">
            <a href="index.php" class="text-m font-semibold leading-6 text-gray-900">หน้าแรก</a>
            <a href="all_of_product.php" class="text-m font-semibold leading-6 text-gray-900">รายการทั้งหมด</a>
            
        </div>
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
}elseif (isset($_SESSION['admin_login'])) {
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
            <a href="index.php" class="text-m font-semibold leading-6 text-gray-900">รายการทั้งหมด</a>
            
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
        <p class="text-5xl text-center fm-f font-semibold">รายการบ้านเดี่ยวทั้งหมด</p>
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
  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" id="ig" viewBox="0 0 20 20" class="fill-current">
  <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
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