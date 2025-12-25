package com.saeweb.service.profil.profil_picture;

import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.IOException;

public interface ProfilePictureService {
    String uploadImage(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException;
}
