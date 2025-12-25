package com.saeweb.service.connexion;

import com.saeweb.database.entity.users.Users;
import com.saeweb.database.repository.user.UsersRepository;
import com.saeweb.dto.connection.ConnectionUser;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class ConnectionServiceImpl implements ConnectionService {
    private static final Logger logger = LoggerFactory.getLogger(ConnectionServiceImpl.class);

    @Autowired
    private final UsersRepository usersRepository;

    private final PasswordEncoder passwordEncoder = new BCryptPasswordEncoder();

    public ConnectionServiceImpl(UsersRepository usersRepository) {
        this.usersRepository = usersRepository;
    }

    @Override
    public Users getConnection(ConnectionUser connectionUser) {
        try {
            System.out.println(connectionUser);
            List<Users> usersList = usersRepository.findByEmail(connectionUser.getEmail());
            for (Users u : usersList) {
                logger.info(u.toString());
                if (passwordEncoder.matches(connectionUser.getPassword(), u.getPassword())) {
                    logger.info("\nConnection granted to user : {}", u);
                    return u;
                };
            }
            logger.info("\nThe connection cannot be granted. Username or password is not correct.\nList of the users found : {}", usersList);
            return new Users();
        } catch (Exception e) {
            logger.error("An error occured : {}", e.getMessage());
            return new Users();
        }
    }
}
