-- Active: 1702304537509@@127.0.0.1@3306
CREATE DATABASE wiki;

USE wiki;

CREATE TABLE `user` (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY email (email)
);

ALTER TABLE user ADD role varchar(255) NOT NULL DEFAULT 'user';

SELECT * FROM user;

CREATE TABLE wikis (
    id int(11) NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    body text NOT NULL,
    author_id int(11) NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY author_id (author_id),
    CONSTRAINT wikis_ibfk_1 FOREIGN KEY (author_id) REFERENCES user (id)
    );

    ALTER TABLE wikis ADD category varchar(255) NOT NULL DEFAULT 'others';

    CREATE TABLE tags (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        PRIMARY KEY (id)
    );

    ALTER TABLE wikis ADD tags VARCHAR(255);

    CREATE TABLE category (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    );