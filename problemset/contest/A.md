## 정리 못하는 정리베
 
### 문제
 
알고스팟 새싹 콘테스트를 준비하느라 정신이 없던 정리베는, 버벅거리는 컴퓨터의 원인이 가득 찬 하드디스크라는 것을 알게 되었습니다. 하드의 파일들을 확인해본 후, 정리베는 두 가지 사실을 발견했습니다.

* 하드 용량의 대부분을 MP3파일이 차지한다.
* MP3파일 중에 중복되는 파일이 존재한다.

따라서 정리베는 MP3파일들을 정리하여 하드 공간을 어느 정도 더 확보할 수 있는지 알아보려고 합니다.

모든 MP3파일의 이름은 다음과 같은 형식으로 쓰여집니다. 이를 통해 MP3파일에 해당하는 아티스트 명과 곡의 제목을 알 수 있으며, 아티스트 명과 곡의 제목이 같을 경우 이를 동일한 곡으로 간주합니다.

* (트랙 번호)\_(아티스트 명)\_(곡 제목).mp3
* (트랙 번호). (아티스트 명) - (곡 제목).mp3
* (아티스트 명) - (곡 제목).mp3
* (아티스트 명)\_(곡 제목).mp3

(트랙 번호)는 0부터 9까지의 숫자 조합으로 이루어지고, (아티스트 명)과 (곡 제목)은 공백, 숫자, 영문자 그리고 여는 괄호 '('와 닫는 괄호 ')' 문자의 조합으로 이뤄집니다.
모든 파일은 위 4가지 중 한 가지 형식으로만 해석될 수 있습니다. (아티스트 명)과 (곡 제목) 비교시에 알파벳 대소문자는 구분하지 않습니다.

                                                                                                                                                                                                   
### 입력
 
입력의 첫 줄에는 곡의 개수 N이 입력됩니다. 그 후 N줄에 각각 파일의 경로가 주어지는데, 형식은 다음과 같습니다.

* (파일명)
* /(폴더1)/(폴더2)/.../(파일명)

2번째 형식의 경우 중첩된 폴더 구조에 위치한 파일을 의미합니다.

 
### 출력
 
한 줄에 중복을 모두 제외한 곡의 개수를 출력합니다.
 
### 입력 파일
 
##input_here##
 
 
### 제약 조건

 
### 예제 입력
 
<pre>
9
Above and Beyond Feat Zoe Johnston - Alchemy (Above and Beyond Club Mix).mp3
Coldplay - Every Teardrop Is A Waterfall (Swedish House Mafia Remix).mp3
/Andrew Rayel/Armin Van Buuren - Serenity (Andrew Rayel Aether Remix).mp3
Armin Van Buuren - Serenity (Andrew Rayel Aether Remix).mp3
/Above and Beyond Feat Zoe Johnston - Alchemy/Above and Beyond Feat Zoe Johnston - Alchemy (Above and Beyond Club Mix).mp3
Nuera - Transatlantic 2009 (Original Mix).mp3
/Discograph/Nuera/Nuera - Transatlantic 2011 (Original Mix).mp3
/Alex M O R P H - Eternal Flame (Alex M O R P H s Reach Out For The Stars Mix).mp3
01. Armin Van Buuren Feat Fiora - Waiting For The Night (Radio Edit).mp3
</pre>
 
### 예제 출력
 
<pre>
7
</pre>

