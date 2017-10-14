CREATE TABLE Movie(
	id int, 
	title varchar(100) NOT NULL, 
	year int, 
	rating varchar(10), 
	company varchar(50),
	PRIMARY KEY (id)
);

CREATE TABLE Actor(
	id int,
	last varchar(20),
	first varchar(20),
	sex varchar(6),
	dob DATE NOT NULL,
	dod DATE,
	PRIMARY KEY (id),
);

CREATE TABLE Sales(
	mid int,
	ticketsSold int,
	totalIncome int,
	PRIMARY KEY (mid),
	FOREIGN KEY (mid) references Movie(id),
	CHECK(ticketsSold >= 0)
) ENGINE=INNODB;

CREATE TABLE Director(
	id int,
	last varchar(20),
	first varchar(20),
	dob DATE NOT NULL,
	dod DATE,
	PRIMARY KEY (id),
);

CREATE TABLE MovieGenre(
	mid int,
	genre varchar(20),
	PRIMARY KEY (mid),
	FOREIGN KEY (mid) references Movie(id)
) ENGINE=INNODB;

CREATE TABLE MovieDirector(
	mid int,
	did int,
	PRIMARY KEY (mid),
	FOREIGN KEY (mid) references Movie(id),
	FOREIGN KEY (did) references Director(id)
) ENGINE=INNODB;

CREATE TABLE MovieActor(
	mid int,
	aid int,
	role varchar(50),
	PRIMARY KEY (mid),
	FOREIGN KEY (mid) references Movie(id),
	FOREIGN KEY (aid) references Actor(id)
) ENGINE=INNODB;

CREATE TABLE MovieRating(
	mid int,
	imdb int,
	rot int,
	PRIMARY KEY (mid),
	FOREIGN KEY (mid) references Movie(id),
	CHECK(rot >= 0 and rot <=100 and imdb >= 0 and imdb <=100)
) ENGINE=INNODB;

CREATE TABLE Review(
	name varchar(20),
	time timestamp,
	mid int,
	rating int,
	comment varchar(500),
	PRIMARY KEY (mid),
	FOREIGN KEY (mid) references Movie(id)
) ENGINE=INNODB;

CREATE TABLE MaxPersonID(id int);
CREATE TABLE MaxMovieID(id int);

