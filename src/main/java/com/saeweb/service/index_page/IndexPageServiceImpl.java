package com.saeweb.service.index_page;

import com.saeweb.dto.index_page.ImageList.ImageList;
import com.saeweb.dto.index_page.IndexHeader.IndexHeader;
import com.saeweb.dto.index_page.text_list.TextList;
import com.saeweb.util.index.IndexImageLoader;
import com.saeweb.util.index.IndexTextLoader;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.stereotype.Service;

@Service
public class IndexPageServiceImpl implements IndexPageService {
    private final String title;

    public IndexPageServiceImpl(
            @Value("${appointment.title}") String title) {
        this.title = title;
    }

    @Override
    public IndexHeader genHeaders() {
        return new IndexHeader(title);
    }

    @Override
    public ImageList getImages(String path) {
        return IndexImageLoader.loadImageFromResources(path);
    }

    @Override
    public TextList getTexts(String path) {
        return IndexTextLoader.loadTextFromResources(path);
    }
}
