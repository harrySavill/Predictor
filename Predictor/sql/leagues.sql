CREATE TABLE Leagues (
    league_id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(25) NOT NULL,
    join_code VARCHAR(8) NOT NULL UNIQUE,
    created_by INT(11) NOT NULL,
    PRIMARY KEY (league_id)
)
    ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;