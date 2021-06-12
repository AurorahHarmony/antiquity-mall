CREATE TABLE users (
  id SERIAL,
  username VARCHAR(15) NOT NULL UNIQUE,
  -- password BINARY(60) NOT NULL
  password VARCHAR(255) NOT NULL
)