CREATE TABLE User_Leagues (
    user_id INT(11) NOT NULL,
    league_id INT(11) NOT NULL,
    PRIMARY KEY (user_id, league_id),
    FOREIGN KEY (user_id) REFERENCES USERS(user_id) ON DELETE CASCADE,
    FOREIGN KEY (league_id) REFERENCES Leagues(league_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;