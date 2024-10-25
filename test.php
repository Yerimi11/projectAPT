<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>나만의 아파트 성격 테스트 <br> 🏠 </title>
    <link rel="stylesheet" href="styles.css">
    <style>
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
            font-size: 24px;
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
            font-size: 18px;
            margin-bottom: 100px;
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
        <h1> 나만의 아파트 성격 테스트 </h1>
        
        <form action="result" method="post">
            <div id="question-container">
                <div class="progress-container">
                    <div class="progress-bar" id="progressBar"></div>
                    <div class="home-icon"><h1>🏠</h1></div>
                </div>
                <div class="question" data-question="1">
                    <h2>1. 갑자기 복권에 당첨되어 아파트를 살 수 있다면?</h2>
                    <button type="button" onclick="selectAnswer(1, 'B')">도심 한복판의 초고층 아파트</button>
                    <button type="button" onclick="selectAnswer(1, 'A')">조용한 시골 마을의 펜트하우스</button>
                </div>
                <div class="question" data-question="2">
                    <h2>2. 주차장에서 차키를 잃어버렸다면?</h2>
                    <button type="button" onclick="selectAnswer(2, 'A')">이웃들에게 도움을 요청한다</button>
                    <button type="button" onclick="selectAnswer(2, 'B')">혼자서 끝까지 찾아본다</button>
                </div>
                <div class="question" data-question="3">
                    <h2>3. 아파트 엘리베이터에서 유명인을 만난다면?</h2>
                    <button type="button" onclick="selectAnswer(3, 'A')">셀카 찍고 SNS에 자랑한다</button>
                    <button type="button" onclick="selectAnswer(3, 'B')">조용히 인사하고 무시한다</button>
                </div>
                <div class="question" data-question="4">
                    <h2>4. 옆집에서 시끄러운 파티를 한다면?</h2>
                    <button type="button" onclick="selectAnswer(4, 'A')">참여해서 같이 논다</button>
                    <button type="button" onclick="selectAnswer(4, 'B')">경비실에 신고한다</button>
                </div>
                <div class="question" data-question="5">
                    <h2>5. 특이한 직업의 주민이 있다면?</h2>
                    <button type="button" onclick="selectAnswer(5, 'A')">호기심에 친해지려 노력한다</button>
                    <button type="button" onclick="selectAnswer(5, 'B')">의심스러워 경계한다</button>
                </div>
                <div class="question" data-question="6">
                    <h2>6. 아파트 관리비가 갑자기 2배로 오른다면?</h2>
                    <button type="button" onclick="selectAnswer(6, 'A')">주민 대표로 나서서 항의한다</button>
                    <button type="button" onclick="selectAnswer(6, 'B')">조용히 다른 아파트를 알아본다</button>
                </div>
                <div class="question" data-question="7">
                    <h2>7. 당신의 집 안에 비밀 공간을 만든다면?</h2>
                    <button type="button" onclick="selectAnswer(7, 'A')">영화관 같은 홈시어터룸</button>
                    <button type="button" onclick="selectAnswer(7, 'B')">비밀 탈출구가 있는 안전 벙커</button>
                </div>
                <div class="question" data-question="8">
                    <h2>8. 아파트에 귀신이 산다는 소문이 돈다면?</h2>
                    <button type="button" onclick="selectAnswer(8, 'B')">겁나서 이사 갈 준비를 한다</button>
                    <button type="button" onclick="selectAnswer(8, 'A')">흥미진진! 직접 탐사 나간다</button>
                </div>
                <div class="question" data-question="9">
                    <h2>9. 아파트 내 반려동물 동아리에 가입한다면?</h2>
                    <button type="button" onclick="selectAnswer(9, 'A')">강아지 산책 모임</button>
                    <button type="button" onclick="selectAnswer(9, 'B')">이국적인 파충류 모임</button>
                </div>
                <div class="question" data-question="10">
                    <h2>10. 아파트를 고를 때 중요하게 생각하는 요소는?</h2>
                    <button type="button" onclick="selectAnswer(10, 'A')">주변 환경과 아파트내 커뮤니티</button>
                    <button type="button" onclick="selectAnswer(10, 'B')">아파트의 투자 가치</button>
                </div>
                <div class="question" data-question="11">
                    <h2>11. 단지 내 정원 관리 방식을 결정해야한다면?</h2>
                    <button type="button" onclick="selectAnswer(11, 'A')">식물 목록을 구상해 상의한다</button>
                    <button type="button" onclick="selectAnswer(11, 'B')">도구와 씨앗만 준비하고 필요에 따라 꾸민다</button>
                </div>
                <div class="question" data-question="12">
                    <h2>12. 새롭게 인테리어를 한다면?</h2>
                    <button type="button" onclick="selectAnswer(12, 'A')">처음부터 전체 디자인을 세운다</button>
                    <button type="button" onclick="selectAnswer(12, 'B')">하나씩 가구를 구입하며 꾸민다</button>
                </div>
                <div class="question" data-question="13">
                    <h2>13. 아파트 행사 참석 여부는 어떻게 결정할까?</h2>
                    <button type="button" onclick="selectAnswer(13, 'A')">미리 정해서 스케줄을 맞춰본다</button>
                    <button type="button" onclick="selectAnswer(13, 'B')">흥미가 생기면 즉흥적으로 참여한다</button>
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
const totalQuestions = 13;
const answers = {};

function selectAnswer(questionNumber, answer) {
    answers[questionNumber] = answer;
    document.getElementById('results').value = JSON.stringify(answers);
    
    if (questionNumber < totalQuestions) {
        document.querySelector(`.question[data-question="${questionNumber}"]`).classList.remove('active');
        currentQuestion++;
        document.querySelector(`.question[data-question="${currentQuestion}"]`).classList.add('active');
        updateProgress(currentQuestion, totalQuestions);
    } else {
        document.getElementById('submit-button').style.display = 'block';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.question[data-question="1"]').classList.add('active');
    updateProgress(1, totalQuestions);
});

function updateProgress(current, total) {
  const progressBar = document.querySelector('.progress-bar');
  const homeIcon = document.querySelector('.home-icon');
  const percentage = (current / total) * 100;

  progressBar.style.width = percentage + '%';
  homeIcon.style.left = `calc(${percentage}% - 10px)`;
}


</script>
<div style="padding-top: 3px;">

<!-- 카카오 애드핏 모바일 -->
<ins class="kakao_ad_area" style="display:none;"
data-ad-unit = "DAN-8Lt6yjihOTdqIay1"
data-ad-width = "320"
data-ad-height = "50"></ins>
<script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
</div>

</body>
</html>
