<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>당신의 아파트 동물 캐릭터</title>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Jua', sans-serif;
            text-align: center;
            background-color: #f9f3f3;
            color: #333;
        }
        .result-container {
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            max-width: 600px;
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
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h1>🏠 당신의 아파트 동물 캐릭터 🏠</h1>
        <?php
        $results = json_decode($_POST['results'], true);
        
        $animals = [
            '🐰' => ['토끼', '귀여운', '민첩한'],
            '🐻' => ['곰', '든든한', '포근한'],
            '🦊' => ['여우', '영리한', '매력적인'],
            '🐨' => ['코알라', '느긋한', '평화로운'],
            '🦁' => ['사자', '당당한', '카리스마 있는'],
            '🐼' => ['팬더', '독특한', '사랑스러운'],
            '🐯' => ['호랑이', '용감한', '강인한'],
            '🦄' => ['유니콘', '환상적인', '특별한'],
            '🐘' => ['코끼리', '지혜로운', '온화한'],
            '🦉' => ['부엉이', '지적인', '신중한']
        ];

        $traits = [];
        $scores = [
            '활발' => 0, '조용' => 0, '사교적' => 0, '독립적' => 0,
            '실용적' => 0, '창의적' => 0, '모험적' => 0, '안정적' => 0
        ];

        // 질문별 점수 계산
        if ($results[1] == "1-5") {
            $scores['조용'] += 3; $scores['안정적'] += 2;
            $traits[] = "아늑한 저층을 좋아하는";
        } elseif ($results[1] == "6-10") {
            $scores['활발'] += 2; $scores['사교적'] += 2;
            $traits[] = "균형 잡힌 중층을 선호하는";
        } else {
            $scores['모험적'] += 3; $scores['독립적'] += 2;
            $traits[] = "탁 트인 전망의 고층을 즐기는";
        }

        if ($results[2] == "화이트") {
            $scores['활발'] += 2; $scores['실용적'] += 1;
            $traits[] = "깨끗하고 밝은 분위기를 좋아하는";
        } elseif ($results[2] == "베이지") {
            $scores['조용'] += 2; $scores['안정적'] += 1;
            $traits[] = "따뜻하고 편안한 분위기를 선호하는";
        } else {
            $scores['창의적'] += 2; $scores['독립적'] += 1;
            $traits[] = "모던하고 세련된 분위기를 추구하는";
        }

        // 나머지 질문들에 대한 점수 계산
        if ($results[3] == "넓은 거실") {
            $scores['사교적'] += 3; $scores['활발'] += 2;
            $traits[] = "넓은 공간에서 모임을 즐기는";
        } elseif ($results[3] == "큰 주방") {
            $scores['실용적'] += 3; $scores['창의적'] += 2;
            $traits[] = "요리와 식사를 중요하게 여기는";
        } else {
            $scores['독립적'] += 3; $scores['조용'] += 2;
            $traits[] = "개인적인 공간을 소중히 여기는";
        }

        if ($results[4] == "공원") {
            $scores['활발'] += 2; $scores['안정적'] += 2;
            $traits[] = "자연과 가까이 지내고 싶어하는";
        } elseif ($results[4] == "카페거리") {
            $scores['사교적'] += 3; $scores['창의적'] += 1;
            $traits[] = "문화생활을 즐기는";
        } else {
            $scores['실용적'] += 3; $scores['독립적'] += 1;
            $traits[] = "편리한 생활을 추구하는";
        }

        if ($results[5] == "반려동물") {
            $scores['사교적'] += 2; $scores['활발'] += 2;
            $traits[] = "동물을 사랑하는";
        } elseif ($results[5] == "식물") {
            $scores['조용'] += 2; $scores['창의적'] += 2;
            $traits[] = "식물 가꾸기를 좋아하는";
        } else {
            $scores['실용적'] += 2; $scores['독립적'] += 2;
            $traits[] = "깔끔하고 정돈된 환경을 선호하는";
        }

        // 최종 동물 선택
        $maxScore = max($scores);
        $dominantTraits = array_keys($scores, $maxScore);
        $dominantTrait = $dominantTraits[array_rand($dominantTraits)];

        $compatibleAnimals = [];
        foreach ($animals as $emoji => $animalTraits) {
            if (in_array($dominantTrait, $animalTraits)) {
                $compatibleAnimals[$emoji] = $animalTraits;
            }
        }

        if (empty($compatibleAnimals)) {
            $selectedAnimal = array_rand($animals);
        } else {
            $selectedAnimal = array_rand($compatibleAnimals);
        }

        $animalName = $animals[$selectedAnimal][0];
        $animalTraits = array_slice($animals[$selectedAnimal], 1);
        $description = implode(", ", $traits) . " " . $animalName;
        ?>
        <div id="character"><?php echo $selectedAnimal; ?></div>
        <div id="description">
            <p>당신의 아파트 동물 캐릭터는 <strong><?php echo $animalName; ?></strong>입니다!</p>
            <p><?php echo htmlspecialchars($description); ?> 특성을 가진 아파트 주민이군요!</p>
            <p>당신은 <?php echo implode(", 그리고 ", $animalTraits); ?> 성격을 가지고 있습니다.</p>
        </div>
        
        <h2>🌟 당신의 아파트 생활 스타일 🌟</h2>
        <ul>
            <?php foreach ($scores as $trait => $score): ?>
                <li><?php echo $trait; ?>: <?php echo str_repeat('⭐', $score); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- 광고 배너를 추가할 수 있는 공간 -->
    <div id="ad-banner">
        <!-- 예: Google AdSense 또는 다른 광고 네트워크의 스크립트 -->
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-xxxxxxxxxxxxxxxx"
             data-ad-slot="xxxxxxxxxx"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
</body>
</html>
