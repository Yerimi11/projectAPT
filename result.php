<?php
// 사용자가 입력한 데이터를 가져옵니다.
$question1 = $_POST['question1'];
$question2 = $_POST['question2'];

// 결과를 계산하거나 처리합니다. 여기서는 간단히 입력값을 출력합니다.
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>테스트 결과</title>
</head>
<body>
    <h1>테스트 결과</h1>
    <p>당신의 아파트는 <?php echo htmlspecialchars($question1); ?>층이고, 색상은 <?php echo htmlspecialchars($question2); ?>입니다.</p>
    <!-- 광고 배너를 추가할 수 있는 공간 -->
    <div id="ad-banner">
        <!-- 광고 코드 삽입 -->
    </div>
</body>
</html>
