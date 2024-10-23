<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>당신의 거주 캐릭터와 어울리는 주거지</title>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet"> -->
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
            margin: 30px 0;
        }
        #description {
            font-size: 18px;
            margin: 20px 0;
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
        session_start();

        // 동물과 거주지 정의
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

        // POST 데이터가 있는 경우에만 새로운 결과를 계산
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['results'])) {
            $results = json_decode($_POST['results'], true);
            
            $traits = [];
            $scores = [
                '활발' => 0, '조용' => 0, '사교적' => 0, '독립적' => 0,
                '실용적' => 0, '창의적' => 0, '모험적' => 0, '안정적' => 0
            ];

            // 질문별 점수 계산
            if ($results[1] == "A") {
                $scores['조용'] += 3; $scores['안정적'] += 2;
                $traits[] = "조용한 환경을 선호하며";
            } else {
                $scores['모험적'] += 3; $scores['활발'] += 2;
                $traits[] = "활기찬 도시 생활을 즐기며";
            }

            if ($results[2] == "A") {
                $scores['창의적'] += 3; $scores['사교적'] += 2;
                $traits[] = "엔터테인먼트를 즐기고";
            } else {
                $scores['실용적'] += 3; $scores['독립적'] += 2;
                $traits[] = "안전을 중시하고";
            }

            if ($results[3] == "A") {
                $scores['사교적'] += 3; $scores['활발'] += 2;
                $traits[] = "사교적이고 외향적이며";
            } else {
                $scores['조용'] += 3; $scores['독립적'] += 2;
                $traits[] = "프라이버시를 중시하며";
            }

            if ($results[4] == "A") {
                $scores['사교적'] += 3; $scores['활발'] += 2;
                $traits[] = "파티를 즐기기도하고";
            } else {
                $scores['조용'] += 3; $scores['실용적'] += 2;
                $traits[] = "평화로운 환경을 선호하고";
            }

            if ($results[5] == "A") {
                $scores['사교적'] += 2; $scores['창의적'] += 3;
                $traits[] = "야외 활동을 즐기기도 하며";
            } else {
                $scores['조용'] += 2; $scores['독립적'] += 3;
                $traits[] = "실내 활동을 선호하기도 하며";
            }

            if ($results[6] == "A") {
                $scores['모험적'] += 3; $scores['창의적'] += 2;
                $traits[] = "호기심 많고";
            } else {
                $scores['안정적'] += 3; $scores['조용'] += 2;
                $traits[] = "안전을 중시하고";
            }

            if ($results[7] == "A") {
                $scores['사교적'] += 3; $scores['활발'] += 2;
                $traits[] = "이웃과 소통하는 것을 좋아하며";
            } else {
                $scores['독립적'] += 3; $scores['실용적'] += 2;
                $traits[] = "자립심이 강하고";
            }

            if ($results[8] == "A") {
                $scores['사교적'] += 2; $scores['활발'] += 3;
                $traits[] = "반려동물을 사랑하고";
            } else {
                $scores['독립적'] += 2; $scores['창의적'] += 3;
                $traits[] = "독특한 취미를 가지고";
            }

            if ($results[9] == "A") {
                $scores['사교적'] += 3; $scores['창의적'] += 2;
                $traits[] = "새로운 사람들과 어울리기를 좋아하고";
            } else {
                $scores['독립적'] += 3; $scores['조용'] += 2;
                $traits[] = "신중하고 조심스럽고";
            }

            if ($results[10] == "A") {
                $scores['활발'] += 3; $scores['사교적'] += 2;
                $traits[] = "적극적이고 주도적인";
            } else {
                $scores['조용'] += 3; $scores['독립적'] += 2;
                $traits[] = "변화를 선호하는";
            }

            arsort($scores);
            $topTraits = array_slice(array_keys($scores), 0, 2);

            // 특성 조합에 따른 동물과 거주지 매핑
            $traitCombinations = [
                '활발_사교적'  => ['animal' => '🦜', 'residence' => $residences[12]],   // 토끼, 귀엽고, 민첩한 / 지하철역 화장실
                '활발_모험적'  => ['animal' => '🐯', 'residence' => $residences[9]],   // 호랑이, 용감하고, 강인한 / 길바닥
                '조용_안정적'  => ['animal' => '🐨', 'residence' => $residences[15]],  // 코알라, 느긋하고, 평화로운 / 거대 햄스터 쳇바퀴
                '조용_독립적'  => ['animal' => '🦉', 'residence' => $residences[5]],   // 부엉이, 지적이고, 신중한 / 한적한 시골 농가
                '사교적_창의적' => ['animal' => '🦄', 'residence' => $residences[17]],  // 유니콘, 환상적이고, 특별한 / 포켓몬 몬스터볼 안
                '독립적_실용적' => ['animal' => '🦊', 'residence' => $residences[14]],  // 편의점 냉장고 안
                '실용적_안정적' => ['animal' => '🐘', 'residence' => $residences[3]],   // 강남 오피스텔
                '창의적_모험적' => ['animal' => '🦁', 'residence' => $residences[18]],  // 스폰지밥의 파인애플 집
                '모험적_사교적' => ['animal' => '🐼', 'residence' => $residences[1]],   // 팬더, 독특하고, 사랑스러운, 한강뷰 펜트하우스
                '안정적_창의적' => ['animal' => '🐻', 'residence' => $residences[6]],   // 도심 속 빌라
                '안정적_사교적' => ['animal' => '🐶', 'residence' => $residences[4]],   // 제주도 독채 펜션
                '독립적_창의적' => ['animal' => '🐱', 'residence' => $residences[19]],  // 어제 배송온 택배 박스
                '모험적_실용적' => ['animal' => '🦅', 'residence' => $residences[11]],  // 지하철역 화장실
                '사교적_실용적' => ['animal' => '🐰', 'residence' => $residences[8]],   // 해변가 별장
                '조용_창의적'  => ['animal' => '🦉', 'residence' => $residences[2]],    // 북촌 한옥
                '활발_독립적'  => ['animal' => '🐱', 'residence' => $residences[0]],    // 트리마제 아파트
                '안정적_모험적' => ['animal' => '🐢', 'residence' => $residences[16]],  // 슈퍼마리오의 파이프 속
                '실용적_창의적' => ['animal' => '🦊', 'residence' => $residences[10]]   // 공항 벤치 위
            ];

            $traitKey = implode('_', $topTraits);

            // 조합에 해당하는 동물과 거주지 선택
            if (isset($traitCombinations[$traitKey])) {
                $selectedAnimal = $traitCombinations[$traitKey]['animal'];
                $selectedResidence = $traitCombinations[$traitKey]['residence'];
            } else {
                // 매칭되는 조합이 없을 경우 가장 높은 점수의 특성을 기반으로 선택
                $highestTrait = $topTraits[0];
                foreach ($traitCombinations as $key => $value) {
                    if (strpos($key, $highestTrait) !== false) {
                        $selectedAnimal = $value['animal'];
                        $selectedResidence = $value['residence'];
                        break;
                    }
                }
            }

            // 결과를 세션에 저장
            $_SESSION['result'] = [
                'selectedAnimal' => $selectedAnimal,
                'selectedResidence' => $selectedResidence,
                'scores' => $scores,
                'traits' => $traits,
                'topTraits' => $topTraits
            ];
        } elseif (!isset($_SESSION['result'])) {
            // POST 데이터가 없고 세션에도 결과가 없는 경우 인덱스 페이지로 리다이렉트
            header('Location: index');
            exit;
        }

        // 세션에서 저장된 결과 불러오기
        extract($_SESSION['result']);

        // 선택된 동물에 대한 정보 가져오기
        $animalInfo = $animals[$selectedAnimal];
        $animalName = $animalInfo[0];
        $animalTraits = array_slice($animalInfo, 1);

        // 결과 설명 생성
        $resultDescription = "당신은 " . implode(", ", $animalTraits) . " 성향을 가지고 있습니다. ";

        ?>
        <div id="description">
            <p style="font-size: 21px; color: #ff6b6b; background-color: #fff0f0; padding: 10px; border-radius: 10px;">당신의 아파트 동물 캐릭터는 <br><strong style="color: #4a69bd;"><?php echo $animalName; ?></strong></p>
            <div id="character"><?php echo $selectedAnimal; ?></div>
            
            <p style="font-size: 18px; color: #333; padding: 10px; border-radius: 10px; margin-top: 20px;">
                <?php
                foreach ($traits as $trait) {
                    echo $trait . "<br>";
                }
                ?>
                특성을 가진 주민이군요!
                <p><?php echo $resultDescription; ?></p>
            </p>
            <p style="font-size: 24px; color: #ff8080; background-color: #fff0f0; padding: 10px; border-radius: 10px;"><?php echo $animalName; ?>같은 당신에게 어울리는 주거지는 <br><strong style="color: #4a69bd;"><?php echo $selectedResidence; ?></strong></p>
        </div>
        
        <h2>🌟 당신의 주거 스타일 🌟</h2>
        <ul>
            <?php foreach ($scores as $trait => $score): ?>
                <li><?php echo $trait; ?>: <?php echo $score > 0 ? str_repeat('⭐', $score) : '-'; ?></li>
            <?php endforeach; ?>
        </ul>
        
    </div>




<!-- 테스트 다시하기 버튼과 공유하기 버튼 추가 -->
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
    
<!-- 하단 광고 배너 -->
<!-- 카카오 애드핏 모바일 -->
<ins class="kakao_ad_area" style="display:none;"
data-ad-unit = "DAN-8Lt6yjihOTdqIay1"
data-ad-width = "320"
data-ad-format="auto"
data-ad-height = "50"></ins>
<script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
</div>

<!-- 카카오 애드핏 PC -->
<!-- <ins class="kakao_ad_area" style="display:none;"
data-ad-unit = "DAN-90xLqmF4z7W7of9j"
data-ad-width = "728"
data-ad-height = "90"></ins>
<script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script> -->

<div id="bottom-ad-banner">
<!-- 구글 애드센스 -->
<!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
        style="display:block"
        data-ad-client="ca-pub-2599437760542212"
        data-ad-format="auto"
        data-full-width-responsive="true"></ins>
<script>
        (adsbygoogle = window.adsbygoogle || []).push({});
</script> -->
</div>
</body>
</html>
