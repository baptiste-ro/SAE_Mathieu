package com.saeweb.dto.index_page.text_list;

import com.fasterxml.jackson.annotation.JsonProperty;
import org.json.JSONObject;
import org.w3c.dom.Text;

import java.util.List;

public class TextList {
    @JsonProperty("slogan")
    String slogan;

    @JsonProperty("description")
    List<String> description;

    @JsonProperty("services")
    List<Services> services;

    @JsonProperty("contact")
    String contact;

    public TextList() {}

    public String getSlogan() {
        return slogan;
    }

    public void setSlogan(String slogan) {
        this.slogan = slogan;
    }

    public List<String> getDescription() {
        return description;
    }

    public void setDescription(List<String> description) {
        this.description = description;
    }

    public List<Services> getServices() {
        return services;
    }

    public void setServices(List<Services> services) {
        this.services = services;
    }

    public String getContact() {
        return contact;
    }

    public void setContact(String contact) {
        this.contact = contact;
    }
}
