<?php

return [
    'title' => $page->main_headline()->value(),
    'text_blocks' => $page->agb_text_blocks()->toStructure()->map(function ($item) {
        return
            $item->paragraph()->value();
    })->values(),

];
