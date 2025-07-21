CREATE TABLE matches (
    match_id INT(11) NOT NULL AUTO_INCREMENT,
    gameweek INT(11) NOT NULL,
    home_team VARCHAR(100) NOT NULL,
    away_team VARCHAR(100) NOT NULL,
    home_score INT(11) DEFAULT NULL,
    away_score INT(11) DEFAULT NULL,
    home_league_position INT(11) DEFAULT NULL,
    away_league_position INT(11) DEFAULT NULL,
    home_league_form VARCHAR(10) DEFAULT NULL,
    away_league_form VARCHAR(10) DEFAULT NULL,
    match_date DATETIME DEFAULT NULL,
    league_code VARCHAR(10) DEFAULT NULL,
    completed BOOLEAN DEFAULT false,
    PRIMARY KEY (match_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
