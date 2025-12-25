package com.saeweb.service.profil;

import com.saeweb.database.entity.users.Users;
import com.saeweb.dto.profil.PasswordVerificationUser;
import com.saeweb.dto.profil.ProfileUser;
import jakarta.servlet.http.HttpSession;

public interface ProfileService {
    Users modifyInformations(ProfileUser user);

    boolean verifyPassword(PasswordVerificationUser user);

    void modifyProfilePicture(String pictureID, HttpSession session);

    String getProfilePictureID(HttpSession session);
}