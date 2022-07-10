<?php foreach($contacts as $contactInfo) {
    switch ($contactInfo->type){
        case 'phone':
            $res = '<a href="tel:'
                .str_replace([' ', '-'], '',$contactInfo->line1)
                .'">'.$contactInfo->line1.'</a>';
            if($contactInfo->line2) {
                $res .= '<br><a href="tel:'
                    . str_replace([' ', '-'], '', $contactInfo->line2)
                    . '">' . $contactInfo->line2 . '</a>';
            }
            break;
        case 'email':
            $res = '<a href="mailto:'
                .$contactInfo->line1
                .'">'.$contactInfo->line1.'</a>';
            if($contactInfo->line2) {
                $res .= '<br><a href="mailto:'
                    . $contactInfo->line2
                    . '">' . $contactInfo->line2 . '</a>';
            }
            break;
        case 'text':
        default:
            $res = $contactInfo->line1;
            if($contactInfo->line2) {
                $res .= '<br>'.$contactInfo->line2;
            }
            break;
    }
    echo '<p>'.$res.'</p>';
};

