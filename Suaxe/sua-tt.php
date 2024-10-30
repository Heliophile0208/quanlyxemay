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
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT xe.maxe, xe.tenxe, xe.namsx, xe.mota, xe.hinh, hangxe.tenhang, xe.dungtich FROM xe JOIN hangxe ON xe.mahang = hangxe.mahang WHERE xe.maxe = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Không tìm thấy xe.");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenxe = $_POST['tenxe'];
    $mahang = $_POST['mahang'];
    $namsx = $_POST['namsx'];
$dungtich = $_POST['dungtich'];
    $mota = $_POST['mota'];
    
    $target_dir = "Images/";
    $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
    $hinh = $row['hinh']; 

    if ($_FILES["hinh"]["name"] != "") {
        if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
            $hinh = $target_file;
        } else {
            echo "<script>alert('Có lỗi khi tải lên hình ảnh.');</script>";
        }
    }

    $sql = "UPDATE xe SET tenxe = ?, mahang = ?, namsx = ?, dungtich= ?, mota = ?, hinh = ? WHERE maxe = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiissi", $tenxe, $mahang, $namsx, $dungtich, $mota, $hinh, $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href='sua-xe.php';</script>";
    } else {
        echo "<script>alert('Lỗi: " . $conn->error . "');</script>";
    }
}

$sql = "SELECT mahang, tenhang FROM hangxe";
$result_hangxe = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Thông Tin Xe</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

form {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 0 auto;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
}

input[type="text"],
input[type="number"],
textarea,
select {
    width: calc(100% - 20px);
    padding: 12px;
    margin-bottom: 20px;
    border: 2px solid #ccc;
    border-radius: 5px;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
input[type="number"]:focus,
select:focus,
textarea:focus {
    border-color: #28a745;
    outline: none;
}

button {
    background: #28a745;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    transition: background 0.3s;
    margin:10px auto;
}

button:hover {
    background: #218838;
}

button:active {
    background: #1e7e34;
}
    </style>
</head>
<body>
    <h1>Chỉnh Sửa Thông Tin Xe</h1>
    <form action="sua-tt.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <label for="tenxe">Tên Xe:</label>
        <input type="text" id="tenxe" name="tenxe" value="<?php echo $row['tenxe']; ?>" required>

        <label for="mahang">Hãng Sản Xuất:</label>
        <select id="mahang" name="mahang" required>
            <?php
            if ($result_hangxe->num_rows > 0) {
                while ($hang = $result_hangxe->fetch_assoc()) {
                    $selected = ($hang['mahang'] == $row['mahang']) ? 'selected' : '';
                    echo "<option value='" . $hang['mahang'] . "' $selected>" . $hang['tenhang'] . "</option>";
                }
            }
            ?>
        </select>

        <label for="namsx">Năm Sản Xuất:</label>
        <input type="number" id="namsx" name="namsx" value="<?php echo $row['namsx']; ?>" min="<?php echo date('Y') - 5; ?>" max="<?php echo date('Y'); ?>" required>
  <label for="dungtich">Dung Tích:</label>
        <textarea id="dungtich" name="dungtich" required><?php echo $row['dungtich']; ?></textarea>

        <label for="mota">Mô Tả:</label>
        <textarea id="mota" name="mota" required><?php echo $row['mota']; ?></textarea>

        <label for="hinh">Hình Ảnh:</label>
        <input type="file" id="hinh" name="hinh" accept="image/*">

        <button type="submit">Cập Nhật</button>
    </form>

 
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
