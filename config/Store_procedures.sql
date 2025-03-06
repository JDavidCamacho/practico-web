DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateUser`(
    IN p_username VARCHAR(255),
    IN p_password VARCHAR(255)
)
BEGIN
    INSERT INTO usuario (username, password)
    VALUES (p_username, SHA2(p_password, 256)); -- SHA2 con 256 bits para cifrar la contraseña
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteUser`(
    IN p_id INT
)
BEGIN
    DELETE FROM usuario WHERE id = p_id;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `FindUserById`(
    IN p_id INT
)
BEGIN
    SELECT * FROM usuario WHERE id = p_id;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllUsers`()
BEGIN
    SELECT * FROM usuario;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUserByUsername`(IN `p_username` VARCHAR(255))
BEGIN
    SELECT * 
    FROM usuario 
    WHERE username = p_username;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateUser`(
    IN p_id INT,
    IN p_username VARCHAR(255),
    IN p_password VARCHAR(255)
)
BEGIN
    UPDATE usuario
    SET username = p_username, password = p_password
    WHERE id = p_id;
END$$
DELIMITER ;
