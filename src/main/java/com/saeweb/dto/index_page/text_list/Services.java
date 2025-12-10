package com.saeweb.dto.index_page.text_list;

import com.fasterxml.jackson.annotation.JsonProperty;

public class Services {
    @JsonProperty("title")
    String title;

    @JsonProperty("description")
    String description;

    public Services() {}

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }
}
