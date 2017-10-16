SELECT CONCAT( first, ' ', last ) as "name", title, aid title FROM Actor a, Movie m, MovieActor c
WHERE m.title = 'Death to Smoochy' and c.aid = a.id and m.id = c.mid 

