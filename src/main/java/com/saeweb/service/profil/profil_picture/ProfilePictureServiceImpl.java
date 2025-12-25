package com.saeweb.service.profil.profil_picture;

import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import jakarta.servlet.http.Part;
import org.springframework.stereotype.Service;

import java.io.File;
import java.io.IOException;

import static com.saeweb.util.image.ImageUploadUtil.getExtension;
import static com.saeweb.util.image.ImageUploadUtil.getNewID;

@Service
public class ProfilePictureServiceImpl implements ProfilePictureService {
    @Override
    public String uploadImage(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        Part filePart = request.getPart("file");
        File file = new File("src/main/webapp/img/uploads");
        String fileName = getNewID(file) + getExtension(filePart.getSubmittedFileName());
        String uploadDir = file.getAbsolutePath();
        for (Part part : request.getParts()) {
            if (part.getSubmittedFileName() != null && !part.getSubmittedFileName().isEmpty()) {
                part.write(uploadDir + File.separator + fileName);
            }
        }
        return fileName;
    }
}
