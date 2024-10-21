<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>나만의 아파트 성격 테스트</title>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Jua', sans-serif;
            background-color: #f9f3f3;
            text-align: center;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #ff8080;
            font-size: 28px;
        }
        .question {
            display: none;
            margin-bottom: 20px;
        }
        .question.active {
            display: block;
        }
        h2 {
            color: #5d5d5d;
            font-size: 20px;
        }
        button {
            background-color: #ffa8a8;
            border: none;
            color: white;
            padding: 15px 30px;
            margin: 10px auto;
            border-radius: 25px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: 'Jua', sans-serif;
            display: block;
            width: 80%;
        }
        button:hover {
            background-color: #ff8080;
        }
        #submit-button {
            background-color: #80b3ff;
            font-size: 20px;
            margin: 20px auto;
        }
        #submit-button:hover {
            background-color: #5c9eff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏠 나만의 아파트 성격 테스트 🏠</h1>
        
        <form action="result.php" method="post">
            <div id="question-container">
                <div class="question" data-question="1">
                    <h2>1. 갑자기 복권에 당첨되어 아파트를 살 수 있다면?</h2>
                    <button type="button" onclick="selectAnswer(1, 'A')">조용한 시골 마을의 펜트하우스</button>
                    <button type="button" onclick="selectAnswer(1, 'B')">도심 한복판의 초고층 아파트</button>
                </div>
                <div class="question" data-question="2">
                    <h2>2. 당신의 아파트에 비밀 방을 만든다면?</h2>
                    <button type="button" onclick="selectAnswer(2, 'A')">영화관 같은 홈시어터룸</button>
                    <button type="button" onclick="selectAnswer(2, 'B')">비밀 탈출구가 있는 안전 벙커</button>
                </div>
                <div class="question" data-question="3">
                    <h2>3. 아파트 엘리베이터에서 유명인을 만난다면?</h2>
                    <button type="button" onclick="selectAnswer(3, 'A')">셀카 찍고 SNS에 자랑한다</button>
                    <button type="button" onclick="selectAnswer(3, 'B')">조용히 인사하고 무시한다</button>
                </div>
                <div class="question" data-question="4">
                    <h2>4. 아파트 옆집에서 시끄러운 파티를 한다면?</h2>
                    <button type="button" onclick="selectAnswer(4, 'A')">참여해서 같이 논다</button>
                    <button type="button" onclick="selectAnswer(4, 'B')">경비실에 신고한다</button>
                </div>
                <div class="question" data-question="5">
                    <h2>5. 아파트 내 특별한 공간을 하나 만들 수 있다면?</h2>
                    <button type="button" onclick="selectAnswer(5, 'A')">옥상 정원과 바베큐장</button>
                    <button type="button" onclick="selectAnswer(5, 'B')">지하 와인 셀러와 시음실</button>
                </div>
                <div class="question" data-question="6">
                    <h2>6. 아파트에 유령이 산다는 소문이 돈다면?</h2>
                    <button type="button" onclick="selectAnswer(6, 'A')">흥미진진! 직접 유령 탐사 나간다</button>
                    <button type="button" onclick="selectAnswer(6, 'B')">겁나서 이사 갈 준비를 한다</button>
                </div>
                <div class="question" data-question="7">
                    <h2>7. 아파트 주차장에서 차키를 잃어버렸다면?</h2>
                    <button type="button" onclick="selectAnswer(7, 'A')">이웃들에게 도움을 요청한다</button>
                    <button type="button" onclick="selectAnswer(7, 'B')">혼자서 끝까지 찾아본다</button>
                </div>
                <div class="question" data-question="8">
                    <h2>8. 아파트 내 반려동물 동아리에 가입한다면?</h2>
                    <button type="button" onclick="selectAnswer(8, 'A')">강아지 산책 모임</button>
                    <button type="button" onclick="selectAnswer(8, 'B')">이국적인 파충류 모임</button>
                </div>
                <div class="question" data-question="9">
                    <h2>9. 아파트 단지 내 특이한 직업의 주민이 있다면?</h2>
                    <button type="button" onclick="selectAnswer(9, 'A')">호기심에 친해지려 노력한다</button>
                    <button type="button" onclick="selectAnswer(9, 'B')">의심스러워 경계한다</button>
                </div>
                <div class="question" data-question="10">
                    <h2>10. 아파트 관리비가 갑자기 2배로 오른다면?</h2>
                    <button type="button" onclick="selectAnswer(10, 'A')">주민 대표로 나서서 항의한다</button>
                    <button type="button" onclick="selectAnswer(10, 'B')">조용히 다른 아파트를 알아본다</button>
                </div>
            </div>
            <input type="hidden" name="results" id="results">
            <div style="text-align: center;">
                <button type="submit" id="submit-button" style="display: none;">결과 보기 🎉</button>
            </div>
        </form>
    </div>

<script>
let currentQuestion = 1;
const totalQuestions = 10;
const answers = {};

function selectAnswer(questionNumber, answer) {
    answers[questionNumber] = answer;
    console.log(answers);
    document.getElementById('results').value = JSON.stringify(answers);

    if (questionNumber < totalQuestions) {
        document.querySelector(`.question[data-question="${questionNumber}"]`).classList.remove('active');
        currentQuestion++;
        document.querySelector(`.question[data-question="${currentQuestion}"]`).classList.add('active');
    } else {
        document.getElementById('submit-button').style.display = 'block';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.question[data-question="1"]').classList.add('active');
});
</script>
</body>
</html>
