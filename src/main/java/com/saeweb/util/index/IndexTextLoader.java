package com.saeweb.util.index;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.saeweb.dto.index_page.text_list.TextList;
import org.springframework.core.io.ClassPathResource;

import java.io.IOException;

public class IndexTextLoader {
    public static TextList loadTextFromResources(String path) {
        ClassPathResource resource = new ClassPathResource(path);
        ObjectMapper objectMapper = new ObjectMapper();

        try {
            return objectMapper.readValue(resource.getFile(), TextList.class);
        } catch (IOException e) {
            return new TextList();
        }
    }
}
