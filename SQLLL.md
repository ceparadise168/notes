http://www.1keydata.com/tw/sql/sqlorderby.html

ORDER BY:

SELECT "欄位名" 
FROM "表格名" 
[WHERE "條件"]
ORDER BY "欄位名" [ASC, DESC];

[] 代表 WHERE 子句不是一定需要的。 不過，如果 WHERE 子句存在的話，它是在 ORDER BY 子句之前。 ASC 代表結果會以由小往大的順序列出，而 DESC 代表結果會以由大往小的順序列出。 如果兩者皆沒有被寫出的話，那我們就會用 ASC。