CREATE TABLE Movie(
	id int, 
	title varchar(100), 
	year int, 
	rating varchar(10), 
	company varchar(50)
);

LOAD DATA LOCAL INFILE 'www/data/movie.del' INTO TABLE Movie
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';