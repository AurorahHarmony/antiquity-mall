CREATE TABLE permissions (
  perm_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  perm_name varchar(25) UNIQUE NOT NULL COLLATE utf8mb4_bin,
  perm_description varchar(255),
  PRIMARY KEY (perm_id)
);

CREATE TABLE roles (
  role_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  role_name varchar(255) UNIQUE NOT NULL COLLATE utf8mb4_bin,
  PRIMARY KEY (role_id)
);

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
    ON UPDATE RESTRICT
)