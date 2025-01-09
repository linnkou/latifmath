<?php
// إعدادات الاتصال بقاعدة البيانات (إذا كنت تستخدم قاعدة بيانات)
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
$targetDir = "uploads/" . $year . "/" . $fileType . "/";

// إنشاء المجلد إذا لم يكن موجوداً
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$targetFile = $targetDir . $fileName;

// تحريك الملف المرفوع إلى المجلد المناسب
if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
    echo "تم رفع الملف بنجاح: " . $fileName;

    // حفظ معلومات الملف في قاعدة البيانات (اختياري)
    $sql = "INSERT INTO files (year, file_type, file_name, file_path) VALUES ('$year', '$fileType', '$fileName', '$targetFile')";
    if ($conn->query($sql) === TRUE) {
        echo "تم حفظ المعلومات في قاعدة البيانات.";
    } else {
        echo "خطأ في حفظ المعلومات: " . $conn->error;
    }
} else {
    echo "حدث خطأ أثناء رفع الملف.";
}

$conn->close();
?>
