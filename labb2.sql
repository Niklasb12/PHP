CREATE TABLE post(
	postId INT NOT NULL AUTO_INCREMENT,
	postTitle VARCHAR(50),
	postContent VARCHAR(5000),
	postDate DATE,
    userPostUid INT,
	PRIMARY KEY (postId),
    FOREIGN KEY (userPostUid) REFERENCES users(userId)
);

CREATE TABLE users(
	userId INT NOT NULL AUTO_INCREMENT,
    userEmail VARCHAR(100),
    userName VARCHAR(50),
    userPassword VARCHAR(500),
    userDate DATE,
    PRIMARY KEY (userId)
);

CREATE TABLE images (
 id INT NOT NULL AUTO_INCREMENT,
 image longblob NOT NULL,
 uploaded date NOT NULL,
 imagePid INT,
 PRIMARY KEY (id),
 FOREIGN KEY (imagePid) REFERENCES post(postId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

SELECT * FROM images WHERE imageUid=1 ORDER BY uploaded DESC;

SELECT users.userName, users.userDate, post.postDate, post.postTitle, post.postContent, post.postId, images.image
from post
inner join users
on users.userId = post.userPostUid
inner join images
on images.imageUid = users.userId
WHERE users.userId = 1;

create table userPost(
	userPostId int not null auto_increment,
    userPostUid INT,
    userPostPid INT,
    PRIMARY KEY (userPostId),
	FOREIGN KEY (userPostUid) REFERENCES users(userId),
	FOREIGN KEY (userPostPid) REFERENCES post(postId)
);

SELECT * from post;

SELECT * from users;

SELECT * from images;

SELECT * from userPost;

SELECT * from userPost where userPostUid=1;

select * from post inner join users on post.userPostUid = users.userId;

select * from userPost;

INSERT INTO userPost (userPostUid, userPostPid) VALUES ('1','11');

select users.userId, users.userDate, users.userName, post.postTitle, post.postContent, post.postDate
from post 
inner join userPost
on post.postId = userPost.userPostPid
inner join users
on userPost.userPostUid = users.userId;

SELECT users.userId AS userId, users.userDate AS userDate, post.userName AS authorName, post.postTitle AS postTitle, post.postContent AS postContent, post.postDate AS postDate
from (select * from post inner join users on post.userPostUid = users.userId) as post
inner join userPost
on post.postId = userPost.userPostPid
inner join users
on userPost.userPostUid = users.userId
where users.userId = 8;

SELECT users.userId AS userId, users.userDate AS userDate, users.userName AS userName, post.postTitle AS postTitle, post.postContent AS postContent, post.postDate AS postDate
from post 
inner join userPost
on post.postId = userPost.userPostPid
inner join users
on userPost.userPostUid = users.userId
where users.userId = 1;

insert into users (userEmail, userName, userPassword, userDate) 
values
('carro@gmail.com', 'carro', 'carro', '2017-03-01'),
('hawe@gmail.com', 'hawe', 'hawe', '2011-08-22'),
('frumppen@gmail.com', 'frumppen', 'frumppen', '2014-11-11'),
('mandy@gmail.com', 'mandypandy', 'mandy', '2018-01-06');

insert into post (postTitle, postContent, postDate, userPostUid) 
values
('Call Of Duty Warzone Review', 'The latest Call of Duty from Infinity Ward shipped without an answer to Black Ops 4’s Blackout, but it has since been supplemented by Warzone--a completely standalone battle royale built off of the backbone of Modern Warfare. Not only is it a smarter way to ensure its not tied to each annual release in the series, but Warzone gives the series its own identity within the competitive genre.', '2013-02-12', 4),
('The Pedestrian Review - Walk Before You Run', 'It’s human nature to be curious about what seemingly mundane and inanimate things get up to while we’re not looking. Such thinking spawned mythos like fairies in people’s gardens, borrowers, and the Toy Story saga, and now we come to street signs. What do those little human figures get up to when no-one is around? If The Pedestrian is to be believed, the answer is 2D platforming, solving lots and lots of puzzles, and taking control of electrical devices in an attempt to escape their confines.', '2017-12-24', 5),
('Destiny 2 Shadowkeep Review - Moons Haunted', 'Its hard to overstate how much better Destiny 2 has become in the last year. The Forsaken expansion and the smaller, more frequent updates that followed added variety in activities that meant you could earn rewards while playing your favorite content, as well as a huge amount of new, weird lore to sift through, and secrets to uncover. Its not a stretch to say Destiny as a franchise was the best its ever been in the second year of Destiny 2.', '2019-05-06', '3'),
('Final Fantasy 7 Remake Review - First Class', 'In the opening of Final Fantasy VII, Cloud Strife, a mercenary and former member of an elite private military group called SOLDIER, takes on a job with an eco-terrorist cell named Avalanche. Their mission is to blow up a reactor that siphons Mako, the lifeblood of the planet, and uses it to power the sprawling industrial metropolis Midgar. The group infiltrates, braves resistance from Shinra Electric Companys forces, and sets off an explosion that renders the reactor inoperable.', '2017-03-01', 6);


drop table userPost;
drop table post;
drop table users;
drop table images;

delete from users where userId=4;

SELECT userName
FROM   users
LEFT JOIN userPost ON (post.postId = 'postId')
LEFT JOIN users ON (user.userId = 'userId' );

select users.userId, users.userEmail, users.userName, post.postTitle, post.postContent
from post 
inner join userPost
on post.postId = userPost.userPostPid
inner join users
on userPost.userPostUid = users.userId;

SELECT userName, userDate, postDate, postTitle, postContent
from post
inner join users
on userId = post.userPostUid
ORDER BY postDate ASC;