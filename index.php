<?php
$servername = "127.0.0.1";
$tendangnhap = "root";
$matkhau = "";
$tenbang = "qlxemay";

$conn = new mysqli($servername, $tendangnhap, $matkhau, $tenbang);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");
$sql = "SELECT maxe,tenxe, xe.mahang, namsx, mota,hinh, tenhang, dungtich from xe inner join hangxe where xe.mahang=hangxe.mahang";
$ketqua = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUẢN LÝ XE MÁY</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0px auto;
            width: 1000px;
            padding: 0;
            background-image: linear-gradient(#0F5132, lightgreen, white);
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
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

        .tieude {
            text-align: center;
            color: red;
            font-weight: bold;
            font-size: 24px;
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .image-cell {
            width: 250px;
            text-align: center;
        }

        .image-cell img {
            width: 300px;
            height: auto;
            margin: 0px 20px;
        }

        .info {
            font-size: 18px;
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
            <a href="them-xe.php">Thêm</a>
            <a href="xoa-xe.php">Xóa</a>
            <a href="Suaxe/sua-xe.php">Sửa</a>
            <a href="xoa-multi-xe.php">Xóa Multi Xe</a>

        </div>
        <table>
            <tr>
                <td class="tieude" colspan="2">QUẢN LÝ XE MÁY</td>
            </tr>
            <?php
            if ($ketqua->num_rows > 0) {
                while ($dong = $ketqua->fetch_assoc()) {
                    $duong_dan_hinh = $dong["hinh"];

                    if (!file_exists($duong_dan_hinh)) {
                        $duong_dan_hinh = "Images/default-image.jpg";
                    }

                    echo "<tr>
                        <td class='image-cell'><img src='" . $duong_dan_hinh . "' alt='" . $dong["hinh"] . "'></td>
                        <td class='info'>
                            <h2> " . $dong["tenxe"] . " " . $dong["dungtich"] . "cc</h2>
                            - Mã Hãng: " . $dong["mahang"] . "<br>
                            - Năm Sản Xuất: " . $dong["namsx"] . "<br>
                            - Mô Tả: " . $dong["mota"] . "<br>
                            <h4>- Hãng Sản Xuất: " . $dong["tenhang"] . "</h4>
                        </td>
                      </tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Không có dữ liệu</td></tr>";
            }
            ?>
        </table>
        <footer>
            <p>Copyright &copy; Honda Coropration</p>
            <p>Sinh viên thực hiện: Lê Thị Kim Ngân </p>
        </footer>
    </div>
</body>

</html>

<?php
$conn->close();
?>