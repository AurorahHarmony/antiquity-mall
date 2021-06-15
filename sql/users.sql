CREATE TABLE users (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(20) NOT NULL UNIQUE COLLATE utf8mb4_bin,
  email VARCHAR(320) NOT NULL UNIQUE COLLATE utf8mb4_general_ci,
  birthdate DATE NOT NULL,
  password VARCHAR(60) NOT NULL COLLATE utf8mb4_bin,
  role_id INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT `fk_user_role_id`
    FOREIGN KEY (role_id) REFERENCES roles (role_id)
)