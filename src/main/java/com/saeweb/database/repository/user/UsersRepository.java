package com.saeweb.database.repository.user;

import com.saeweb.database.entity.connection.Users;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface UsersRepository extends JpaRepository<Users, Integer> {
    @Query("SELECT u FROM Users u WHERE u.email = :value")
    List<Users> findByEmail(@Param(value = "value") String email);

    @Query("SELECT u FROM Users u WHERE u.email = :e AND u.password = :p")
    List<Users> findByEmailAndPassword(@Param(value = "e") String email, @Param(value = "p") String password);
}