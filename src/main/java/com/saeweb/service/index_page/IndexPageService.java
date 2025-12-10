package com.saeweb.service.index_page;

import com.saeweb.dto.index_page.ImageList.ImageList;
import com.saeweb.dto.index_page.IndexHeader.IndexHeader;
import com.saeweb.dto.index_page.text_list.TextList;

public interface IndexPageService {
    IndexHeader genHeaders();
    ImageList getImages(String path);
    TextList getTexts(String path);
}
