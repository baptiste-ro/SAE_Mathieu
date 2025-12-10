package com.saeweb.controller.connexion.account_management;

import com.saeweb.database.entity.connection.Users;
import com.saeweb.service.connexion.account_management.AccountManagementService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/connexion/account_management")
public class AccountManagementController {

    @Autowired
    private final AccountManagementService accountManagementService;

    public AccountManagementController(AccountManagementService accountManagementService) {
        this.accountManagementService = accountManagementService;
    }

    @PostMapping("/creation")
    public Boolean AccountCreation(@RequestBody Users user) {
        return accountManagementService.AccountCreation(user);
    }
}
