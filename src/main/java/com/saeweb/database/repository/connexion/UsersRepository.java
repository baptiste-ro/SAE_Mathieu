package com.saeweb.database.repository.connexion;

import com.saeweb.database.entity.connection.Users;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface UsersRepository extends JpaRepository<Users, Integer> {
    @Query("SELECT u FROM Users u WHERE u.username = :value OR u.email = :value")
    List<Users> findByUsernameOrEmail(@Param(value = "value") String username);
}