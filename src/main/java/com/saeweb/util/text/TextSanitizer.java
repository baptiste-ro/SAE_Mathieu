package com.saeweb.util.text;

public class TextSanitizer {
    public static String sanitize(String input) {
        if (input == null || input.isBlank()) {
            return "";
        }

        return input.replaceAll("[<>]", "");
    }
}