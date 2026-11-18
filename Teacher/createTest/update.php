<?php
// عرض الأخطاء للتصحيح (اختياري، يُفضل تعطيله في بيئة الإنتاج)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// تعيين نوع الاستجابة كـ JSON
header('Content-Type: application/json');

// الاتصال بقاعدة البيانات
include('../../redundecyCode/connection.php');

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// استلام البيانات بصيغة JSON
$data = json_decode(file_get_contents("php://input"), true);

// التحقق من أن البيانات المستلمة صحيحة
if (!$data || !isset($data['title']) || !isset($data['description']) || !isset($data['questions']) || !isset($data['code'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
    exit;
}

// استخراج البيانات من JSON
$title = $data['title'];
$description = $data['description'];
$questions = json_encode($data['questions']); // تخزين الأسئلة كـ JSON في قاعدة البيانات
$email = $_COOKIE['email']; // يمكن تغييره إلى بريد المستخدم المسجل
$codeTest = $data['code'];

try {
    // تحضير استعلام الإدخال
    $sql = "UPDATE test SET title=?, description=?, Test=?, codeTest=? WHERE codeTest=?";
    $stmt = $conn->prepare($sql);

    // التحقق من أن التحضير تم بنجاح
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    // ربط المعاملات بالقيم
    $stmt->bind_param("sssss", $title, $description, $questions, $codeTest, $codeTest);

    // تنفيذ الاستعلام
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Quiz saved successfully']);
    } else {
        throw new Exception("Failed to execute statement: " . $stmt->error);
    }
} catch (Exception $e) {
    // في حالة حدوث خطأ أثناء التنفيذ
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
} finally {
    // إغلاق الاتصال
    $stmt->close();
    $conn->close();
}
?>