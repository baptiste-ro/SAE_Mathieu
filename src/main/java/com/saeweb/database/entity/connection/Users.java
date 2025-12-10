package com.saeweb.database.entity.connection;

import jakarta.persistence.*;
import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;

@Entity
@AllArgsConstructor
@NoArgsConstructor
@Getter
@Setter
public class Users {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "id")
    private Integer ID;

    @Column(name = "username", length = 50)
    private String username;

    @Column(name = "password", length = 200)
    private String password;

    @Column(name = "email", length = 50)
    private String email;

    @Column(name = "admin")
    private Boolean admin = false;

    public Integer getID() {
        return ID;
    }

    public String getUsername() {
        return username;
    }

    public String getEmail() {
        return email;
    }

    public Boolean getAdmin() {
        return admin;
    }

    public void setAdmin(Boolean admin) {
        this.admin = admin;
    }

    public void setPassword(String password) {
        PasswordEncoder passwordEncoder = new BCryptPasswordEncoder();
        this.password = passwordEncoder.encode(password);
    }

    public String getPassword() {
        return this.password;
    }

    public boolean isEmpty() {
        return this.username == null && this.password == null && this.email == null;
    }

    @Override
    public String toString() {
        return "{\n    [Username : " + username + "]\n    [Password: " + password + "]\n    [Email: " + email + "]\n    [IsAdmin : " + admin + "]\n}";
    }

    @Override
    public boolean equals(Object obj) {
        if (obj == null) {
            return false;
        } else {
            try {
                Users user = (Users) obj;

                return this.ID.equals(user.getID()) &&
                        this.username.equals(user.getUsername()) &&
                        this.password.equals(user.getPassword()) &&
                        this.email.equals(user.getEmail()) &&
                        this.admin.equals(user.getAdmin());
            } catch (Exception e) {
                System.out.println("Error happened : " + e.getMessage());
                return false;
            }
        }
    }
}
