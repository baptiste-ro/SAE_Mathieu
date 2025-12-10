package com.saeweb.service.connexion;

import com.saeweb.database.entity.connection.Users;
import com.saeweb.dto.connection.ConnectionUser;

public interface ConnectionService {
    public Users getConnection(ConnectionUser user);
}
