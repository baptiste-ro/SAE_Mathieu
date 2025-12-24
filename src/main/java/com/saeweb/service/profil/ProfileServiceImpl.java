package com.saeweb.service.profil;

import com.saeweb.database.entity.connection.Users;
import com.saeweb.database.repository.user.UsersRepository;
import com.saeweb.dto.profil.PasswordVerificationUser;
import com.saeweb.dto.profil.ProfileUser;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

@Service
public class ProfileServiceImpl implements ProfileService {
    @Autowired
    private UsersRepository repository;

    private PasswordEncoder passwordEncoder = new BCryptPasswordEncoder();

    @Override
    public Users modifyInformations(ProfileUser user) {
        System.out.println("Profile User : " + user);
        Users u = repository.findByEmail(user.getEmail()).get(0);
        System.out.println("User found : " + u);
        u.changeInformations(user.getFirstName(), user.getLastName(), user.getPassword(), user.getAddress());
        repository.save(u);
        return u;
    }

    @Override
    public boolean verifyPassword(PasswordVerificationUser user) {
        System.out.println("Verification user : " + user);
        Users u = repository.findByEmail(user.getEmail()).get(0);
        return passwordEncoder.matches(user.getPassword(), u.getPassword());
    }
}
