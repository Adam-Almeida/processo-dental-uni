<?php $v->layout("_theme"); ?>

<?php $v->start("nav"); ?>

<nav class="main_header_content_menu">
    <ul>
        <li><a href="<?= urlLink(); ?>" class="icon-home">INICIO</a></li>
    </ul>
</nav>
<nav class="main_header_content_menu_mobile">
    <ul>
        <li>
            <span class="main_header_content_menu_mobile_obj icon-menu icon-notext "></span>
            <ul class="main_header_content_menu_mobile_sub ds_none">
                <li><a href="<?= urlLink(); ?>" class="icon-home">INICIO</a></li>
            </ul>
        </li>
    </ul>
</nav>
<?php $v->stop(); ?>
<section class="main_login">
    <?= flash(); ?>
    <header class="radius">
        <h1>ACESSO ADMINISTRATIVO</h1>
        <p>Utilize a senha padrão</p>
        <form action="<?= url("/login") ?>" enctype="multipart/form-data" method="post">
            <input name="csrf" type="hidden" value="true">
            <input name="email" type="text" placeholder="Informe o email de login">
            <input name="password" type="password" placeholder="Sua Senha">
            <button type="submit" class="btn">ENTRAR</button>
        </form>
    </header>
</section>