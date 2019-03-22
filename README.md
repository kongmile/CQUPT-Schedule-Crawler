# 重庆邮电大学教务在线课表爬虫
爬虫利用CURL库文件传输工具获取教务在线课表页面，再使用正则表达式从页面中匹配出课程信息，存入数据库。

下图 `课表在线` 是经过重新整理爬到的数据得到的课表
![经过重新整理爬到的数据得到的课表][1]

## 爬虫程序
getKebiao.php

## 结果示例
[kebiao.sql][2]

  [1]: https://i.loli.net/2019/03/22/5c94d9b364a04.png
  [2]: https://github.com/kongmile/kebiao/blob/master/kebiao.sql
