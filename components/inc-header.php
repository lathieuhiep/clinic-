<header class="global-header">
    <div class="global-header__top d-none d-lg-block">
        <div class="container">
            <div class="grid">
                <?php
                get_template_part('components/header/inc','logo');

                get_template_part('components/header/inc','contact-info');
                ?>
            </div>
        </div>
    </div>

    <?php
    get_template_part('components/header/inc','top-nav-mobile');

    get_template_part('components/header/inc','contact-mobile');
    ?>
</header>