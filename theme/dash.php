<?php $v->layout("_admin_theme"); ?>

<section class="main_admin" xmlns="http://www.w3.org/1999/html">

    <div class="main_admin_content">
        <header class="radius">
            <?php if (!empty($dentistsAll)): ?>
                <h1>Dentistas Cadastrados</h1>
                <br>
                <?php foreach ($dentistsAll as $dentist): ?>
                    <article style="border-bottom: #ffffff 1px solid; padding-bottom: 10px; margin-bottom: 10px">
                        <div class="main_dentists_article_left">
                            <h2 id="value-real-dentist"><?= $dentist->name ?>
                                <span> <a href="<?= urlLink("/admin/dentista/editar/{$dentist->id}") ?>"
                                          class="main_dentists_article_left_button
                                   main_dentists_article_left_button_edit"><i
                                                class="icon-pencil2"></i> Editar</a>
                                   <a href="<?= urlLink("/admin/dentista/excluir/{$dentist->id}") ?>"
                                      class="main_dentists_article_left_button main_dentists_article_left_button_delete"><i
                                               class="icon-bin"></i> Excluir</a>
                               </span>
                            </h2>
                            <p class="icon-aid-kit">
                                CRO <?= $dentist->cro . " - " . $dentist->cro_uf; ?>
                                <span class="icon-mail4"><?= $dentist->email; ?></span>
                            </p>

                            <?php if ($dentist->speciality()): ?>
                                <?php foreach ($dentist->speciality() as $dentistSpeciality): ?>
                                    <span class="icon-user-plus small-text"><?= ($dentistSpeciality->name ?? "Especialidade Não Econtrada") ?></span>
                                <?php endforeach; else: ?>
                                <span class="small-text">Especialidade Não Econtrada</span>
                            <?php endif; ?>

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

                <?php if ($edit->speciality()): ?>
                    <div id="add-speciality-content" style="width: 100%">
                        <?php foreach ($edit->speciality() as $dentistSpeciality): ?>
                            <div class="uniqueSelect">
                                <input name="especialidade[]" type="hidden" value="<?= ($dentistSpeciality->id ?? null); ?>"/>
                                <select style="width: 80%" disabled>
                                    <option selected><?= ($dentistSpeciality->name ?? "Especialidade Não econtrada") ?></option>
                                </select>
                                <a href="#" class="linkRemove remove"><i class="icon-cancel-circle"></i>Remover</a>
                            </div>
                        <?php endforeach; ?>

                        <div id="add-speciality" style="width: 30%"
                             class="main_dentists_article_left_button main_dentists_article_left_button_add">
                            <i class="icon-plus"></i>Adicionar Especialidade
                        </div>
                    </div>
                    <button style="width: 100%" type="submit">Atualizar Cadastro</button>

                <?php else: ?>
                    <select name="especialidade[1]">
                        <?php if (!empty($specialityAll)):
                            foreach ($specialityAll as $speciality):?>
                                <option value="<?= $speciality->id; ?>"><?= $speciality->name; ?></option>
                            <?php endforeach; else: ?>
                            <option value="Odontologia" selected>Odontologia</option>
                        <?php endif; ?>
                    </select>
                    <div id="add-speciality-content" style="width: 100%"></div>
                    <div id="add-speciality" style="width: 30%"
                         class="main_dentists_article_left_button main_dentists_article_left_button_add">
                        <i class="icon-plus"></i>Adicionar Especialidade
                    </div>

                    <button type="submit">Atualizar Cadastro</button>
                <?php endif; ?>


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
                    <select name="especialidade[1]">
                        <?php if (!empty($specialityAll)):
                            foreach ($specialityAll as $speciality):?>
                                <option value="<?= $speciality->id; ?>"><?= $speciality->name; ?></option>
                            <?php endforeach; else: ?>
                            <option value="Odontologia" selected>Odontologia</option>
                        <?php endif; ?>
                    </select>

                    <div style="width: 100%" id="add-speciality-content"></div>
                    <div id="add-speciality"
                         class="main_dentists_article_left_button main_dentists_article_left_button_add">
                        <i class="icon-plus"></i>Adicionar Especialidade
                    </div>

                    <button type="submit">Efetuar Cadastro</button>

                    <?php endif; ?>
                </form>
        </header>
    </div>
</section>

<?= $v->start("scripts"); ?>
<script>
    $(function () {
        var divContent = $('#add-speciality-content');
        var botaoAdicionar = $('#add-speciality');
        var i = 2;

        $(botaoAdicionar).click(function () {
            $(
                '<div class="uniqueSelect">' +
                '<select style="width: 100%; margin-bottom: 5px;" name="especialidade[' + i + '] ">' +
                '<?php if (!empty($specialityAll)): foreach ($specialityAll as $speciality): ?>' +
                '<option value="<?= $speciality->id; ?>"><?= $speciality->name; ?></option>' +
                '<?php endforeach; else:?>' +
                '<option value="Odontologia" selected>Odontologia</option>' +
                '<?php endif; ?>' +
                '</select>' +
                '<a href="#" class="linkRemove main_dentists_article_left_button main_dentists_article_left_button_remove">' +
                'Remove Campo</a></div>'
            ).appendTo(divContent);

            $('#removehidden').remove();
            i++;
            $('<input type="hidden" name="qtdSelects" value="' + i + '" id="removehidden">').appendTo(divContent);
        });

        //Cliquando em remover a linha é eliminada
        $('#add-speciality-content').on('click', '.linkRemove', function () {
            $(this).parents('.uniqueSelect').remove();
            i--;
        });

    });
</script>

<?= $v->stop(); ?>



