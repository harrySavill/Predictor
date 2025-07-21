CREATE TABLE predictions (
    prediction_id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    match_id INT(11) NOT NULL,
    predicted_home_score INT(11) DEFAULT NULL,
    predicted_away_score INT(11) DEFAULT NULL,
    points_earned INT(11) DEFAULT 0,
    PRIMARY KEY (prediction_id),
    UNIQUE KEY unique_user_match (user_id, match_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (match_id) REFERENCES matches(match_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


