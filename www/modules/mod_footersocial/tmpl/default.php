<?php
echo '<p>';
foreach ($links as $link) {
    switch ($link->social_media) {
        case 'facebook':
            $res = '<a href="' . $link->url . '"';
            if ($link->is_open_new_tab) {
                $res .= 'target="_blank"';
            }
            $res .= '><i class="ti ti-facebook"></i></a>';
            break;
        case 'linkedin':
            $res = '<a href="' . $link->url . '"';
            if ($link->is_open_new_tab) {
                $res .= 'target="_blank"';
            }
            $res .= '><i class="ti ti-linkedin"></i></a>';
            break;
        case 'instagram':
            $res = '<a href="' . $link->url . '"';
            if ($link->is_open_new_tab) {
                $res .= 'target="_blank"';
            }
            $res .= '><i class="ti ti-instagram"></i></a>';
            break;
        case 'viber':
            $res = '<a href="' . $link->url . '"';
            if ($link->is_open_new_tab) {
                $res .= 'target="_blank"';
            }
            $res .= '><i class="fab fa-viber"></i></a>';
            break;
        case 'whatsapp':
            $res = '<a href="' . $link->url . '"';
            if ($link->is_open_new_tab) {
                $res .= 'target="_blank"';
            }
            $res .= '><i class="fa fa-whatsapp"></i></a>';
            break;
        case 'telegram':
            $res = '<a href="' . $link->url . '"';
            if ($link->is_open_new_tab) {
                $res .= 'target="_blank"';
            }
            $res .= '><i class="fa fa-telegram"></i></a>';
            break;
        case 'youtube':
        default:
            $res = '<a href="' . $link->url . '"';
            if ($link->is_open_new_tab) {
                $res .= 'target="_blank"';
            }
            $res .= '><i class="ti ti-youtube"></i></a>';
            break;
    }
    echo $res;
}
echo '<a class="mobile popup-opener" href="#popup-support-form"><i class="ti ti-help-alt"></i></a>';
echo '</p>'; ?>
<p class="copyrights">&copy;<?= date('Y') . ' ' . $copyrightsText; ?></p>

