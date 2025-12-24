package com.saeweb.controller.connexion.account_management;

import com.saeweb.database.entity.connection.Users;
import com.saeweb.service.connexion.account_management.AccountManagementServiceImpl;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/connexion/account_management")
public class AccountManagementController {

    @Autowired
    private AccountManagementServiceImpl accountManagementService;

    @PostMapping("/creation")
    public Boolean AccountCreation(@RequestBody Users user) {
        return accountManagementService.AccountCreation(user);
    }
}
