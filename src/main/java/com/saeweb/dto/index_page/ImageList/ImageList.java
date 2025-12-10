package com.saeweb.dto.index_page.ImageList;

import java.util.Map;

public class ImageList {
    private Map<String,String> images;

    public Map<String,String> getImages() {
        return images;
    }

    public void setImages(Map<String,String> images) {
        this.images = images;
    }

    public ImageList() {
    }

    public ImageList(Map<String,String> images) {
        this.images = images;
    }
}
