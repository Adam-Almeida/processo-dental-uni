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
    <link rel="stylesheet" href="<?= url("theme/_cdn/admin.style.css"); ?>" type="text/css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
<header class="main_header">

    <div class="main_header_content">
        <a href="<?= url(); ?>" class="logo">
            <img src="<?= url("theme/img/logo.svg"); ?>"
                 alt="Bem Vindo a Minha Aplicação para o processo de testes PHP Developer">
        </a>
        <nav class="main_header_content_menu">
            <ul>
                <li><a href="<?= urlLink("/admin/dash"); ?>" class="icon-user-plus">DENTISTAS</a></li>
                <li><a href="<?= urlLink("/admin/especialidades"); ?>" class="icon-plus">ESPECIALIDADES</a></li>
                <li><a href="<?= urlLink("/admin/sair"); ?>" class="icon-exit">SAIR</a></li>
                <li style="color: #ffffff"><i class="icon-user"></i><?= $user; ?></li>
            </ul>
        </nav>

        <nav class="main_header_content_menu_mobile">
            <ul>
                <li>
                    <span class="main_header_content_menu_mobile_obj icon-menu icon-notext "></span>
                    <ul class="main_header_content_menu_mobile_sub ds_none">
                        <li><a href="<?= urlLink("/admin/dash"); ?>" class="icon-user-plus">DENTISTAS</a></li>
                        <li><a href="<?= urlLink("/admin/especialidades"); ?>" class="icon-plus">ESPECIALIDADES</a></li>
                        <li><a href="<?= urlLink("/admin/sair"); ?>" class="icon-exit">SAIR</a></li>
                        <li style="color: #004594; margin: 10px"><i class="icon-user"></i><?= $user; ?></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main class="fadeIn">
    <?= flash(); ?>
    <!--  begin::content  -->
    <?= $v->section("content"); ?>
    <!--  end::content  -->
</main>


<footer class="main_footer">
    <div class="main_footer_content">
        <p>Aplicação desenvolvida por Adam Almeida para o processo seletivo de PHP Developer - DENTAL UNI - Agosto
            2021</p></div>
</footer>


<script src="<?= url("theme/_cdn/js/jquery-3.6.0.min.js"); ?>"></script>
<script src="<?= url("theme/_cdn/js/main.js"); ?>"></script>
<script>

    $(function () {
        var divContent = $('#add-speciality-content');
        var botaoAdicionar = $('#add-speciality');
        var i = 1;

        //Ao clicar em adicionar ele cria uma linha com novos campos
        $(botaoAdicionar).click(function () {
            $(
                '<div class="conteudoIndividual">' +
                '<select style="width: 100%; margin-bottom: 5px;" name="especialidade'+ i +' ">' +
                '<option value="especialidade a">Especialidade a</option>' +
                '<option value="especialidade b">Especialidade B</option>' +
                '<option value="especialidade c">Especialidade c</option>' +
                '</select>' +
                '<a href="#" class="linkRemover main_dentists_article_left_button main_dentists_article_left_button_remove">' +
                'Remove Campo</a></div>'
            ).appendTo(divContent);

            $('#removehidden').remove();
            i++;
            $('<input type="hidden" name="quantidadeCampos" value="' + i + '" id="removehidden">').appendTo(divContent);
        });

        //Cliquando em remover a linha é eliminada
        $('#add-speciality-content').on('click', '.linkRemover', function () {
            $(this).parents('.conteudoIndividual').remove();
            i--;
        });
    });



</script>

</body>

</html>