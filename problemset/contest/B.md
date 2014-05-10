## 늰자 김병만
 
### 문제
 
아래 그림과 같이 WxH 크기 격자의 각 칸에 여러 색이 칠해진 천이 있습니다.

<div style='text-align:center'>
<img src='img/B1.png'/>
</div>

무늬의 달인 늰자 김병만 선생은 이 천의 일부를 직사각형 형태로 잘라서 새로운 무늬를 창조하려고 합니다. 
예를 들어 위 그림에서 1x1 크기의 정사각형을 잘라내면 민무늬가 되고, 왼쪽 위 2x2를 오려내면 빨간색, 녹색, 파란색이 들어간 체크무늬가 됩니다. 1x3 크기로 가운데 세로줄을 오려내면 녹색 사이에 빨간색이 들어간 무늬가 됩니다.

김병만 선생은 색이 아닌 크기와 무늬에만 관심이 있습니다. 그래서 잘려진 천의 너비, 높이와 색이 배치된 형태가 같으면 하나의 무늬로 분류합니다. 예를 들어 세로줄을 따라 위 천을 세 조각으로 자르면, 왼쪽 조각과 가운데 조각은 결국 같은 무늬가 됩니다. 둘 다 너비는 1, 높이는 3으로 같고, 위 칸과 아래 칸 색이 같고, 가운데 칸 색이 다르기 때문입니다. 또한 김병만 선생은 무늬를 회전시키거나 뒤집지 않습니다. 예를 들어 왼쪽 위 2x2를 오려낸 것과 왼쪽 아래 2x2를 오려낸 것은 회전이나 뒤집기를 고려하지 않으므로 다른 무늬입니다.

천의 크기와 천에 칠해진 색이 주어질 때, 김병만 선생이 만들어낼 수 있는 모든 무늬 종류의 개수를 구하세요. 천은 항상 격자의 선에 맞춰 잘라야 하며, 한 번도 자르지 않은 경우는 세지 않습니다.
                                                                                                                                                                                                   
### 입력
 
입력의 첫 줄에는 테스트 케이스의 수 C가 주어집니다. 각 테스트 케이스의 첫 줄에는 천의 높이 H와 너비 W가 주어집니다. 그 후 H줄에 각각 길이가 W인 문자열이 주어집니다. 문자열은 알파벳 대문자로 구성됩니다. 하나의 알파벳이 하나의 색을 의미합니다. (예를 들어 B=파란색, R=빨간색, P=보라색 등등)
 
### 출력
 
각 테스트 케이스마다 한 줄에 김병만 선생이 만들어낼 수 있는 모든 무늬 종류의 개수를 출력하세요.
 
### 입력 파일
 
##input_here##
 
 
### 제약 조건

#### B1.txt

* 1 <= H, W <= 6

#### B2.txt

* 1 <= H, W <= 50
 
### 예제 입력
 
<pre>
3
1 3
AAB
2 3
ABA
ABC
3 3
RGR
BRP
RGG
</pre>
 
### 예제 출력
 
<pre>
3
8
16
</pre>
