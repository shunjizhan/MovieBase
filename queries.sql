SELECT s.name from (SELECT CONCAT( first, ' ', last ) as name, title, aid FROM Actor a, Movie m, MovieActor c
WHERE m.title = 'Death to Smoochy' and c.aid = a.id and m.id = c.mid) s
-- find the names of all the actors in the movie 'Death to Smoochy'.

SELECT a.title from (SELECT title, ticketsSold FROM Movie m, Sales s
WHERE s.mid = m.id and s.ticketsSold > 900000) a
-- find all the titles of the movies which sold more than 900000 tickets


-- Give the count of all the directors who directed at least 4 movies.

SELECT last as "last name" from Actor
WHERE Actor.sex = 'Female'
-- find all the last names of actors who are females

SELECT x.title from (SELECT genre, id, title FROM MovieGenre m, Movie mv
WHERE m.genre = 'Comedy' and m.mid = mv.id) as x
-- find all the titles of comedy movies