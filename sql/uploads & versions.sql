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