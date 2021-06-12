CREATE TABLE users (
  id SERIAL,
  username VARCHAR(20) NOT NULL UNIQUE COLLATE utf8mb4_bin,
  email VARCHAR(320) NOT NULL UNIQUE COLLATE utf8mb4_general_ci,
  birthdate DATE NOT NULL,
  password VARCHAR(60) NOT NULL COLLATE utf8mb4_bin
)