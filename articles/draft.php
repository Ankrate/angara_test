SELECT `query_ip`, COUNT(`query_ip`) 
AS NumOccurrences 
FROM search_query 
GROUP BY `query_ip` 
HAVING ( COUNT(`query_ip`) > 1 ) order by `NumOccurrences` desc