package com.saeweb.controller.profil;

import com.saeweb.database.entity.users.Users;
import com.saeweb.dto.profil.PasswordVerificationUser;
import com.saeweb.dto.profil.ProfileUser;
import com.saeweb.service.profil.ProfileServiceImpl;
import jakarta.servlet.http.HttpSession;
import jakarta.validation.Valid;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/profil")
public class ProfileController {
    @Autowired
    private ProfileServiceImpl service;

    @PostMapping("verify-password")
    public boolean verifyPassword(@RequestBody PasswordVerificationUser user) {
        return service.verifyPassword(user);
    }

    @PostMapping("modify-information")
    public Users modifyInformations(@RequestBody @Valid ProfileUser user) {
        return service.modifyInformations(user);
    }

    @GetMapping("get-profil-picture")
    public String getProfilePictureID(HttpSession session) {
        return service.getProfilePictureID(session);
    }
}
