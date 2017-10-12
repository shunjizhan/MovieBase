CREATE TABLE Movie(
	id int, 
	title varchar(100), 
	year int, 
	rating varchar(10), 
	company varchar(50)
);

CREATE TABLE Actor();
CREATE TABLE Sales();
CREATE TABLE Director();
CREATE TABLE MovieGenre();
CREATE TABLE MovieDirector();
CREATE TABLE MovieActor();
CREATE TABLE MovieRating();
CREATE TABLE Review();
CREATE TABLE MaxPersonID();
CREATE TABLE MaxMovieID();

LOAD DATA LOCAL INFILE 'www/data/movie.del' INTO TABLE Movie
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';