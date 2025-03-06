-- Create the lectures table
CREATE TABLE lectures (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- Unique identifier for each lecture
    title VARCHAR(255) NOT NULL,               -- Title of the lecture
    content TEXT NOT NULL,                     -- The content or body of the lecture
    user_id INT,                               -- Author (assuming you have a users table for authorship)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Timestamp for when the lecture was created
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Automatically updates when edited
);

-- Create the questions table
CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,        -- Unique identifier for each question
    lecture_id INT,                           -- Link the question to a specific lecture
    question_text TEXT,                       -- The question text
    answer1 TEXT,                             -- First answer option
    answer2 TEXT,                             -- Second answer option
    answer3 TEXT,                             -- Third answer option
    answer4 TEXT,                             -- Fourth answer option
    correct_answer ENUM('1', '2', '3', '4'), -- Stores the correct answer (1-4)
    FOREIGN KEY (lecture_id) REFERENCES lectures(id) ON DELETE CASCADE  -- Link to the lectures table
);

-- Create the videos table
CREATE TABLE videos (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- Unique identifier for each video
    video_url VARCHAR(255),                    -- URL to the video
    lecture_id INT,                            -- Link the video to a specific lecture
    description TEXT,                          -- Description of the video
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Timestamp for when the video was created
    FOREIGN KEY (lecture_id) REFERENCES lectures(id) ON DELETE SET NULL  -- Link to the lectures table
);

-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- Unique user identifier
    username VARCHAR(100) NOT NULL,            -- User's username
    email VARCHAR(100) NOT NULL,               -- User's email
    password_hash VARCHAR(255) NOT NULL,       -- Hashed password
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  -- When the user was created
);

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- Unique user identifier
    username VARCHAR(100) NOT NULL,            -- User's username
    email VARCHAR(100) NOT NULL,               -- User's email
    password_hash VARCHAR(255) NOT NULL,       -- Hashed password
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  -- When the user was created
);