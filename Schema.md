CREATE TABLE game_dev (
    game_dev_id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    date_of_birth VARCHAR(50),
    specialization TEXT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
//use this: ALTER TABLE game_project
ADD PRIMARY KEY (game_project_id);

CREATE TABLE game_project (
    game_project_id VARCHAR(50), 
    project_name VARCHAR(50),
    technologies_used TEXT,
    game_dev_id INT(50),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

//use this: ALTER TABLE game_project
ADD CONSTRAINT fk_game_project_developer
FOREIGN KEY (game_dev_id) REFERENCES game_dev(game_dev_id)
ON DELETE CASCADE
ON UPDATE CASCADE;
