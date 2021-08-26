<?php $v->layout("_theme"); ?>

<article class="main_search">
    <div class="main_search_content">
        <header>
            <h1>Confira a validade dos dados do seu dentista</h1>
            <p>Informe o nome, especialidade ou cro e faça sua busca</p>
        </header>
        <form action="<?= urlLink('/dentista/buscar'); ?>" enctype="multipart/form-data" method="post"">
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
        <p><?= $search ?></p>
    </div>

</section>
<div class="container_paginator">

</div>
