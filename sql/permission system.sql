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
  ("MANAGE_USERS", "Ban, Edit or Delete Users"),
  ("ACCESS_MANAGER", "Should the user be able to access the management page?"),
  ("MANAGE_ROLES", "Can the user alter role permissions?"),
  ("MANAGE_DOWNLOADS", "Update and Change the available version downloads"),
  ("COMMENT", "Can the User post comments on news articles")
;

INSERT INTO roles (role_name)
VALUES
  ("USER"), ("BANNED"), ("EDITOR"), ("ADMIN")
;

INSERT INTO roles_permissions (role_id, perm_id) 
VALUES
  (1, 1), (3, 1), (3, 2), (4,1), (4,2), (4,3)
;  