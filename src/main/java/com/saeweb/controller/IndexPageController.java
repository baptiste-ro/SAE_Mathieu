package com.saeweb.controller;

import com.saeweb.dto.index_page.ImageList.ImageList;
import com.saeweb.dto.index_page.IndexHeader.IndexHeader;
import com.saeweb.dto.index_page.text_list.TextList;
import com.saeweb.service.index_page.IndexPageServiceImpl;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/index")
public class IndexPageController {

    private final IndexPageServiceImpl indexPageService;

    @Autowired
    public IndexPageController(IndexPageServiceImpl indexPageService) {
        this.indexPageService = indexPageService;
    }

    @GetMapping("/header")
    public IndexHeader headerGen() {
        return indexPageService.genHeaders();
    }

    @GetMapping("/images")
    public ImageList getImages() {
        return indexPageService.getImages("index/image.json");
    }

    @GetMapping("/texts")
    public TextList getTexts(
            @Value("appointment.index.textfile") String path
    ) {
        return indexPageService.getTexts(path);
    }
}

