# InsuranceClientCRM
實作保戶介紹關係系統

# Develop Note
- 輸入不存在的 url request 會拋出Controller尚未initialize之Exception 而不是拋出 404 Page  (**fixed**)
- src/models/LoginForm.php 中 $user = User::findOne(['email' => $this->email]);
  拋出 findOne method 不是 static method 不能直接呼叫的錯誤  (**fixed**)


# 架構圖

// TODO

# 實作目的
  畢業專題採用 Laravel 框架進行開發，那時候我對框架的感受就是有好多功能強大的 method helper Routing etc ...
  框架都幫我寫好 我只要想好我自己的 Controller 或是 views models 要怎麼開發就好了 好爽喔，
  但那個 Middleware 目錄是什麼阿裡面一堆定義好的class在相互導用好神奇喔。

  於是我打算自己試試看 Build 一個框架出來、順便理解學習這些框架比較底層的技術打底。
  之後的學習目標是 RAG 跟 Angular 框架以及更深入 Typescript
  
