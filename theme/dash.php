<?php $v->layout("_admin_theme"); ?>

<section class="main_admin" xmlns="http://www.w3.org/1999/html">

    <div class="main_admin_content">
        <header class="radius">
            <?php if (!empty($dentistsAll)): ?>
                <h1>Dentistas Cadastrados</h1>
                <br>
                <?php foreach ($dentistsAll as $dentist): ?>
                    <article style="border-bottom: #ffffff 1px solid; margin-bottom: 10px">
                        <div class="main_dentists_article_left">
                            <h2 id="value-real-dentist"><?= $dentist->dentist()->name ?></h2>
                            <p class="icon-aid-kit">
                                CRO <?= $dentist->dentist()->cro . " - " . $dentist->dentist()->cro_uf; ?>
                                <span class="icon-mail4"><?= $dentist->dentist()->email; ?></span>
                            </p>
                            <p class="icon-user-plus"><?= ($dentist->speciality()->name ?? "Especialidade Não Econtrada"); ?></p>

                        </div>

                        <div class="main_dentists_article_right">
                            <a href="<?= urlLink("/admin/dentista/editar/{$dentist->dentist()->id}") ?>"
                               class="main_dentists_article_left_button main_dentists_article_left_button_edit"><i
                                        class="icon-pencil2"></i> Editar</a>
                            <a href="<?= urlLink("/admin/dentista/excluir/{$dentist->dentist()->id}") ?>"
                               class="main_dentists_article_left_button main_dentists_article_left_button_delete"><i
                                        class="icon-bin"></i> Excluir</a>
                        </div>

                    </article>

                <?php endforeach; ?>
                <div class="container_paginator">
                    <?= $paginator; ?>
                </div>
            <?php
            else: ?>
                <h1>Ainda não existem Dentistas Cadastrados!</h1>
            <?php endif; ?>
        </header>

        <header class="radius">
            <?php if (!empty($edit)): ?>
            <h1>Editar Dentista</h1>
            <form action="<?= urlLink("/admin/dentista/editar/$edit->id"); ?>" enctype="multipart/form-data"
                  method="post">
                <label for="name">Nome</label>
                <input name="name" type="text" value="<?= $edit->name; ?>" required>
                <label for="email">Email</label>
                <input name="email" type="email" value="<?= $edit->email; ?>" required>
                <label for="cro">CRO</label>
                <input name="cro" type="number" value="<?= $edit->cro; ?>" required>
                <label for="cro_uf">CRO UF</label>
                <select name="cro_uf">
                    <option value="<?= $edit->cro_uf; ?>" selected><?= $edit->cro_uf; ?></option>
                    <option value="PR">PR</option>
                    <option value="RO">RO</option>
                    <option value="AC">AC</option>
                    <option value="AM">AM</option>
                    <option value="RR">RR</option>
                    <option value="PA">PA</option>
                    <option value="AP">AP</option>
                    <option value="TO">TO</option>
                    <option value="MA">MA</option>
                    <option value="PI">PI</option>
                    <option value="CE">CE</option>
                    <option value="RN">RN</option>
                    <option value="PB">PB</option>
                    <option value="PE">PE</option>
                    <option value="AL">AL</option>
                    <option value="SE">SE</option>
                    <option value="BA">BA</option>
                    <option value="MG">MG</option>
                    <option value="ES">ES</option>
                    <option value="RJ">RJ</option>
                    <option value="SP">SP</option>
                    <option value="SC">SC</option>
                    <option value="RS">RS</option>
                    <option value="MS">MS</option>
                    <option value="MT">MT</option>
                    <option value="GO">GO</option>
                    <option value="DF">DF</option>
                </select>
                <label for="especialidade">Selecione a Especialidade</label>
                <select name="especialidade">
                    <?php if (!empty($specialityAll)):
                        foreach ($specialityAll as $speciality):
                            ?>
                            <option value="<?= $speciality->id; ?>"><?= $speciality->name; ?></option>
                        <?php endforeach;
                    else:
                        ?>
                        <option value="valor1" selected>PR</option>
                    <?php endif; ?>
                </select>

                <button type="submit">Editar Cadastro</button>

                <?php else: ?>

                <h1>Cadastrar Novo Dentista</h1>
                <form action="<?= urlLink("/admin/dentista"); ?>" enctype="multipart/form-data" method="post">
                    <label for="name">Nome</label>
                    <input name="name" type="text" required>
                    <label for="email">Email</label>
                    <input name="email" type="email" required>
                    <label for="cro">CRO</label>
                    <input name="cro" type="number">
                    <label for="cro_uf">CRO UF</label>
                    <select name="cro_uf">
                        <option value="PR" selected>PR</option>
                        <option value="RO">RO</option>
                        <option value="AC">AC</option>
                        <option value="AM">AM</option>
                        <option value="RR">RR</option>
                        <option value="PA">PA</option>
                        <option value="AP">AP</option>
                        <option value="TO">TO</option>
                        <option value="MA">MA</option>
                        <option value="PI">PI</option>
                        <option value="CE">CE</option>
                        <option value="RN">RN</option>
                        <option value="PB">PB</option>
                        <option value="PE">PE</option>
                        <option value="AL">AL</option>
                        <option value="SE">SE</option>
                        <option value="BA">BA</option>
                        <option value="MG">MG</option>
                        <option value="ES">ES</option>
                        <option value="RJ">RJ</option>
                        <option value="SP">SP</option>
                        <option value="SC">SC</option>
                        <option value="RS">RS</option>
                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="GO">GO</option>
                        <option value="DF">DF</option>
                    </select>
                    <label for="especialidade">Selecione a Especialidade</label>
                    <select name="especialidade">
                        <?php if (!empty($specialityAll)):
                            foreach ($specialityAll as $speciality):
                                ?>
                                <option value="<?= $speciality->id; ?>"><?= $speciality->name; ?></option>
                            <?php endforeach;
                        else:
                            ?>
                            <option value="PR" selected>PR</option>
                        <?php endif; ?>
                    </select>
                    <div id="add-speciality"
                       class="main_dentists_article_left_button main_dentists_article_left_button_add">
                        <i class="icon-pencil2"></i>Add Especialidade</div>

                    <div style="width: 100%" id="add-speciality-content"></div>



                    <button type="submit">Efetuar Cadastro</button>

                    <?php endif; ?>

                </form>
        </header>
    </div>
</section>



