-- For Movie
update Movie set title=NULL; -- violates the NOT NULL constraints

insert into	Movie value(489,"Blue Hawaii",1961,"PG","Paramount Pictures"); -- violates the primary key constraints

-- For Actor
update Actor set dob=NULL; -- violates the NOT NULL constraints

insert into Actor value(3992,780999,11714985
); -- violates the primary key constraints


-- For Sales
insert into Sales value(11111,1174130,17611950
); -- violates the primary key constraints

insert into Sales value(1568,-1,17611950
); -- violates the CHECK constrains

-- For Director 
Update Director set dob=NULL; -- violates the NOT NULL constraints

insert into Director value(3141,"Bahloul","Abdelkrim", NULL,\N
); -- violates the primary key constraints

-- For MovieGenre
insert into MovieGenre(100000123,"Thriller"); -- violates the foreign key

insert into MovieGenre(8,"Thriller"); -- violates the primary key constraints


-- For MovieActor
insert into MovieActor(323200000,5316600000,"Prison Guard"); -- violates the foreign key constraints


insert into MovieActor(3232,53166,"Prison Guard"); -- violates the primary key constraints

-- For MovieRating
insert into MovieRating(3561,-89,-33); --violates the CHECK constrains

insert into MovieRating(3561,89,33); -- violates the primary key constraints

-- For MovieDirector
insert into MovieDirector(219700000,114100000); -- violates the foreigh key

insert into MovieDirector(2197,1141); -- violates the primary key constraints
