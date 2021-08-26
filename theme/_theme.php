<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Processo | Adam Almeida"; ?></title>

    <link rel="stylesheet" href="<?= url("theme/_cdn/fonticon.css"); ?>" type="text/css">
    <link rel="stylesheet" href="<?= url("theme/_cdn/boot.css"); ?>" type="text/css">
    <link rel="stylesheet" href="<?= url("theme/_cdn/style.css"); ?>" type="text/css">
</head>

<body>
<header class="main_header">
    <div class="main_header_content">
        <a href="<?= url(); ?>" class="logo">
            <img src="<?= url("theme/img/logo.svg"); ?>"
                 alt="Bem Vindo a Minha Aplicação para o processo de testes PHP Developer">
        </a>

        <?php if ($v->section("nav")):
            echo $v->section("nav");
            ?>
        <?php else: ?>

            <nav class="main_header_content_menu">
                <ul>
                    <li><a href="<?= url(); ?>" class="icon-home">INICIO</a></li>
                    <li><a href="<?= urlLink("/admin/dash"); ?>" class="icon-key">FAZER LOGIN</a></li>
                </ul>
            </nav>

            <nav class="main_header_content_menu_mobile">
                <ul>
                    <li>
                        <span class="main_header_content_menu_mobile_obj icon-menu icon-notext "></span>
                        <ul class="main_header_content_menu_mobile_sub ds_none">
                            <li><a href="<?php urlLink(); ?>" class="icon-home">INICIO</a></li>
                            <li><a href="<?= urlLink("/admin/dash"); ?>" class="icon-key">FAZER LOGIN</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

        <?php endif;
        ?>

    </div>
</header>

<main class="fadeIn">

    <article class="main_search">
        <div class="main_search_content">
            <header>
                <h1>Confira a validade dos dados do seu dentista</h1>
                <p>Informe o nome, especialidade ou cro e faça sua busca</p>
            </header>
            <form action="<?= urlLink('/dentista/buscar'); ?>" enctype="multipart/form-data" method="post"">

            <input type="text" name="s" placeholder="Digite aqui =)">
            <select type="text" name="tipo">
                <option value="name">Nome</option>
                <option value="email">Email</option>
                <option value="cro">CRO</option>
                <option value="cro_uf">UF</option>
            </select>
            <button type="submit">Buscar</button>
            </form>
        </div>
    </article>

    <!--  begin::content  -->
    <?= $v->section("content"); ?>
    <!--  end::content  -->
</main>

<footer class="main_footer">
    <div class="main_footer_content">
        <p>Aplicação desenvolvida por Adam Almeida para o processo seletivo de PHP Developer - DENTAL UNI - Agosto 2021</p>
    </div>
</footer>

<script src="<?= url("theme/_cdn/js/jquery-3.6.0.min.js"); ?>"></script>
<script src="<?= url("theme/_cdn/js/main.js"); ?>"></script>

</body>

</html>