package com.saeweb.util.image;

import java.io.File;
import java.util.Objects;
import java.util.UUID;

public class ImageUploadUtil {
    public static String getNewID(File file) {
        return UUID.randomUUID().toString() + System.currentTimeMillis();
    }

    public static String getExtension(String fileName) {
        String[] split = fileName.split("\\.");
        return "." + split[split.length-1];
    }
}
