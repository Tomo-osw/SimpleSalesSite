# SimpleSalesSite

PHP、MySQLを使った簡易的な販売サイトを研究室内で用いています
※UIは今後少しずつ改良していければと考えています
<br>
ユーザ向けのページでは、ユーザ登録・ログインと現在販売されている商品を見ることができ、ネット上で購入ボタンを押していただいたのちに現実にある当該商品をそのまま取ってもらう仕組みとしています
料金支払いについては後払いを採用しており、管理ページで請求書を自動で発行して、現金もしくはスマホ決済サービスの送金でまとめて頂く形を取っています
※背景：大学がバスで約30分かかる山の上の方にあり、大学の生協で物を買おうとするとコンビニの1.5倍やそれ以上の価格帯となっているので、私がスーパー等で買ったものを車で持ってきて生協よりも安く販売することで、研究室内の学生も、私も得をするようなサイトとなっています

<img width="921" alt="スクリーンショット 2023-07-12 15 23 46" src="https://github.com/Tomo-osw/SimpleSalesSite/assets/84332899/55a1d013-6dd4-4c4d-9c68-467df546b891">

管理用のページでは、商品登録や各種修正・販売開始と停止の設定・商品一覧や在庫数・販売設定の確認・請求書発行が行えるようになっている
それぞれの処理に合わせて各テーブルのINSERTやUPDATEなどを行えるようになっている
請求書発行についてはGoogle スプレッドシートと連携しており、Gmailを用いてユーザに請求書メールを送信する手法を採用している

<img width="885" alt="スクリーンショット 2023-07-12 15 24 12" src="https://github.com/Tomo-osw/SimpleSalesSite/assets/84332899/e1387277-7e7a-4498-aaf4-6e7f05199189">

データベースの構造については最低限問題なく動くように作成したが、UNIQUEやINDEXなどもっとこだわる必要性を感じ、少しずつ改良していきたいと考えている<br>
Usersテーブル<br><br>
<img width="707" alt="スクリーンショット 2023-07-12 15 19 42" src="https://github.com/Tomo-osw/SimpleSalesSite/assets/84332899/d47a0e53-be1a-4c93-afaf-a356b0ec295c">

Productsテーブル<br><br>
<img width="732" alt="スクリーンショット 2023-07-12 15 19 54" src="https://github.com/Tomo-osw/SimpleSalesSite/assets/84332899/6500b314-5c33-4619-bab8-75a88bd713d1">

BuyProductsテーブル<br><br>
<img width="750" alt="スクリーンショット 2023-07-12 15 20 03" src="https://github.com/Tomo-osw/SimpleSalesSite/assets/84332899/eeac8d4d-f6fc-47f5-bbe1-84ccbad10d9d">


