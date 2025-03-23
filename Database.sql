DROP TABLE IF EXISTS contacts;
DROP TABLE IF EXISTS admins;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS videos;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS lectures;
DROP TABLE IF EXISTS blogs;

-- Create the lectures table
CREATE TABLE lectures (
    id INT AUTO_INCREMENT PRIMARY KEY,         
    title VARCHAR(255) NOT NULL,               
    content TEXT NOT NULL,                     
    user_id INT,                               
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create the questions table
CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,        
    lecture_id INT NOT NULL,                   
    question_text TEXT NOT NULL,                       
    answer1 TEXT NOT NULL,                             
    answer2 TEXT NOT NULL,                             
    answer3 TEXT NOT NULL,                             
    answer4 TEXT NOT NULL,                             
    correct_answer ENUM('1', '2', '3', '4') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (lecture_id) REFERENCES lectures(id) ON DELETE CASCADE
);

-- Create the videos table
CREATE TABLE videos (
    id INT AUTO_INCREMENT PRIMARY KEY,         
    video_url VARCHAR(255) NOT NULL,                    
    lecture_id INT NOT NULL,                            
    description TEXT NOT NULL,                          
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  
    FOREIGN KEY (lecture_id) REFERENCES lectures(id) ON DELETE CASCADE  
);

-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,         
    username VARCHAR(255) NOT NULL,            
    email VARCHAR(255) NOT NULL UNIQUE,              
    password_hash VARCHAR(255) NOT NULL,       
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  
);

-- Create the admins table
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,         
    username VARCHAR(255) NOT NULL,            
    email VARCHAR(255) NOT NULL UNIQUE,               
    password_hash VARCHAR(255) NOT NULL,       
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  
);

-- Create the contacts table
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE blogs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255)  NOT NULL,
    descriptions VARCHAR(512) NOT NULL,
    category VARCHAR(255) NULL,
    content LONGTEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admins (username, email, password_hash)
VALUES ('admin', 'admin@example.com', '$2y$10$k9xssByQWpuRyDtsk/QTgOsE1t3xd.QwSnErOdY4lD31icqVeSwF2')