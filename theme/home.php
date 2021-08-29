<?php $v->layout("_theme"); ?>

<section id="dentist-id" class="main_dentists">
    <header>
        <h1 class="icon-dentist">Últimos Dentistas Cadastrados</h1>
        <p>Utilize a busca para obter resultados mais detalhados.</p>
    </header>
    <div class="main_dentists_content">

        <?php if (!empty($dentistsAll)):
            foreach ($dentistsAll as $dentist):
                ?>
                <a style="cursor: pointer;" id="copy-dentist-transfer-area">
                    <article>
                        <div class="main_dentists_article_left">
                            <h2 id="value-real-dentist"><?= $dentist->name; ?></h2>
                            <p class="icon-aid-kit">
                                CRO <?= $dentist->cro . " - " . $dentist->cro_uf; ?></p>
                            <p class="icon-mail4"><?= $dentist->email; ?></p>
                        </div>
                        <div class="main_dentists_article_right">
                            <?php if($dentist->speciality()): ?>
                            <?php foreach ($dentist->speciality() as $dentistSpeciality):?>
                                <p class="icon-plus"><?= ($dentistSpeciality->name ?? "Especialidade Não Econtrada") ?></p>
                            <?php endforeach; else:?>
                            <p class="icon-plus">Especialidade Não Econtrada</p>
                            <?php endif; ?>
                        </div>
                    </article>
                </a>
            <?php
            endforeach;
        else: ?>
            <article style="padding: 50px">
                <h2>Ainda não existem Dentistas Cadastrados!</h2>
            </article>
        <?php endif; ?>
    </div>
</section>
<div class="container_paginator">
    <?= $paginator; ?>
</div>
