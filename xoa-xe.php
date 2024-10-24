<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlxemay";

$conn = new mysqli($servername, $username, $password, $dbname);

mysqli_set_charset($conn, "utf8");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM xe WHERE maxe = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Xóa thành công!'); window.location.href='xoa-xe.php';</script>";
    } else {
        echo "<script>alert('Lỗi: " . $conn->error . "');</script>";
    }
}

$sql = "SELECT * FROM xe";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa Xe</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    table {
        width: 90%;
        border-collapse: collapse;
        margin: 20px 50px ;
        font-size: 14px;
        
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #e9ecef;
        color: #333;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    button {
        background: #dc3545;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s;
    }

    button:hover {
        background: #c82333;
    }

    button:active {
        background: #bd2130;
    }

    input[type="checkbox"] {
        cursor: pointer;
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

    h1{color:red}
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
    <h1>Danh Sách Xe Cần Xóa</h1>
    <table>
        <thead>
            <tr>
                <th>Mã Xe</th>
                <th>Tên Xe</th>
                <th>Năm Sản Xuất</th>
                <th>Mô Tả</th>

                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['maxe']}</td>
                            <td>{$row['tenxe']}</td>
                            <td>{$row['namsx']}</td>
                            <td>{$row['mota']}</td>
                         
                            <td><a href='xoa-xe.php?id={$row['maxe']}' onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\");'>Xóa</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Không có dữ liệu</td></tr>";
            }
            ?>
        </tbody>
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