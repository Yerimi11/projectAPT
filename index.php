<?php
session_start();
unset($_SESSION['result']);

// Redis 연결
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

// 테스트 완료 카운트 가져오기
$testCompletedCount = $redis->get('test_completed_count') ?: 0;
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>나에게 어울리는 아파트는?</title>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #ff8080;
            font-size: 24px;
        }
        p {
            font-size: 18px;
            line-height: 1.6;
        }
        .start-button:hover {
            background-color: #ff8080;
        }
        .main-image {
            max-width: 100%;
            height: auto;
            margin: 20px 0;
            border-radius: 10px;
        }
    </style>
    
</head>
<body>
    <div class="container">
        <h1> 나만의 아파트 성격 테스트 <br> 🏠 </h1>
        <img src="./image.jpeg" alt="Rosé & Bruno Mars" class="main-image">
        <p>
            당신의 거주 스타일은 어떤가요? 🤔<br>
            재미있는 질문들에 답하고 나만의 캐릭터와 어울리는 주거지를 알아보세요! 🐰🐻🦊
            <br>
            <br>
        </p>
        <a href="test" class="start-button">테스트 시작하기 🎉</a>
        
        <div class="completion-count">
            <p>지금까지 <span class="count"><?php echo number_format($testCompletedCount); ?></span>명이<br>테스트를 완료했습니다!</p>
        </div>
        <style>
            .completion-count {
                background-color: #f8f8f8;
                color: #333;
                padding: 15px;
                border-radius: 5px;
                margin-top: 50px;
                border: 1px solid #e0e0e0;
            }
            .completion-count p {
                margin: 0;
                font-size: 16px;
                line-height: 1.4;
            }
            .completion-count .count {
                font-size: 22px;
                font-weight: bold;
                color: #ff8080;
            }
        </style>
    </div>
    
<!-- 카카오 애드핏 모바일 -->
<ins class="kakao_ad_area" style="display:none;"
data-ad-unit = "DAN-8Lt6yjihOTdqIay1"
data-ad-width = "320"
data-ad-height = "50"></ins>
<script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>


</body>
</html>
