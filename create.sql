CREATE TABLE Movie(
	id int, 
	title varchar(100), 
	year int, 
	rating varchar(10), 
	company varchar(50)
);

CREATE TABLE Actor(
	id int,
	last varchar(20),
	first varchar(20),
	sex, varchar(6),
	dob, DATE,
	dod, DATE
);
CREATE TABLE Sales(
	mid int,
	ticketsSold int,
	totalIncome int
);
CREATE TABLE Director(
	id int,
	last varchar(20),
	first varchar(20),
	dob, DATE,
	dod, DATE
);
CREATE TABLE MovieGenre(
);
CREATE TABLE MovieDirector();
CREATE TABLE MovieActor();
CREATE TABLE MovieRating();
CREATE TABLE Review();
CREATE TABLE MaxPersonID();
CREATE TABLE MaxMovieID();

LOAD DATA LOCAL INFILE 'www/data/movie.del' INTO TABLE Movie
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';