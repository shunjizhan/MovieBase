SELECT CONCAT( first, ' ', last ) as "name", title, aid FROM Actor a, Movie m, MovieActor c
WHERE m.title = 'Death to Smoochy' and c.aid = a.id and m.id = c.mid 
-- Give the names of all the actors in the movie 'Death to Smoochy' and the tile of movie, and also the id of the Actor.

