create table posts
(
    id         integer not null
        primary key autoincrement,
    user_id    integer not null,
    title      varchar not null,
    slug       varchar not null,
    body       text    not null,
    created_at datetime,
    updated_at datetime
);

create unique index posts_slug_unique
    on posts (slug);

create table replies
(
    id         integer not null
        primary key autoincrement,
    post_id    integer not null,
    user_id    integer not null,
    reply       text    not null,
    likes      integer default '0' not null,
    created_at datetime,
    updated_at datetime
);

create table users
(
    id                integer not null
        primary key autoincrement,
    name              varchar not null,
    email             varchar not null,
    email_verified_at datetime,
    password          varchar not null,
    remember_token    varchar,
    created_at        datetime,
    updated_at        datetime
);

create unique index users_email_unique
    on users (email);

