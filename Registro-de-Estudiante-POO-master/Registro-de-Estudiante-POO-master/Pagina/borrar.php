<?php
    require_once 'variables.php';
    require_once 'Student.php';
    require_once 'service/IServiceBase.php';
    require_once 'StudentServiceCookies.php';

    $service = new StudentServiceCookie();
    $isContainId = isset($_GET['id']);
 
    if ($isContainId) {
        $studentId = $_GET['id'];
        $service->delete($studentId);

    }
    header("Location: index.php");
    exit();
?>