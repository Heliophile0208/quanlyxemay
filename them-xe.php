<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlxemay";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$new_vehicle = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenxe = $_POST['tenxe'];
    $mahang = $_POST['mahang'];
    $namsx = $_POST['namsx'];
    $dungtich =$_POST['dungtich'];
    $mota = $_POST['mota'];

    $target_dir = "Images/";
    $target_file = $target_dir . basename($_FILES["hinh"]["name"]);

    if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
    $sql = "INSERT INTO xe (tenxe, mahang, namsx, dungtich, mota, hinh) VALUES ('$tenxe', '$mahang', '$namsx', '$dungtich', '$mota', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        $new_vehicle = [
            'tenxe' => $tenxe,
            'mahang' => $mahang,
            'namsx' => $namsx,
            'dungtich' => $dungtich,
            'mota' => $mota,
            'hinh' => $target_file
        ];
    } else {
        echo "<script>alert('Lỗi: " . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('Có lỗi khi tải lên hình ảnh.');</script>";
}

}

$sql = "SELECT mahang, tenhang FROM hangxe";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DANH MỤC XE MÁY</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0px auto;
            width: 1000px;
            padding: 0;
            background-image: linear-gradient(#0F5132, lightgreen, white);
        }

        .container {
            margin: 0px auto;
            background-color: white;
        }

        header {
            width: 1000px;
        }

        .menu {
            margin: 20px auto;
            text-align: center;
            padding: 10px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px auto;
        }

        .xe {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        label {
            display: inline-block;
            margin-bottom: 10px;
            font-weight: bold;
            width: 20%;
            margin-right: 20px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 60%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px; 
            display: inline-block;
        }
        textarea{
            height: 50px;
            margin-bottom:-10px
        }
        .nhap{
            flex-direction: row;
        }

        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 80%;
            margin-top: 20px;

        }

        button:hover {
            background: #218838;
        }

        .vehicle-info {
            margin-top: 30px;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .vehicle-info h2 {
            text-align: center;
            color: #333;
        }

        .vehicle-info img {
            max-width: 80%;
            height: auto;
            display: block;
            margin: 0 auto 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        .menu a {
            padding: 10px;
            border-radius: 10px;
            background-color: green;
            text-decoration: none;
            color: white;
        }

        footer {
            text-align: center;
            margin: 0px auto;
            padding: 10px;
            color: white;
            font-weight: bold;
            background-color: green;
        }

        .chon:hover {
            cursor: pointer
        }

        h1 {
            color: red
        }
        .anh{
            margin-top:10px;
        }
    </style>
    <script>
        const banners = [
            "Images/banner1.jpg",
            "Images/banner2.jpg",
            "Images/banner3.jpg"
        ];

        function setBanner(index) {
            document.getElementById("bannerImage").src = banners[index];
        }
    </script>

</head>

<body>
    <div class="container">
        <header>
            <div style="margin:0 auto; text-align: center;" class="logo">
                <a href="index.php"><img width=auto height="100px" src="Images/logo.jpg" alt="Logo Honda" />
                </a>
            </div>
            <form action="">
                <div class="banner">
                    <img id="bannerImage" width="100%" height="400px" src="Images/banner1.jpg" alt="Banner" />
                </div>
                <div class="select" style="margin:0 auto; text-align:center">
                    <input class="chon" type="radio" name="banner" onclick="setBanner(0)" checked>
                    <input class="chon" type="radio" name="banner" onclick="setBanner(1)">
                    <input class="chon" type="radio" name="banner" onclick="setBanner(2)">
                </div>
            </form>
        </header>
        <div class="menu">
            <a href="index.php">Trang Chủ</a>
            <a href="xoa-xe.php">Xóa</a>
            <a href="Suaxe/sua-xe.php">Sửa</a>
            <a href="xoa-multi-xe.php">Xóa Multi Xe</a>

        </div>

        <h1>Thêm Xe Mới</h1>
        <div style="margin-bottom: 20px;">
            <form class="xe" action="them-xe.php" method="POST" enctype="multipart/form-data">
                <div class="nhap">
                    <label for="tenxe">Tên Xe:</label>
                    <input type="text" id="tenxe" name="tenxe" required>
                </div>
                <div class="nhap">
                    <label for="mahang">Hãng Sản Xuất:</label>
                    <select id="mahang" name="mahang" required>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['mahang'] . "'>" . $row['tenhang'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="nhap">
                    <label for="namsx">Năm Sản Xuất:</label>
                    <input type="number" id="namsx" name="namsx" value="<?php echo date('Y'); ?>" min="<?php echo date('Y') - 5; ?>" max="<?php echo date('Y'); ?>" required>
                </div>

  <div class="nhap">
                     <label for="dungtich">Dung Tích:</label>

                     <input id="dungtich" name="dungtich" required></input>
                 </div>

                <div class="nhap">
                    <label for="mota">Mô Tả:</label>
                    <textarea id="mota" name="mota" required></textarea>
                </div>
               
                <div class="nhap anh">
                    <label for="hinh">Hình Ảnh:</label>
                    <input type="file" id="hinh" name="hinh" accept="image/*" required>
                </div>
                <div style="text-align: center;">
                    <button type="submit">Thêm Mới</button>
                </div>
            </form>
        </div>

        <?php if ($new_vehicle): ?>
            <div class="vehicle-info">
                <h2>Thông Tin Xe Vừa Thêm</h2>
                <img src="<?php echo $new_vehicle['hinh']; ?>" alt="Hình ảnh của xe">
                <table>
                    <tr>
                        <th>Tên Xe</th>
                        <td><?php echo $new_vehicle['tenxe']; ?></td>
                    </tr>
                    <tr>
                        <th>Hãng Sản Xuất</th>
                        <td><?php echo $new_vehicle['mahang']; ?></td>
                    </tr>
                    <tr>
                        <th>Năm Sản Xuất</th>
                        <td><?php echo $new_vehicle['namsx']; ?></td>
                    </tr>
                     <tr>
                         <th>Dung Tích</th>
                         <td><?php echo $new_vehicle['dungtich']; ?></td>
                     </tr>
                    <tr>
                        <th>Mô Tả</th>
                        <td><?php echo $new_vehicle['mota']; ?></td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>
</body>
<footer>
    <p>Copyright &copy; Honda Coropration</p>
    <p>Sinh viên thực hiện: Lê Thị Kim Ngân </p>
</footer>

</html>

<?php
$conn->close();
?>
