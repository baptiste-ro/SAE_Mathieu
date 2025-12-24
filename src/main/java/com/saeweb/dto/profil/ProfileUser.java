package com.saeweb.dto.profil;

public class ProfileUser {
    private String firstName;
    private String lastName;
    private String email;
    private String address;
    private String password;

    public ProfileUser() {
    }

    public ProfileUser(String firstName, String nom, String email, String address, String password) {
        this.firstName = firstName;
        this.lastName = nom;
        this.email = email;
        this.address = address;
        this.password = password;
    }

    public String getFirstName() {
        return firstName;
    }

    public void setFirstName(String firstName) {
        this.firstName = firstName;
    }

    public String getLastName() {
        return lastName;
    }

    public void setLastName(String lastName) {
        this.lastName = lastName;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    @Override
    public String toString() {
        return "{\n    [First name : " + firstName + "]\n    [Last name : " + lastName + "]\\n    [Password: " + password + "]\n    [Email: " + email + "]\n    [Adresse : " + address + "] \n}";
    }
}
