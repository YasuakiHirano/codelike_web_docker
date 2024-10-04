CREATE DATABASE IF NOT EXISTS test_db;

GRANT ALL ON *.* TO root@'%';

USE test_db;

DROP TABLE IF EXISTS users;

CREATE TABLE users
(
  id integer,
  name VARCHAR(40)
);
