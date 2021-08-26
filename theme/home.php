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
                            <h2 id="value-real-dentist"><?= $dentist->dentist()->name; ?></h2>
                            <p class="icon-aid-kit">
                                CRO <?= $dentist->dentist()->cro . " - " . $dentist->dentist()->cro_uf; ?></p>
                            <p class="icon-mail4"><?= $dentist->dentist()->email; ?></p>
                        </div>
                        <div class="main_dentists_article_right">
                            <p><?= ($dentist->speciality()->name ?? "Especialidade não econtrada") ?></p>
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
