package com.saeweb.util;

import com.saeweb.dto.index_page.ImageList.ImageList;
import org.json.simple.JSONObject;
import org.json.simple.parser.JSONParser;
import org.springframework.core.io.ClassPathResource;

import java.io.FileReader;
import java.io.IOException;
import java.util.HashMap;
import java.util.Map;

public class GlobalValuesLoader {
    public static ImageList loadImageFromResources() {
        Map<String,String> records = new HashMap<>();

        ClassPathResource resource = new ClassPathResource("global/global_values.json");
        JSONParser parser = new JSONParser();
        try {
            JSONObject obj = (JSONObject) parser.parse(new FileReader(resource.getFile()));
            for (Object key : obj.keySet()) {
                records.put(key.toString(), obj.get(key).toString());
            }
        } catch (IOException | org.json.simple.parser.ParseException e) {
            throw new RuntimeException(e);
        }

        return new ImageList(records);
    }
}
