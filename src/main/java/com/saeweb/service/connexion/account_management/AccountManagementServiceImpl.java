package com.saeweb.service.connexion.account_management;

import com.saeweb.database.entity.connection.Users;
import com.saeweb.database.repository.user.UsersRepository;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import static com.saeweb.util.text.TextSanitizer.sanitize;

@Service
public class AccountManagementServiceImpl implements AccountManagementService{
    private static final Logger logger = LoggerFactory.getLogger(AccountManagementServiceImpl.class);

    @Autowired
    private final UsersRepository usersRepository;

    public AccountManagementServiceImpl(UsersRepository usersRepository) {
        this.usersRepository = usersRepository;
    }

    @Override
    public Boolean AccountCreation(Users user) {
        try {
            usersRepository.save(user);
            logger.info("User saved : {}", sanitize(user.toString()));
        } catch (Exception e) {
            logger.error(e.getMessage());
            return false;
        }
        return true;
    }
}
