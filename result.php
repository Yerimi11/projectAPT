<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>당신의 거주 캐릭터와 어울리는 주거지</title>
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
        <h1>🏠 당신의 거주 캐릭터와 어울리는 주거지 🏠</h1>
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

        $residences = [
            '트리마제 아파트',
            '한강뷰 펜트하우스',
            '북촌 한옥',
            '강남 오피스텔',
            '제주도 독채 펜션',
            '한적한 시골 농가',
            '도심 속 빌라',
            '산장',
            '해변가 별장',
            '길바닥',
            '공항 벤치 위',
            '숲속 글램핑장',
            '지하철역 화장실',
            '동물원 원숭이 우리',
            '편의점 냉장고 안',
            '거대 햄스터 쳇바퀴',
            '슈퍼마리오의 파이프 속',
            '포켓몬 몬스터볼 안',
            '스폰지밥의 파인애플 집'
        ];

        $traits = [];
        $scores = [
            '활발' => 0, '조용' => 0, '사교적' => 0, '독립적' => 0,
            '실용적' => 0, '창의적' => 0, '모험적' => 0, '안정적' => 0
        ];

        // 질문별 점수 계산
        if ($results[1] == "A") {
            $scores['조용'] += 3; $scores['안정적'] += 2;
            $traits[] = "조용한 환경을 선호하는";
        } else {
            $scores['모험적'] += 3; $scores['활발'] += 2;
            $traits[] = "활기찬 도시 생활을 즐기는";
        }

        if ($results[2] == "A") {
            $scores['창의적'] += 3; $scores['사교적'] += 2;
            $traits[] = "엔터테인먼트를 즐기는";
        } else {
            $scores['실용적'] += 3; $scores['독립적'] += 2;
            $traits[] = "안전을 중시하는";
        }

        if ($results[3] == "A") {
            $scores['사교적'] += 3; $scores['활발'] += 2;
            $traits[] = "사교적이고 외향적인";
        } else {
            $scores['조용'] += 3; $scores['독립적'] += 2;
            $traits[] = "프라이버시를 중시하는";
        }

        if ($results[4] == "A") {
            $scores['사교적'] += 3; $scores['활발'] += 2;
            $traits[] = "파티를 즐기는";
        } else {
            $scores['조용'] += 3; $scores['실용적'] += 2;
            $traits[] = "평화로운 환경을 선호하는";
        }

        if ($results[5] == "A") {
            $scores['사교적'] += 2; $scores['창의적'] += 3;
            $traits[] = "야외 활동을 즐기는";
        } else {
            $scores['조용'] += 2; $scores['독립적'] += 3;
            $traits[] = "실내 활동을 선호하는";
        }

        if ($results[6] == "A") {
            $scores['모험적'] += 3; $scores['창의적'] += 2;
            $traits[] = "호기심 많은";
        } else {
            $scores['안정적'] += 3; $scores['조용'] += 2;
            $traits[] = "안전을 중시하는";
        }

        if ($results[7] == "A") {
            $scores['사교적'] += 3; $scores['활발'] += 2;
            $traits[] = "이웃과 소통하는 것을 좋아하는";
        } else {
            $scores['독립적'] += 3; $scores['실용적'] += 2;
            $traits[] = "자립심이 강한";
        }

        if ($results[8] == "A") {
            $scores['사교적'] += 2; $scores['활발'] += 3;
            $traits[] = "반려동물을 사랑하는";
        } else {
            $scores['독립적'] += 2; $scores['창의적'] += 3;
            $traits[] = "독특한 취미를 가진";
        }

        if ($results[9] == "A") {
            $scores['사교적'] += 3; $scores['창의적'] += 2;
            $traits[] = "새로운 사람들과 어울리기를 좋아하는";
        } else {
            $scores['독립적'] += 3; $scores['조용'] += 2;
            $traits[] = "신중하고 조심스러운";
        }

        if ($results[10] == "A") {
            $scores['활발'] += 3; $scores['사교적'] += 2;
            $traits[] = "적극적이고 주도적인";
        } else {
            $scores['조용'] += 3; $scores['독립적'] += 2;
            $traits[] = "변화를 선호하는";
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
        // 주거지 선택
        $residenceIndex = array_rand($residences);
        $selectedResidence = $residences[$residenceIndex];

        $animalName = $animals[$selectedAnimal][0];
        $animalTraits = array_slice($animals[$selectedAnimal], 1);
        $description = implode(", ", $traits) . " " . $animalName;
        ?>
        <div id="character"><?php echo $selectedAnimal; ?></div>
        <div id="description">
        <p style="font-size: 21px;">당신의 아파트 동물 캐릭터는 <strong><?php echo $animalName; ?></strong>입니다!</p>
            <p>
                <?php
                $traits = explode(", ", htmlspecialchars($description));
                foreach ($traits as $trait) {
                    echo $trait . "<br>";
                }
                ?>
                특성을 가진 아파트 주민이군요!
            </p>
            <p>당신은 <?php echo implode(", 그리고 ", $animalTraits); ?> 성격을 가지고 있습니다.</p>
            <p style="font-size: 24px;">당신에게 어울리는 주거지는 <strong><?php echo $selectedResidence; ?></strong>입니다!</p>
        </div>
        
        <h2>🌟 당신의 주거 스타일 🌟</h2>
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
