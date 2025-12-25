package com.saeweb.controller.connexion;

import com.saeweb.database.entity.users.Users;
import com.saeweb.dto.connection.ConnectionUser;
import com.saeweb.service.connexion.ConnectionServiceImpl;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.core.io.ClassPathResource;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/connection")
public class ConnectionController {

    @Autowired
    private final ConnectionServiceImpl connectionService;

    public ConnectionController(ConnectionServiceImpl connectionService) {
        this.connectionService = connectionService;
    }

    @GetMapping("/is-connected")
    public boolean isConnected() {
        return true;
    }

    @PostMapping("/connection")
    public String connection(@RequestBody ConnectionUser user, HttpSession session) {
        Users currentUser = connectionService.getConnection(user);
        if (!currentUser.isEmpty()) {
            session.setAttribute("currentUser", currentUser);

            System.out.println(session.getAttribute("currentUser"));

            return "Accueil.jsp";
        } else {
            session.setAttribute("login", false);
            return "Connexion.jsp";
        }
    }

    @GetMapping("/disconnect")
    public String disconnection(HttpSession session) {
        ClassPathResource cp = new ClassPathResource(".");
        System.out.println("Current path : " + cp.getPath() + "\n");
        session.removeAttribute("currentUser");
        return "Accueil.jsp";
    }
}
