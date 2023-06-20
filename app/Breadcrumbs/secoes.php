<?php

Breadcrumbs::register('secoes.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Unidades', route('secoes.index'));
});

Breadcrumbs::register('secoes.create', function ($breadcrumbs) {
    $breadcrumbs->parent('secoes.index');
    $breadcrumbs->push('Nova Unidade', route('secoes.create'));
});

Breadcrumbs::register('secoes.edit', function ($breadcrumbs, $secao) {
    $breadcrumbs->parent('secoes.index', $secao);
    $breadcrumbs->push('Editar Unidade', route('secoes.edit', $secao));
});