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

    @Column(name = "first_name", length = 50)
    private String firstName;

    @Column(name = "last_name", length = 50)
    private String lastName;

    @Column(name = "address", length = 50)
    private String address;

    @Column(name = "password", length = 200)
    private String password;

    @Column(name = "email", length = 50)
    private String email;

    @Column(name = "role", length = 50)
    private String role;

    @Column(name = "admin")
    private Boolean admin = false;

    public Integer getID() {
        return ID;
    }

    public String getFirstName() {
        return firstName;
    }

    public void setFirstName(String firstName) {
        this.firstName = firstName;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
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

    public String getLastName() {
        return lastName;
    }

    public void setLastName(String lastName) {
        this.lastName = lastName;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getRole() {
        return role;
    }

    public void setRole(String role) {
        this.role = role;
    }

    public void changeInformations(String firstName, String lastName, String password, String address) {
        this.firstName = firstName.isEmpty() ? this.firstName : firstName;
        this.lastName = lastName.isEmpty() ? this.lastName : lastName;
        this.address = address.isEmpty() ? this.address : address;
        if (!password.isEmpty()) {setPassword(password);}
    }

    public boolean isEmpty() {
        return this.firstName == null && this.password == null && this.email == null;
    }

    @Override
    public String toString() {
        return "{\n    [First name : " + firstName + "]\n    [Last name : " + lastName + "]\\n    [Password: " + password + "]\n    [Email: " + email + "]\n    [Adresse : " + address + "]\\n    [Role : " + role + "]\\n    [IsAdmin : " + admin + "]\n}";
    }

    @Override
    public boolean equals(Object obj) {
        if (obj == null) {
            return false;
        } else {
            try {
                Users user = (Users) obj;

                return this.ID.equals(user.getID()) &&
                        this.firstName.equals(user.getFirstName()) &&
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
