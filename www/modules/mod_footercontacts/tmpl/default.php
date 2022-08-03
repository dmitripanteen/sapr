<?php foreach($contacts as $contactInfo) {
    switch ($contactInfo->type){
        case 'phone':
            $icon = '<i class="fa fa-phone" aria-hidden="true"></i>';
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
            $icon = '<i class="fa fa-envelope-o" aria-hidden="true"></i>';
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
            $icon = '<i class="fa fa-compass" aria-hidden="true"></i>';
            $res = $contactInfo->line1;
            if($contactInfo->line2) {
                $res .= '<br>'.$contactInfo->line2;
            }
            break;
    }
    echo '<div class="data">'.$icon.'<p>'.$res.'</p></div>';
}?>
<img class="technicon-logo"
     src="/templates/cadelectro/assets/img/technicon-logo.png">

