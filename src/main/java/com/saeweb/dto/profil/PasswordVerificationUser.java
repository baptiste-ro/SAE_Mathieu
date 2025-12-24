package com.saeweb.dto.profil;

public class PasswordVerificationUser {
    private String email;
    private String password;

    public PasswordVerificationUser(String email, String password) {
        this.email = email;
        this.password = password;
    }

    public PasswordVerificationUser() {
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String toString() {
        return "{\n    email: " + this.email + "\n    " + this.password + "\n}";
    }
}
