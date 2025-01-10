<?php
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "math_resources";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// استعلام لاستخراج الملفات الخاصة بالسنة الأولى متوسط
$year = "first-year";
$sql = "SELECT * FROM files WHERE year = '$year'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>السنة أولى متوسط</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
            direction: rtl;
        }

        .main-title {
            background-color: #003366;
            color: white;
            padding: 40px 0;
            font-size: 2.5em;
            margin-bottom: 30px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #003366;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        .file-link {
            color: #003366;
            text-decoration: none;
            font-weight: bold;
        }

        .file-link:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #003366;
            color: white;
            padding: 20px;
            font-size: 1em;
        }

        .home-button {
            color: white;
            text-decoration: none;
            background-color: #003366;
            padding: 10px 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="main-title">
        السنة أولى متوسط
    </div>

    <table>
        <thead>
            <tr>
                <th>اسم الملف</th>
                <th>نوع الملف</th>
                <th>حجم الملف</th>
                <th>تاريخ الرفع</th>
                <th>تحميل</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $fileSizeKB = round($row['file_size'] / 1024, 2); // تحويل الحجم إلى كيلوبايت
                    echo "<tr>
                            <td>{$row['file_name']}</td>
                            <td>{$row['file_type']}</td>
                            <td>{$fileSizeKB} KB</td>
                            <td>{$row['upload_date']}</td>
                            <td><a href='{$row['file_path']}' class='file-link' download>تحميل</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>لا توجد ملفات مرفوعة بعد.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <footer>
        <a href="index.html" class="home-button">الرئيسية</a>
        <p>&copy; 2025 الرياضيات السهلة - جميع الحقوق محفوظة</p>
    </footer>

</body>
</html>

<?php
$conn->close();
?>
