them vao bangb posts 
ALTER TABLE posts ADD featured TINYINT(1) DEFAULT 0;
ALTER TABLE posts ADD views INT(11) DEFAULT 0 AFTER featured;
