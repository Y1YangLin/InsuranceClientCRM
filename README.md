# InsuranceClientCRM
實作保戶介紹關係系統

# Develop Note
- 輸入不存在的 url request 會拋出Controller尚未initialize之Exception 而不是拋出 404 Page  (**fixed**)
- src/models/LoginForm.php 中 $user = User::findOne(['email' => $this->email]);
  拋出 findOne method 不是 static method 不能直接呼叫的錯誤  (**fixed**)


# 架構圖
// Todo
# 感言
// Todo