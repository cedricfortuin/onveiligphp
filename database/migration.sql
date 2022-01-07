create table posts
(
    id         integer not null
        primary key autoincrement,
    user_id    integer not null references users(id),
    title      varchar not null,
    body       text    not null,
    image      longtext,
    created_at datetime,
    updated_at datetime
);

create unique index posts_id_unique
    on posts (id);

create table replies
(
    id         integer not null
        primary key autoincrement,
    post_id    integer not null references posts(id),
    user_id    integer not null references users(id),
    reply      text    not null,
    likes      integer default '0' not null,
    created_at datetime
);

create table users
(
    id                integer not null
        primary key autoincrement,
    name              varchar not null,
    email             varchar not null,
    password          varchar not null,
    TwoFA_secret      varchar,
    created_at        datetime
);

create unique index users_email_unique
    on users (email);

