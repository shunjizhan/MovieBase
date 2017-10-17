-- For Movie
insert into	Movie value(489,NULL,1961,"PG","Paramount Pictures"); -- violates the NOT NULL constraints

insert into	Movie value(489,"Blue Hawaii",1961,"PG","Paramount Pictures"); -- violates the primary key constraints

-- For Actor
insert into Actor value (246,"Adams","Edie","Female",NULL,\N);  -- violates the NOT NULL constraints

insert into Actor value (246,"Adams","Edie","Female",19270416,\N); -- violates the primary key constraints



-- For Sales
insert into Sales value (1111,1174130,17611950); -- violate violates the primary key constraints

insert into Sales value (11111,1174130,17611950); -- violates the foreign key constraints

insert into Sales value (1568,-1,17611950); -- violates the CHECK constrains

-- For Director 
insert into Director value (45162,"Neretniece","Ada",NULL,\N); -- violates the NOT NULL constraints

insert into Director value (45162,"Neretniece","Ada",19240602,\N); -- violates the primary key constraints

-- For MovieGenre
insert into MovieGenre value (100000123,"Thriller"); -- violates the foreign key

insert into MovieGenre value (8,"Thriller"); -- violates the primary key constraints


-- For MovieActor
insert into MovieActor value (323200000,5316600000,"Prison Guard"); -- violates the foreign key constraints


insert into MovieActor value (3232,53166,"Prison Guard"); -- violates the primary key constraints

-- For MovieRating
insert into MovieRating value (3561,120,120); -- violates the CHECK constrains

insert into MovieRating value (3561,89,33); -- violates the primary key constraints

-- For MovieDirector
insert into MovieDirector value (219700000,114100000); -- violates the foreigh key

insert into MovieDirector value (2197,1141); -- violates the primary key constraints


