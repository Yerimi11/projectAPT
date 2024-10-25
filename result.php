<?php
session_start();
if (isset($_SESSION['result'])) {
    $mbti = $_SESSION['result']['mbti'];
    $scores = $_SESSION['result']['scores'];
    $traits = $_SESSION['result']['traits'];
    $selectedAnimal = $_SESSION['result']['selectedAnimal'];
    $selectedResidence = $_SESSION['result']['selectedResidence'];
} 

$animals = [
    '🐰' => ['토끼', '귀엽고', '민첩한'],
    '🐻' => ['곰', '든든하고', '포근한'],
    '🦊' => ['여우', '영리하고', '매력적인'],
    '🐨' => ['코알라', '느긋하고', '평화로운'],
    '🦁' => ['사자', '당당하고', '카리스마 있는'],
    '🐼' => ['팬더', '독특하고', '사랑스러운'],
    '🐯' => ['호랑이', '용감하고', '강인한'],
    '🦄' => ['유니콘', '환상적이고', '특별한'],
    '🐘' => ['코끼리', '지혜롭고', '온화한'],
    '🦉' => ['부엉이', '지적이고', '신중한'],
    '🐶' => ['강아지', '충실하고', '활발한'],
    '🐱' => ['고양이', '우아하고', '독립적인'],
    '🦜' => ['앵무새', '수다스럽고', '화려한'],
    '🐢' => ['거북이', '여유롭고', '느긋한'],
    '🦅' => ['독수리', '독특하고', '호기심 많은']
];

$mbtiAnimals = [
    'ISTJ' => ['animal' => '🐘', 'residence' => '강남 오피스텔'],
    'ISFJ' => ['animal' => '🐨', 'residence' => '한적한 시골 농가'],
    'INFJ' => ['animal' => '🦉', 'residence' => '북촌 한옥'],
    'INTJ' => ['animal' => '🦊', 'residence' => '편의점 냉장고 안'],
    'ISTP' => ['animal' => '🐱', 'residence' => '어제 배송온 택배 박스'],
    'ISFP' => ['animal' => '🐰', 'residence' => '해변가 별장'],
    'INFP' => ['animal' => '🦄', 'residence' => '포켓몬 몬스터볼 안'],
    'INTP' => ['animal' => '🦅', 'residence' => '숲속 글램핑장'],
    'ESTP' => ['animal' => '🐯', 'residence' => '길바닥'],
    'ESFP' => ['animal' => '🦜', 'residence' => '지하철역 화장실'],
    'ENFP' => ['animal' => '🐼', 'residence' => '한강뷰 펜트하우스'],
    'ENTP' => ['animal' => '🦁', 'residence' => '스폰지밥의 파인애플 집'],
    'ESTJ' => ['animal' => '🐶', 'residence' => '제주도 독채 펜션'],
    'ESFJ' => ['animal' => '🐻', 'residence' => '도심 속 빌라'],
    'ENFJ' => ['animal' => '🦄', 'residence' => '트리마제 아파트'],
    'ENTJ' => ['animal' => '🦁', 'residence' => '공항 벤치 위']
];

$residences = [
    '트리마제 아파트',
    '한강뷰 펜트하우스',
    '북촌 한옥',
    '강남 오피스텔',
    '제주도 독채 펜션',
    '한적한 시골 농가',
    '도심 속 빌라',
    '산장',                  // 7 X
    '해변가 별장',
    '길바닥',                 // 9 X
    '공항 벤치 위',
    '숲속 글램핑장',
    '지하철역 화장실',          // 12 X
    '구름 위의 솜사탕 펜트하우스', // 13 X
    '편의점 냉장고 안',
    '거대 햄스터 쳇바퀴',
    '슈퍼마리오의 파이프 속',
    '포켓몬 몬스터볼 안',
    '스폰지밥의 파인애플 집',
    '어제 배송온 택배 박스'
];

function determineMBTI($scores) {
    $mbti = '';
    $mbti .= ($scores['E'] > $scores['I']) ? 'E' : 'I';
    $mbti .= ($scores['S'] > $scores['N']) ? 'S' : 'N';
    $mbti .= ($scores['F'] > $scores['T']) ? 'F' : 'T';
    $mbti .= ($scores['J'] > $scores['P']) ? 'J' : 'P';
    return $mbti;
}

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>당신의 거주 캐릭터와 어울리는 주거지</title>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'CookieRun-Regular', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f3f3;
            text-align: center;
            color: #333;
        }
        .result-container {
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            max-width: 800px;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #ff8080;
            font-size: 28px;
        }
        #character {
            font-size: 120px;
            margin: 0px 0;
        }
        #description {
            font-size: 18px;
            margin: 0px 0;
            line-height: 1.6;
        }
        h2 {
            color: #5d5d5d;
            font-size: 24px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
            font-size: 12px;
        }
        #button-container {
            margin: 20px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 500px;
            padding: 0 20px;
            box-sizing: border-box;
        }
        
        #button-container button {
            background-color: #FF9999;
            border: none;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
            text-decoration: none;
            display: block;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 12px;
            width: 100%;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        #button-container button:last-child {
            background-color: #99CCFF;
            margin-bottom: 0;
        }
        
        #button-container button:nth-child(1) {
            background-color: #FF9999; /* 연한 분홍색 */
        }

        #button-container button:nth-child(2) {
            background-color: #FFCC99; /* 연한 주황색 */
        }

        #button-container button:nth-child(3) {
            background-color: #99CCFF; /* 연한 하늘색 */
        }

        #button-container button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.1);
            opacity: 0.8;
        }
        
        @media (max-width: 480px) {
            #button-container {
                padding: 0 10px;
            }
            
            #button-container button {
                font-size: 16px;
                padding: 15px 0;
            }
        }
    </style>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</head>
<body>
    <div class="result-container">
        <h1>🏠 당신의 거주 캐릭터와 어울리는 주거지 🏠</h1>
        <?php
        // Redis 연결
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);

        // 테스트 완료 카운터 증가
        $redis->incr('test_completed_count');

        // POST 데이터가 있는 경우에만 새로운 결과를 계산
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['results'])) {
            $results = json_decode($_POST['results'], true);
            
            $traits = [];
            $scores = [
                'E' => 0, 'I' => 0,
                'S' => 0, 'N' => 0,
                'F' => 0, 'T' => 0,
                'J' => 0, 'P' => 0 
            ];

            // 질문별 점수 계산
            if ($results[1] == "A") {
                $scores['E'] += 3; $scores['S'] += 2;
                $traits[] = "활기찬 도시 생활을 즐기며";
            } else {
                $scores['I'] += 3; $scores['S'] += 1;
                $traits[] = "조용한 환경을 선호하며";
            }

            if ($results[2] == "A") {
                $scores['E'] += 2; $scores['F'] += 1;
                $traits[] = "원하는 것을 이야기 할 줄 알고";
            } else {
                $scores['I'] += 3;
                $traits[] = "자립심이 강하고";
            }

            if ($results[3] == "A") {
                $scores['E'] += 3;
                $traits[] = "사교적이고 외향적이며";
            } else {
                $scores['I'] += 3; $scores['J'] += 2;
                $traits[] = "프라이버시를 중시하며";
            }

            if ($results[4] == "A") {
                $scores['E'] += 3;
                $traits[] = "파티를 즐기기도하고";
            } else {
                $scores['I'] += 3; $scores['S'] += 2; $scores['T'] += 2;
                $traits[] = "평화로운 환경을 선호하고";
            }

            if ($results[5] == "A") {
                $scores['E'] += 3; $scores['N'] += 2;
                $traits[] = "새로운 사람들과 어울리기를 좋아하고";
            } else {
                $scores['I'] += 3; $scores['S'] += 1;
                $traits[] = "신중하고 조심스럽고";
            }

            if ($results[6] == "A") {
                $scores['E'] += 2; $scores['F'] += 2;
                $traits[] = "적극적이고 주도적인";
            } else {
                $scores['I'] += 2; $scores['T'] += 2; $scores['J'] += 1;
            }

            if ($results[7] == "A") {
                $scores['S'] += 3;
                $traits[] = "문화생활을 즐기고";
            } else {
                $scores['N'] += 3;
                $traits[] = "호기심 많고";
            }

            if ($results[8] == "A") {
                $scores['S'] += 3; $scores['N'] -= 1;
                $traits[] = "안전을 중시하고";
            } else {
                $scores['N'] += 3; $scores['P'] += 2;
                $traits[] = "안전을 중시하고";
            }

            if ($results[9] == "A") {
                $scores['S'] += 3;
                $traits[] = "반려동물을 사랑하고";
                $traits[] = "현실적이고";
            } else {
                $scores['N'] += 3;
                $traits[] = "독특한 취미를 가지기도하는";
            }

            if ($results[10] == "A") {
                $scores['F'] += 3; $scores['S'] += 3; 
                $traits[] = "이웃과 소통하는 것을 선호하는";
            } else {
                $scores['T'] += 3; $scores['J'] += 1;
            }

            if ($results[11] == "A") {
                $scores['J'] += 3; $scores['E'] += 1;
            } else {
                $scores['P'] += 3; $scores['I'] += 1;
            }

            if ($results[12] == "A") {
                $scores['J'] += 3; $scores['N'] += 1;
                $traits[] = "준비성이 철저한";
            } else {
                $scores['P'] += 3; $scores['N'] += 1;
            }

            if ($results[13] == "A") {
                $scores['J'] += 3; $scores['E'] += 1;
            } else {
                $scores['P'] += 3; $scores['N'] += 1;
                $traits[] = "변화를 선호하는";
            }

            $mbti = determineMBTI($scores);

            // MBTI 결정 후 동물과 거주지 선택
            $selectedAnimal     = $mbtiAnimals[$mbti]['animal'];
            $selectedResidence  = $mbtiAnimals[$mbti]['residence'];

            // 결과를 세션에 저장
            $_SESSION['result'] = [
                'mbti'              => $mbti,
                'scores'            => $scores,
                'traits'            => $traits,
                'selectedAnimal'    => $selectedAnimal,
                'selectedResidence' => $selectedResidence
            ];

        } elseif (isset($_SESSION['result'])) {
            // 세션에서 결과 불러오기
            extract($_SESSION['result']);
        } else {
            // 결과가 없으면 인덱스 페이지로 리다이렉트
            header('Location: index.php');
            exit;
        }

        // 결과 설명 생성
        $animalInfo = $animals[$selectedAnimal];
        $resultDescription = "당신은 " . $animalInfo[1] . ", " . $animalInfo[2] . " 성향을 가지고 있습니다. ";

        ?>
        <div id="description">
            <p style="font-size: 21px; color: #ff6b6b; background-color: #fff0f0; padding: 10px; border-radius: 10px;">
                당신의 아파트 동물 캐릭터는 <br>
                <strong style="color: #4a69bd;"><?php echo $animals[$selectedAnimal][0]; ?></strong>
            </p>
            <div id="character"><?php echo $selectedAnimal; ?></div>
            
            <p style="font-size: 18px; color: #333; padding: 0px; border-radius: 10px; margin-top: 20px;">
                <?php
                foreach ($traits as $trait) {
                    echo $trait . "<br>";
                }
                ?>
                특성을 가진 주민이군요!
                <p><?php echo $resultDescription; ?></p>
            </p>
            <p style="font-size: 24px; color: #ff8080; background-color: #fff0f0; padding: 10px; border-radius: 10px;">
                <?php echo $animals[$selectedAnimal][0]; ?>같은 당신에게 어울리는 재미로 보는 주거지는 <br>
                <strong style="color: #4a69bd;"><?php echo $selectedResidence; ?></strong></p>
        </div>
        
        <h2>🌟 당신의 주거 스타일 🌟</h2>
        <ul>
            <?php
            $traitDescriptions = [
                'E' => '활발, 사교적',  'I' => '독립적, 조용',
                'S' => '실용적, 안정적', 'N' => '창의적, 모험적',
                'F' => '감정적',       'T' => '논리적',
                'J' => '계획적',       'P' => '즉흥적'
            ];
            foreach ($scores as $trait => $score):
                $description = $traitDescriptions[$trait];
            ?>
                <li><?php echo $description; ?>: <?php echo $score > 0 ? str_repeat('⭐', $score) : '-'; ?></li>
            <?php endforeach; ?>
        </ul>
        
    </div>


<!-- 카카오 애드핏 모바일 -->
<ins class="kakao_ad_area" style="display:none;"
data-ad-unit = "DAN-8Lt6yjihOTdqIay1"
data-ad-width = "320"
data-ad-format="auto"
data-ad-height = "50"></ins>
<script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
</div>

<!-- 버튼 추가 -->
<div id="button-container">
    <button onclick="captureAndShare()">📸 결과 이미지 저장하기</button>
    <button onclick="shareUrl()">🔗 링크 공유하기</button>
    <button onclick="location.href='index'">🔄 테스트 다시하기</button>
</div>


<script>
function shareUrl() {
    var dummy = document.createElement('input'),
    text = window.location.origin + '/index';

    document.body.appendChild(dummy);
    dummy.value = text;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);

    alert('URL이 클립보드에 복사되었습니다!');
}

function captureAndShare() {
    html2canvas(document.body).then(function(canvas) {
        // 캔버스를 이미지로 변환
        var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
        
        // 이미지 다운로드
        var link = document.createElement('a');
        link.download = 'apt_test_result.png';
        link.href = image;
        link.click();
    });
}
</script>

<div style="padding-top: 3px;">
    
</body>
</html>
