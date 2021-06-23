-- Permissions Table
CREATE TABLE permissions (
  perm_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  perm_name varchar(25) UNIQUE NOT NULL COLLATE utf8mb4_bin,
  perm_description varchar(255),
  PRIMARY KEY (perm_id)
);

-- Roles Table
CREATE TABLE roles (
  role_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  role_name varchar(255) UNIQUE NOT NULL COLLATE utf8mb4_bin,
  PRIMARY KEY (role_id)
);

-- Relationship between Roles and permissions
CREATE TABLE roles_permissions (
  role_id INT UNSIGNED NOT NULL,
  perm_id INT UNSIGNED NOT NULL,
  PRIMARY KEY (role_id, perm_id),
  CONSTRAINT `fk_role_id`
    FOREIGN KEY (role_id) REFERENCES roles (role_id)
    ON DELETE CASCADE
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_perm_id`
    FOREIGN KEY (perm_id) REFERENCES permissions (perm_id)
    ON UPDATE RESTRICT,
  UNIQUE (role_id, perm_id)
);

-- Inserting Default Permissions
INSERT INTO permissions (perm_name, perm_description)
VALUES
  ("LOGIN", "The User can Login"),
  ("MANAGE_POSTS", "Create, Update or Delete Posts"),
  ("MANAGE_USERS", "Ban, Edit or Delete Users")
;

INSERT INTO roles (role_name)
VALUES
  ("USER"), ("BANNED"), ("EDITOR"), ("ADMIN")
;

INSERT INTO roles_permissions (role_id, perm_id) 
VALUES
  (1, 1), (3, 1), (3, 2), (4,1), (4,2), (4,3)
;  

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
);


CREATE TABLE posts (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title VARCHAR(100) NOT NULL,
  author_id BIGINT UNSIGNED NOT NULL,
  excerpt VARCHAR(255) NOT NULL,
  content MEDIUMTEXT NOT NULL,
  publish_date TIMESTAMP NOT NULL DEFAULT NOW(),
  PRIMARY KEY (id),
  CONSTRAINT `fk_post_author`
    FOREIGN KEY (author_id) REFERENCES users (id)
);

CREATE TABLE comments (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  post_id INT UNSIGNED NOT NULL,
  user_id BIGINT UNSIGNED NOT NULL,
  comment VARCHAR(255) NOT NULL,
  created TIMESTAMP NOT NULL DEFAULT NOW(),
  PRIMARY KEY (id),
  CONSTRAINT `fk_comment_post_id`
    FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE,
  CONSTRAINT `fk_comment_user_id`
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

CREATE TABLE uploads (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  file_name VARCHAR(255) NOT NULL,
  uploader_id BIGINT UNSIGNED NOT NULL,
  created TIMESTAMP NOT NULL DEFAULT NOW(),
  PRIMARY KEY (id),
  CONSTRAINT `fk_uploader`
    FOREIGN KEY (uploader_id) REFERENCES users (id)
);

CREATE TABLE game_versions(
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  platform_name VARCHAR(20) NOT NULL,
  version_number INT UNSIGNED NOT NULL,
  upload_id INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT `fk_game_versions_uploads`
    FOREIGN KEY (upload_id) REFERENCES uploads (id) ON DELETE CASCADE,
  UNIQUE (platform_name, version_number)
);

CREATE TABLE active_versions(
  id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  version_id INT UNSIGNED NOT NULL,
  platform_name VARCHAR(20) NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT `fk_active_version_id`
    FOREIGN KEY (version_id) REFERENCES game_versions (id) ON DELETE CASCADE
)