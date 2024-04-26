<?php
$call_phone = clinic_get_opt_hotline();
$chat_zalo = clinic_get_opt_chat_zalo();
?>

<div class="chat-with-us">
    <?php if ( $call_phone ) : ?>
        <a class="chat-with-us__link chat-with-us__phone" href="tel:<?php echo esc_attr(clinic_preg_replace_ony_number($call_phone)); ?>">
            <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/gif/phone-icon.gif' ) ) ?>" alt="support">
        </a>
	<?php endif; ?>

    <?php
    if ( $chat_zalo ) :
        $zalo_phone = $chat_zalo['phone'];
        $zalo_qr_code = $chat_zalo['qr_code'];
    ?>
        <a class="link chat-with-us__zalo" href="#" data-phone="<?php echo esc_attr($zalo_phone); ?>" data-qr-code="<?php echo esc_attr($zalo_qr_code); ?>">
            <img alt="svgImg"
                 src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA0OCA0OCI+CjxwYXRoIGZpbGw9IiMyOTYyZmYiIGQ9Ik0xNSwzNlY2LjgyN2wtMS4yMTEtMC44MTFDOC42NCw4LjA4Myw1LDEzLjExMiw1LDE5djEwYzAsNy43MzIsNi4yNjgsMTQsMTQsMTRoMTAJYzQuNzIyLDAsOC44ODMtMi4zNDgsMTEuNDE3LTUuOTMxVjM2SDE1eiI+PC9wYXRoPjxwYXRoIGZpbGw9IiNlZWUiIGQ9Ik0yOSw1SDE5Yy0xLjg0NSwwLTMuNjAxLDAuMzY2LTUuMjE0LDEuMDE0QzEwLjQ1Myw5LjI1LDgsMTQuNTI4LDgsMTkJYzAsNi43NzEsMC45MzYsMTAuNzM1LDMuNzEyLDE0LjYwN2MwLjIxNiwwLjMwMSwwLjM1NywwLjY1MywwLjM3NiwxLjAyMmMwLjA0MywwLjgzNS0wLjEyOSwyLjM2NS0xLjYzNCwzLjc0MgljLTAuMTYyLDAuMTQ4LTAuMDU5LDAuNDE5LDAuMTYsMC40MjhjMC45NDIsMC4wNDEsMi44NDMtMC4wMTQsNC43OTctMC44NzdjMC41NTctMC4yNDYsMS4xOTEtMC4yMDMsMS43MjksMC4wODMJQzIwLjQ1MywzOS43NjQsMjQuMzMzLDQwLDI4LDQwYzQuNjc2LDAsOS4zMzktMS4wNCwxMi40MTctMi45MTZDNDIuMDM4LDM0Ljc5OSw0MywzMi4wMTQsNDMsMjlWMTlDNDMsMTEuMjY4LDM2LjczMiw1LDI5LDV6Ij48L3BhdGg+PHBhdGggZmlsbD0iIzI5NjJmZiIgZD0iTTM2Ljc1LDI3QzM0LjY4MywyNywzMywyNS4zMTcsMzMsMjMuMjVzMS42ODMtMy43NSwzLjc1LTMuNzVzMy43NSwxLjY4MywzLjc1LDMuNzUJUzM4LjgxNywyNywzNi43NSwyN3ogTTM2Ljc1LDIxYy0xLjI0LDAtMi4yNSwxLjAxLTIuMjUsMi4yNXMxLjAxLDIuMjUsMi4yNSwyLjI1UzM5LDI0LjQ5LDM5LDIzLjI1UzM3Ljk5LDIxLDM2Ljc1LDIxeiI+PC9wYXRoPjxwYXRoIGZpbGw9IiMyOTYyZmYiIGQ9Ik0zMS41LDI3aC0xYy0wLjI3NiwwLTAuNS0wLjIyNC0wLjUtMC41VjE4aDEuNVYyN3oiPjwvcGF0aD48cGF0aCBmaWxsPSIjMjk2MmZmIiBkPSJNMjcsMTkuNzV2MC41MTljLTAuNjI5LTAuNDc2LTEuNDAzLTAuNzY5LTIuMjUtMC43NjljLTIuMDY3LDAtMy43NSwxLjY4My0zLjc1LDMuNzUJUzIyLjY4MywyNywyNC43NSwyN2MwLjg0NywwLDEuNjIxLTAuMjkzLDIuMjUtMC43NjlWMjYuNWMwLDAuMjc2LDAuMjI0LDAuNSwwLjUsMC41aDF2LTcuMjVIMjd6IE0yNC43NSwyNS41CWMtMS4yNCwwLTIuMjUtMS4wMS0yLjI1LTIuMjVTMjMuNTEsMjEsMjQuNzUsMjFTMjcsMjIuMDEsMjcsMjMuMjVTMjUuOTksMjUuNSwyNC43NSwyNS41eiI+PC9wYXRoPjxwYXRoIGZpbGw9IiMyOTYyZmYiIGQ9Ik0yMS4yNSwxOGgtOHYxLjVoNS4zMjFMMTMsMjZoMC4wMjZjLTAuMTYzLDAuMjExLTAuMjc2LDAuNDYzLTAuMjc2LDAuNzVWMjdoNy41CWMwLjI3NiwwLDAuNS0wLjIyNCwwLjUtMC41di0xaC01LjMyMUwyMSwxOWgtMC4wMjZjMC4xNjMtMC4yMTEsMC4yNzYtMC40NjMsMC4yNzYtMC43NVYxOHoiPjwvcGF0aD4KPC9zdmc+"/>
        </a>
    <?php endif; ?>
</div>