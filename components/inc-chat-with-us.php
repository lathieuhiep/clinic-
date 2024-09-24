<?php
$call_phone = clinic_get_opt_hotline();
$chat_zalo = clinic_get_chat_zalo();
$link_messenger = clinic_get_opt_link_chat_messenger()
?>

<div class="chat-with-us">
    <?php if ( !empty( $chat_zalo['phone'] ) ) : ?>
        <a class="link zalo<?php echo esc_attr( $chat_zalo['class'] ); ?>"
           href="<?php echo esc_url( $chat_zalo['link'] ) ?>"
           data-phone="<?php echo esc_attr( clinic_preg_replace_ony_number( $chat_zalo['phone'] ) ); ?>"
           data-qr-code="<?php echo esc_attr( $chat_zalo['qr_code'] ); ?>"
           target="<?php echo esc_attr( $chat_zalo['target'] ); ?>"
        >
            <img alt="svgImg"
                 src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA0OCA0OCI+CjxwYXRoIGZpbGw9IiMyOTYyZmYiIGQ9Ik0xNSwzNlY2LjgyN2wtMS4yMTEtMC44MTFDOC42NCw4LjA4Myw1LDEzLjExMiw1LDE5djEwYzAsNy43MzIsNi4yNjgsMTQsMTQsMTRoMTAJYzQuNzIyLDAsOC44ODMtMi4zNDgsMTEuNDE3LTUuOTMxVjM2SDE1eiI+PC9wYXRoPjxwYXRoIGZpbGw9IiNlZWUiIGQ9Ik0yOSw1SDE5Yy0xLjg0NSwwLTMuNjAxLDAuMzY2LTUuMjE0LDEuMDE0QzEwLjQ1Myw5LjI1LDgsMTQuNTI4LDgsMTkJYzAsNi43NzEsMC45MzYsMTAuNzM1LDMuNzEyLDE0LjYwN2MwLjIxNiwwLjMwMSwwLjM1NywwLjY1MywwLjM3NiwxLjAyMmMwLjA0MywwLjgzNS0wLjEyOSwyLjM2NS0xLjYzNCwzLjc0MgljLTAuMTYyLDAuMTQ4LTAuMDU5LDAuNDE5LDAuMTYsMC40MjhjMC45NDIsMC4wNDEsMi44NDMtMC4wMTQsNC43OTctMC44NzdjMC41NTctMC4yNDYsMS4xOTEtMC4yMDMsMS43MjksMC4wODMJQzIwLjQ1MywzOS43NjQsMjQuMzMzLDQwLDI4LDQwYzQuNjc2LDAsOS4zMzktMS4wNCwxMi40MTctMi45MTZDNDIuMDM4LDM0Ljc5OSw0MywzMi4wMTQsNDMsMjlWMTlDNDMsMTEuMjY4LDM2LjczMiw1LDI5LDV6Ij48L3BhdGg+PHBhdGggZmlsbD0iIzI5NjJmZiIgZD0iTTM2Ljc1LDI3QzM0LjY4MywyNywzMywyNS4zMTcsMzMsMjMuMjVzMS42ODMtMy43NSwzLjc1LTMuNzVzMy43NSwxLjY4MywzLjc1LDMuNzUJUzM4LjgxNywyNywzNi43NSwyN3ogTTM2Ljc1LDIxYy0xLjI0LDAtMi4yNSwxLjAxLTIuMjUsMi4yNXMxLjAxLDIuMjUsMi4yNSwyLjI1UzM5LDI0LjQ5LDM5LDIzLjI1UzM3Ljk5LDIxLDM2Ljc1LDIxeiI+PC9wYXRoPjxwYXRoIGZpbGw9IiMyOTYyZmYiIGQ9Ik0zMS41LDI3aC0xYy0wLjI3NiwwLTAuNS0wLjIyNC0wLjUtMC41VjE4aDEuNVYyN3oiPjwvcGF0aD48cGF0aCBmaWxsPSIjMjk2MmZmIiBkPSJNMjcsMTkuNzV2MC41MTljLTAuNjI5LTAuNDc2LTEuNDAzLTAuNzY5LTIuMjUtMC43NjljLTIuMDY3LDAtMy43NSwxLjY4My0zLjc1LDMuNzUJUzIyLjY4MywyNywyNC43NSwyN2MwLjg0NywwLDEuNjIxLTAuMjkzLDIuMjUtMC43NjlWMjYuNWMwLDAuMjc2LDAuMjI0LDAuNSwwLjUsMC41aDF2LTcuMjVIMjd6IE0yNC43NSwyNS41CWMtMS4yNCwwLTIuMjUtMS4wMS0yLjI1LTIuMjVTMjMuNTEsMjEsMjQuNzUsMjFTMjcsMjIuMDEsMjcsMjMuMjVTMjUuOTksMjUuNSwyNC43NSwyNS41eiI+PC9wYXRoPjxwYXRoIGZpbGw9IiMyOTYyZmYiIGQ9Ik0yMS4yNSwxOGgtOHYxLjVoNS4zMjFMMTMsMjZoMC4wMjZjLTAuMTYzLDAuMjExLTAuMjc2LDAuNDYzLTAuMjc2LDAuNzVWMjdoNy41CWMwLjI3NiwwLDAuNS0wLjIyNCwwLjUtMC41di0xaC01LjMyMUwyMSwxOWgtMC4wMjZjMC4xNjMtMC4yMTEsMC4yNzYtMC40NjMsMC4yNzYtMC43NVYxOHoiPjwvcGF0aD4KPC9zdmc+"/>
        </a>
    <?php endif; ?>

    <?php if ( $link_messenger ) : ?>
        <a class="link chat-with-us__messenger" href="<?php echo esc_url($link_messenger); ?>" target="_blank">
            <img alt="svgImg"
                 src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNDgiIGhlaWdodD0iNDgiIHZpZXdCb3g9IjAgMCA0OCA0OCI+CjxwYXRoIGZpbGw9IiM0NDhBRkYiIGQ9Ik0yNCw0QzEzLjUsNCw1LDEyLjEsNSwyMmMwLDUuMiwyLjMsOS44LDYsMTMuMVY0NGw3LjgtNC43YzEuNiwwLjQsMy40LDAuNyw1LjIsMC43YzEwLjUsMCwxOS04LjEsMTktMThDNDMsMTIuMSwzNC41LDQsMjQsNHoiPjwvcGF0aD48cGF0aCBmaWxsPSIjRkZGIiBkPSJNMTIgMjhMMjIgMTcgMjcgMjIgMzYgMTcgMjYgMjggMjEgMjN6Ij48L3BhdGg+Cjwvc3ZnPg=="/>
        </a>
    <?php endif; ?>

    <?php if ($call_phone) : ?>
        <a class="link chat-with-us__phone" href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($call_phone)); ?>">
            <i class="fa-solid fa-phone alo-circle-anim"></i>
        </a>
    <?php endif; ?>
</div>