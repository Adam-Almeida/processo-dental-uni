<?php $v->layout("_admin_theme"); ?>

<section class="main_admin">

    <div class="main_admin_content">
        <header class="radius">
            <?php if (!empty($specialityAll)): ?>
                <h1>Especialidades Cadastradas</h1>
                <br>

                <?php foreach ($specialityAll as $speciality):?>

                    <article style="border-bottom: #ffffff 1px solid; margin-bottom: 10px">
                        <div class="main_dentists_article_left">
                            <h2 id="value-real-dentist"><?= $speciality->name ?></h2>
                        </div>

                        <div class="main_dentists_article_right" style="text-align: right; ">
                            <a href="<?= urlLink("/admin/especialidade/editar/{$speciality->id}")?>"
                               class="main_dentists_article_left_button main_dentists_article_left_button_edit" ><i class="icon-pencil2"></i> Editar</a>
                            <a href="<?= urlLink("/admin/especialidade/excluir/{$speciality->id}")?>"
                               class="main_dentists_article_left_button main_dentists_article_left_button_delete" ><i class="icon-bin"></i> Excluir</a>
                        </div>

                    </article>

                <?php endforeach; ?>

            <?php
            else: ?>
                <h1>Ainda não existem cupons Cadastrados!</h1>
            <?php endif; ?>
        </header>
        <header class="radius">

            <?php if (!empty($edit)): ?>
            <h1>Editar Dentista</h1>
            <form action="<?= urlLink("/admin/cupom/editar/$edit->id"); ?>" enctype="multipart/form-data" method="post">
                <label for="name">Nome</label>
                <input name="name" type="text" required>

                <button type="submit">Efetuar Cadastro</button>


                <?php else: ?>

                <h1>Cadastrar Nova Especialidade</h1>
                <form action="<?= urlLink("/admin/especialidades"); ?>" enctype="multipart/form-data" method="post">
                    <label for="name">Nome</label>
                    <input name="name" type="text" required>

                    <button type="submit">Efetuar Cadastro</button>

                    <?php endif; ?>

                </form>
        </header>
    </div>
</section>