package com.saeweb.service.profil;

import com.saeweb.database.entity.connection.Users;
import com.saeweb.dto.profil.PasswordVerificationUser;
import com.saeweb.dto.profil.ProfileUser;

public interface ProfileService {
    Users modifyInformations(ProfileUser user);

    boolean verifyPassword(PasswordVerificationUser user);
}