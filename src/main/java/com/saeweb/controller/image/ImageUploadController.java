package com.saeweb.controller.image;

import com.saeweb.service.profil.ProfileService;
import com.saeweb.service.profil.profil_picture.ProfilePictureServiceImpl;
import jakarta.servlet.ServletException;
import jakarta.servlet.http.*;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.core.io.ClassPathResource;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.io.File;
import java.io.IOException;
import java.util.UUID;

@RestController
@RequestMapping("/image")
public class ImageUploadController extends HttpServlet {
    @Autowired
    private ProfilePictureServiceImpl pfpService;

    @Autowired
    private ProfileService profileService;

    @PostMapping("/upload")
    public void doPost(HttpServletRequest request, HttpServletResponse response, HttpSession session)
            throws IOException, ServletException {
        String pfpID = pfpService.uploadImage(request, response);
        profileService.modifyProfilePicture(pfpID, session);
        response.getWriter().println("\nThe file was uploaded successfully\n");
        response.sendRedirect("/sae/Profil.jsp");
    }
}