<?php $v->layout("_theme"); ?>

<article class="main_search">
    <div class="main_search_content">
        <header>
            <h1>Confira a validade dos dados do seu dentista</h1>
            <p>Informe o nome, especialidade ou cro e faça sua busca</p>
        </header>
        <form action="<?= urlLink('/buscar'); ?>" enctype="multipart/form-data" method="post"">
            <input type="text" name="s" placeholder="Digite aqui =)">
            <button type="submit">Buscar</button>
        </form>
    </div>
</article>

<section id="dentist-id" class="main_dentists">
    <header>
        <h1 class="icon-dentist">Consfira os Últimos Dentistas Cadastrados</h1>
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
                            <p class="icon-aid-kit">CRO <?= $dentist->dentist()->cro . " - " . $dentist->dentist()->cro_uf; ?></p>
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
