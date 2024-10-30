<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlxemay";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

mysqli_set_charset($conn, "utf8");
$sql = "SELECT xe.maxe, xe.tenxe, xe.namsx, xe.mota,xe.dungtich ,hangxe.tenhang FROM xe JOIN hangxe ON xe.mahang = hangxe.mahang";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Xe - Chỉnh Sửa</title>
    <style>
        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin: 20px 50px;
            font-size:14px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #add8e6;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

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
        h1{
            color:red;
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
            "../Images/banner1.jpg",
            "../Images/banner2.jpg",
            "../Images/banner3.jpg"
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
                <a href="index.php"><img width=auto height="100px" src="../Images/logo.jpg" alt="Logo Honda" />
                </a>
            </div>
            <form action="">
                <div class="banner">
                    <img id="bannerImage" width="100%" height="400px" src="../Images/banner1.jpg" alt="Banner" />
                </div>
                <div class="select" style="margin:0 auto; text-align:center">
                    <input class="chon" type="radio" name="banner" onclick="setBanner(0)" checked>
                    <input class="chon" type="radio" name="banner" onclick="setBanner(1)">
                    <input class="chon" type="radio" name="banner" onclick="setBanner(2)">
                </div>
            </form>
        </header>



        <div class="menu">
            <a href="../index.php">Trang Chủ</a>
            <a href="../them-xe.php">Thêm</a>
            <a href="../xoa-xe.php">Xóa</a>
            <a href="../xoa-multi-xe.php">Xóa Multi Xe</a>

        </div>
        <h1>Danh Sách Xe Cần Chỉnh Sửa</h1>
        <table>
            <tr>
                <th>Tên Xe</th>
                <th>Hãng Sản Xuất</th>
                <th>Năm Sản Xuất</th>
                <th>Dung Tích</th>
                <th>Mô Tả</th>
              
                <th>Hành Động</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['tenxe']; ?></td>
                        <td><?php echo $row['tenhang']; ?></td>
                        <td><?php echo $row['namsx']; ?></td>
 <td><?php echo $row['dungtich']; ?></td>
                        <td><?php echo $row['mota']; ?></td>
                        <td><a href="sua-tt.php?id=<?php echo $row['maxe']; ?>">Chỉnh sửa</a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center;">Không có xe nào để chỉnh sửa.</td>
                </tr>
            <?php endif; ?>
        </table>
</body>
<footer>
    <p>Copyright &copy; Honda Coropration</p>
    <p>Sinh viên thực hiện: Lê Thị Kim Ngân </p>
</footer>

</html>

<?php
$conn->close();
?>
