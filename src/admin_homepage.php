<?php
session_start();
require_once 'config/conn.php';

if (!isset($_SESSION['admin_login'])) {
  $_SESSION['error'] = 'กรุณาเข้าสู่ระบบก่อน !';
  header('location:index.php');
}

$query = $conn->query("SELECT * FROM product_list");
$rows = $query->rowCount(); // ใช้ rowCount() แทน mysqli_num_rows

$query_condo = $conn->query("SELECT * FROM product_list_condo");
$rows_condo = $query_condo->rowCount(); // ใช้ rowCount() แทน mysqli_num_rows
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AdminHomepage</title>
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
  if (isset($_SESSION['admin_login'])) {
    $admin_id = $_SESSION['admin_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  ?>

  <div class="navbar bg-base-100">
    <div class="flex lg:flex-1">
      <a href="#" class="-m-1.5 p-1.5">
        <img class="h-8 w-auto" src="img/home.png" alt="">
      </a>
      <strong>
        <h3 style="margin-left: 10px; margin-top: 5px; font-size: 1rem;" class="fm-f">Khai Thoe</h3>
      </strong>
    </div>
    <div class="flex-none gap-2">
      <div class="form-control">
        <h3 class="fm-f">Admin : <?php echo $row['firstname'] . ' ' . $row['lastname']; ?></h3>
      </div>
      <div class="dropdown dropdown-end">
        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <img alt="Tailwind CSS Navbar component"
              src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
          </div>
        </div>
        <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z- mt-3 w-52 p-2 shadow">
          <li><a>Profile</a></li>
          <li><a>Settings</a></li>
          <li><a>Logout</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="logo bg-gray-800 border-5 p-10 text-white">
    <h1 class="fm-f text-5xl text-center my-10">Welcome to homepage for Admin</h1>
    <h3 class="fm-f text-3xl text-center">ยินดีต้อนรับเข้าสู่หน้าแรกของแอดมิน</h3>
  </div>
  <?php
  if (isset($_SESSION['success'])) {
    echo "<script>alert('" . $_SESSION['success'] . "');</script>";
    unset($_SESSION['success']);
  }
  if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);
  }
  ?>
  <div class="container mx-auto">
    <h2 class="fm-f text-2xl my-10">รายการบ้านเดี่ยว ที่อยู่ในระบบ :</h2>
    <div class="container grid grid-cols-4 gap-8 my-10" id="product">

      <?php
      if ($rows > 0) {
        while ($product = $query->fetch(PDO::FETCH_ASSOC)) {
          // สร้าง card ที่แสดงรายละเอียดของอสังหาริมทรัพย์
          echo '<div class="max-w-md w-full">';
          echo '    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden hover:shadow-3xl">';
          echo '<a href="view_product.php?mid=' . $product["id_product"] . '">';
          echo '     <div class="relative group">';
          echo '        <img src="img/homerecom2.jpg" class="object-cover w-full aspect-square group-hover: transition duration-300 ease-in-out">';
          echo '        <div class="hover:bg-gray-600 group-hover:translate-y-0 pb-10 transform transition duration-300 ease-in-out absolute inset-0 bg-gradient-to-br to-indigo-600 opacity-75 flex items-center justify-center">';
          echo '            <span class="text-white text-lg font-bold opacity-0 group-hover:opacity-100 transition duration-300 ease-in-out">กดเพื่อดู</span>';
          echo '        </div>';
          echo '    </div>';
          echo '      </a>';
          echo '        <div class="p-6">';
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
          echo '<button class="w-full bg-yellow-300 text-white font-bold py-3 px-4 rounded-lg hover:bg-yellow-500 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg open-modal" data-id="' . htmlspecialchars($product['id_product']) . '" onclick="my_modal_1.showModal()">แก้ไข</button>';
          echo ' <form action="delete_product.php" method="post" onsubmit="return confirmDelete();">';
          echo '<input type="hidden" name="id_product" value="' . ($product['type']) . '">';
          echo '<input type="hidden" name="id_product" value="' . ($product['id_product']) . '">';
          echo ' <button class="w-full bg-red-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-red-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg" type="submit" name="delete">';
          echo '    ลบ';
          echo ' </button>';
          echo ' </form>';
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
    <?php
    if (isset($_SESSION['success'])) {
      echo "<script>alert('" . $_SESSION['success'] . "');</script>";
      unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
      echo "<script>alert('" . $_SESSION['error'] . "');</script>";
      unset($_SESSION['error']);
    }
    ?>
    <h2 class="fm-f text-2xl my-10">รายการคอนโด ที่อยู่ในระบบ :</h2>
    <div class="container grid grid-cols-4 gap-8 my-10" id="product">

      <?php
      if ($rows_condo > 0) {
        while ($product_condo = $query_condo->fetch(PDO::FETCH_ASSOC)) {
          // สร้าง card ที่แสดงรายละเอียดของอสังหาริมทรัพย์
          echo '<div class="max-w-md w-full">';
          echo '    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden hover:shadow-3xl">';
          echo '<a href="view_product.php?mid=' . $product_condo["id_product"] . '">';
          echo '     <div class="relative group">';
          echo '        <img src="img/homerecom2.jpg" class="object-cover w-full aspect-square group-hover: transition duration-300 ease-in-out">';
          echo '        <div class="hover:bg-gray-600 group-hover:translate-y-0 pb-10 transform transition duration-300 ease-in-out absolute inset-0 bg-gradient-to-br to-indigo-600 opacity-75 flex items-center justify-center">';
          echo '            <span class="text-white text-lg font-bold opacity-0 group-hover:opacity-100 transition duration-300 ease-in-out">กดเพื่อดู</span>';
          echo '        </div>';
          echo '    </div>';
          echo '      </a>';
          echo '        <div class="p-6">';
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
          echo '<button class="w-full bg-yellow-300 text-white font-bold py-3 px-4 rounded-lg hover:bg-yellow-500 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg open-modal" data-id="' . htmlspecialchars($product_condo['id_product']) . '" onclick="my_modal_1.showModal()">แก้ไข</button>';
          echo ' <form action="delete_product.php" method="post" onsubmit="return confirmDelete();">';
          echo '<input type="hidden" name="id_product" value="' . ($product_condo['type']) . '">';
          echo '<input type="hidden" name="id_product" value="' . ($product_condo['id_product']) . '">';
          echo ' <button class="w-full bg-red-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-red-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg" type="submit" name="delete">';
          echo '    ลบ';
          echo ' </button>';
          echo ' </form>';
          echo '            </div>';
          echo '        </div>';
          echo '    </div>';
          echo '</div>';
        }
      } else {
        echo "<p>ไม่มีรายการอสังหาริมทรัพย์</p>";
      }
      ?>
      <script>document.querySelectorAll('.open-modal').forEach(button => {
          button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            document.getElementById('my_modal_1').setAttribute('data-id', productId);
            // เปิด modal
            my_modal_1.showModal();
          });
        });</script>
      <script>
        function confirmDelete() {
          return confirm('คุณแน่ใจว่าต้องการลบสินค้านี้หรือไม่? การลบนี้ไม่สามารถย้อนกลับได้');
        }
      </script>

      <script>

        document.querySelectorAll('.open-modal').forEach(button => {
          button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            document.getElementById('my_modal_1').setAttribute('data-id', productId);
            // ตั้งค่า value ของ input field
            document.getElementById('id_product').value = productId;
            // เปิด modal
            my_modal_1.showModal();
          });
        });
      </script>

      <button class="btn btn-primary fixed bottom-4 right-4 text-white" onclick="my_modal_2.showModal()">
        เพิ่มรายการอสังหาริมทรัพย์
      </button>
      <dialog id="my_modal_2" class="modal">
        <div class="modal-box">
          <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
          </form>
          <h3 class="text-lg font-bold my-5 text-center fm-f text-10xl">กรอกข้อมูลอสังหาริมทรัพย์ !</h3>
          <form class="w-full max-w-lg" method="post" action="insert_db.php">
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                  ชื่ออสังหาริมทรัพย์
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                  name="product_name" id="grid-first-name" type="text" placeholder="บ้านดี" require="">
              </div>
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                  ราคา
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-last-name" type="number" name="price" placeholder="99999 บาท">
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                  รายละเอียดบ้านเพิ่มเติม
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-password" name="Detail" type="text" placeholder="รายละเอียดบ้าน">
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                  ที่อยู่
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-password" name="address" type="text" placeholder="บ้านเลขที่ ตำบล อำเภอ หมู่ อื่นๆ">
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-2">
              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                  จังหวัด
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  name="city" id="grid-city" type="text" placeholder="เช่น  เพชรบูรณ์ ">
              </div>
              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                  จำนวนห้องนอน
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-city" name="bedroom" type="number" placeholder="3">
              </div>

              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                  จำนวนห้องน้ำ
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-zip" name="bathroom" type="text" placeholder="1">
              </div>
            </div>
            <br>
            <div class="flex flex-wrap -mx-3 mb-2">
              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                  ประเภท
                </label>
                <div class="relative">
                  <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state" name="type">
                    <option value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                    <option value="คอนโด">คอนโด</option>
                  </select>
                </div>
              </div>
              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                  สถานะการขาย
                </label>
                <div class="relative">
                  <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state" name="status_product">
                    <option>ยังไม่ขาย</option>
                  </select>
                </div>
              </div>
              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                  วันที่ลงประกาศ
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-zip" name="date_listed" type="date" placeholder="1">
              </div>

            </div>
            <br>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                  รูปภาพบ้าน
                </label>
                <input type="file" name="product_image"
                  class="file-input file-input-bordered file-input-primary w-full max-w-xs" />
              </div>
            </div>
            <button class="btn btn-success flex mx-auto my-10 " type="submit" name="insert">เพิ่มข้อมูลสำเร็จ</button>
          </form>
        </div>
      </dialog>

      <dialog id="my_modal_1" class="modal">
        <div class="modal-box">
          <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
          </form>
          <h3 class="text-lg font-bold my-5 text-center fm-f text-10xl">แก้ไขข้อมูลอสังหาริมทรัพย์ !</h3>
          <form class="w-full max-w-lg" method="post" action="edit_db.php">
            <input type="hidden" name="id_product" id="id_product">
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                  ชื่ออสังหาริมทรัพย์
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                  name="product_name" id="grid-first-name" type="text" placeholder="บ้านดี" require="">
              </div>
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                  ราคา
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-last-name" type="number" name="price" placeholder="99999 บาท">
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                  รายละเอียดบ้านเพิ่มเติม
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-password" name="Detail" type="text" placeholder="รายละเอียดบ้าน">
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                  ที่อยู่
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-password" name="address" type="text" placeholder="บ้านเลขที่ ตำบล อำเภอ หมู่ อื่นๆ">
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-2">
              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                  จังหวัด
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  name="city" id="grid-city" type="text" placeholder="เช่น  เพชรบูรณ์ ">
              </div>
              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                  จำนวนห้องนอน
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-city" name="bedroom" type="number" placeholder="3">
              </div>

              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                  จำนวนห้องน้ำ
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-zip" name="bathroom" type="text" placeholder="1">
              </div>
            </div>
            <br>
            <div class="flex flex-wrap -mx-3 mb-2">
              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                  ประเภท
                </label>
                <div class="relative">
                  <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state" name="type">
                    <option value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                    <option value="คอนโด">คอนโด</option>
                  </select>
                </div>
              </div>
              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                  สถานะการขาย
                </label>
                <div class="relative">
                  <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state" name="status_product">
                    <option>ยังไม่ขาย</option>
                    <option>ขายแล้ว</option>
                  </select>
                </div>
              </div>
              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                  วันที่ลงประกาศ
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-zip" name="date_listed" type="date" placeholder="1">
              </div>

            </div>
            <br>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                  รูปภาพบ้าน
                </label>
                <input type="file" name="product_image"
                  class="file-input file-input-bordered file-input-primary w-full max-w-xs" />
              </div>
            </div>
            <button class="btn btn-success flex mx-auto my-10 " type="submit" name="edit">แก้ไขสำเร็จ</button>
          </form>
        </div>
      </dialog>

</body>

</html>