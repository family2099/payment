目標
===
撰寫一個簡易銀行系統，不同使用者有自己的餘額和明細，可出款、入款、查看餘額和帳目明細。另外須達成以下四項要求


要求
---
1. 程式撰寫命名與風格(Coding style)務必一致。可參考PHP-FIG網站
2. 確保同一使用者可”同時”進行出入款且餘額計算無誤。可用兩台電腦同時按送出測試問題。可搜尋Race condition進一步了解問題
3. 善加利用Git版本控制，務必讓每個commit清楚明瞭，讓評分者可以快速瞭解所有修改歷程與內容

  a. commit 說明務必簡單明瞭，可讓人一眼看出內容修改了什麼
  
  b. 一個 commit只做一件事，或只完成一個小段落，避免大量不同方面修改在同一個 commit 裡
  
4. 請注意Injection等資訊安全問題。帳號登入問題可以忽略

其他非必需加分條件
---
  - 測試碼 (請參考[網址](https://phpunit.de))

注意事項
---
  1. 前端介面簡易並可觸發功能即可，重點在後端server程式寫法
  2. 請針對要求製作出基本功能即可，多寫的功能不會加分也不會扣分。例如：使用者登入、轉帳、利息計算、多國幣別等... 這些就算多寫也不會加分

測試方式
---
- 採用 apache-benchmark ([ab](https://httpd.apache.org/docs/2.4/programs/ab.html)) 工具

1. 請先安裝

  > sudo apt-get update

  > sudo apt-get install apache2-utils

2. 簡易使用方式

  > ab -c 3 -n 1000 http://網址/
