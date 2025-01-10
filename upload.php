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

// استقبال البيانات من النموذج
$year = $_POST['year'];
$fileType = $_POST['file-type'];
$fileName = basename($_FILES["file"]["name"]);
$fileSize = $_FILES["file"]["size"]; // حجم الملف بالبايت
$targetDir = "uploads/" . $year . "/" . $fileType . "/";

// إنشاء المجلد إذا لم يكن موجوداً
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$targetFile = $targetDir . $fileName;

// تحريك الملف المرفوع إلى المجلد المناسب
if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
    // حفظ معلومات الملف في قاعدة البيانات
    $sql = "INSERT INTO files (year, file_type, file_name, file_path, file_size) VALUES ('$year', '$fileType', '$fileName', '$targetFile', '$fileSize')";
    if ($conn->query($sql) === TRUE) {
        // توجيه المستخدم إلى الصفحة المناسبة بناءً على السنة الدراسية
        if ($year == "first-year") {
            header("Location: first-year.php");
        } elseif ($year == "second-year") {
            header("Location: second-year.php");
        } elseif ($year == "third-year") {
            header("Location: third-year.php");
        } elseif ($year == "fourth-year") {
            header("Location: fourth-year.php");
        }
        exit();
    } else {
        echo "<script>alert('خطأ في حفظ المعلومات: " . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('حدث خطأ أثناء رفع الملف.');</script>";
}

$conn->close();
?>
