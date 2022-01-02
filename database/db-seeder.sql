-- POPULATE THE USERS TABLE --
insert into users(name, email, password, created_at) values ('Cedric Fortuin', 'cedric@example.com', 'password123', '');
insert into users(name, email, password, created_at) values ('Nikki van Braam', 'nikki@example.com', 'password456', '');
insert into users(name, email, password, created_at) values ('Jayden Fokkink', 'jayden@example.com', 'password789', '');

-- POPULATE THE POSTS TABLE --
insert into posts(title, body, user_id, created_at) values ('First Post', 'This is the first post', 1, '');
insert into posts(title, body, user_id, created_at) values ('Second Post', 'This is the second post', 3, '');
insert into posts(title, body, user_id, created_at) values ('Third Post', 'This is the third post', 2, '');

-- POPULATE THE REPLIES TABLE --
insert into replies(reply, post_id, user_id, created_at) values ('This is the first reply', 1, 2, '');
insert into replies(reply, post_id, user_id, created_at) values ('This is the first reply', 2, 1, '');
insert into replies(reply, post_id, user_id, created_at) values ('This is the first reply', 1, 3, '');
insert into replies(reply, post_id, user_id, created_at) values ('This is the first reply', 2, 3, '');
