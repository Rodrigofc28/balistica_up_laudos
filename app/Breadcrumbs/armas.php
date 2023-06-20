<?php

Breadcrumbs::register('revolveres.create', function ($breadcrumbs, $laudo) {
    $breadcrumbs->parent('laudos.materiais', $laudo);
    $breadcrumbs->push('Novo Revólver', route('revolveres.create', $laudo));
});

Breadcrumbs::register('revolveres.edit', function ($breadcrumbs, $laudo, $arma) {
    $breadcrumbs->parent('laudos.show', $laudo);
    $breadcrumbs->push("Editar $arma->tipo_arma" , route('revolveres.edit',[ $laudo, $arma]));
});

Breadcrumbs::register('espingardas.create', function ($breadcrumbs, $laudo) {
    $breadcrumbs->parent('laudos.materiais', $laudo);
    $breadcrumbs->push('Nova Espingarda', route('espingardas.create', $laudo));
});

Breadcrumbs::register('espingardas.edit', function ($breadcrumbs, $laudo, $arma) {

    $breadcrumbs->parent('laudos.show', $laudo);
    $breadcrumbs->push("Editar $arma->tipo_arma" , route('espingardas.edit',[ $laudo, $arma]));
});

Breadcrumbs::register('garruchas.create', function ($breadcrumbs, $laudo) {
    $breadcrumbs->parent('laudos.materiais', $laudo);
    $breadcrumbs->push('Nova Garrucha', route('garruchas.create', $laudo));
});

Breadcrumbs::register('garruchas.edit', function ($breadcrumbs, $laudo, $arma) {
    
    $breadcrumbs->parent('laudos.show', $laudo);
    $breadcrumbs->push("Editar $arma->tipo_arma" , route('garruchas.edit',[ $laudo, $arma]));
});

Breadcrumbs::register('pistolas.create', function ($breadcrumbs, $laudo) {
    $breadcrumbs->parent('laudos.materiais', $laudo);
    $breadcrumbs->push('Nova Pistola', route('pistolas.create', $laudo));
});

Breadcrumbs::register('pistolas.edit', function ($breadcrumbs, $laudo, $arma) {
    $breadcrumbs->parent('laudos.show', $laudo);
    $breadcrumbs->push("Editar $arma->tipo_arma" , route('pistolas.edit',[ $laudo, $arma]));
});

Breadcrumbs::register('espingardas_artesanais.create', function ($breadcrumbs, $laudo) {
    $breadcrumbs->parent('laudos.materiais', $laudo);
    $breadcrumbs->push('Nova Espingarda Artesanal', route('espingardas_artesanais.create', $laudo));
});

Breadcrumbs::register('espingardas_artesanais.edit', function ($breadcrumbs, $laudo, $arma) {
    $breadcrumbs->parent('laudos.show', $laudo);
    $breadcrumbs->push("Editar $arma->tipo_arma" , route('espingardas_artesanais.edit',[ $laudo, $arma]));
});

Breadcrumbs::register('carabinas.create', function ($breadcrumbs, $laudo) {
    $breadcrumbs->parent('laudos.materiais', $laudo);
    $breadcrumbs->push('Nova Carabina', route('carabinas.create', $laudo));
});

Breadcrumbs::register('carabinas.edit', function ($breadcrumbs, $laudo, $arma) {
    $breadcrumbs->parent('laudos.show', $laudo);
    $breadcrumbs->push("Editar $arma->tipo_arma" , route('carabinas.edit',[ $laudo, $arma]));
});

Breadcrumbs::register('metralhadoras.create', function ($breadcrumbs, $laudo) {
    $breadcrumbs->parent('laudos.materiais', $laudo);
    $breadcrumbs->push('Nova metralhadora', route('metralhadoras.create', $laudo));
});

Breadcrumbs::register('metralhadoras.edit', function ($breadcrumbs, $laudo, $arma) {
    $breadcrumbs->parent('laudos.show', $laudo);
    $breadcrumbs->push("Editar $arma->tipo_arma" , route('metralhadoras.edit',[ $laudo, $arma]));
});

Breadcrumbs::register('submetralhadoras.create', function ($breadcrumbs, $laudo) {
    $breadcrumbs->parent('laudos.materiais', $laudo);
    $breadcrumbs->push('Nova submetralhadora', route('submetralhadoras.create', $laudo));
});

Breadcrumbs::register('submetralhadoras.edit', function ($breadcrumbs, $laudo, $arma) {
    $breadcrumbs->parent('laudos.show', $laudo);
    $breadcrumbs->push("Editar $arma->tipo_arma" , route('submetralhadoras.edit',[ $laudo, $arma]));
});

Breadcrumbs::register('fuzils.create', function ($breadcrumbs, $laudo) {
    $breadcrumbs->parent('laudos.materiais', $laudo);
    $breadcrumbs->push('Novo fuzil', route('fuzils.create', $laudo));
});

Breadcrumbs::register('fuzils.edit', function ($breadcrumbs, $laudo, $arma) {
    $breadcrumbs->parent('laudos.show', $laudo);
    $breadcrumbs->push("Editar $arma->tipo_arma" , route('fuzils.edit',[ $laudo, $arma]));
});
Breadcrumbs::register('pistoletes.create', function ($breadcrumbs, $laudo) {
    $breadcrumbs->parent('laudos.materiais', $laudo);
    $breadcrumbs->push('Novo pistolete', route('pistoletes.create', $laudo));
});

Breadcrumbs::register('pistoletes.edit', function ($breadcrumbs, $laudo, $arma) {
    $breadcrumbs->parent('laudos.show', $laudo);
    $breadcrumbs->push("Editar $arma->tipo_arma" , route('pistoletes.edit',[ $laudo, $arma]));
});
Breadcrumbs::register('espingardamistas.create', function ($breadcrumbs, $laudo) {
    $breadcrumbs->parent('laudos.materiais', $laudo);
    $breadcrumbs->push('Nova espingarda mista', route('espingardamistas.create', $laudo));
});

/* Breadcrumbs::register('espingardamistas.edit', function ($breadcrumbs, $laudo, $arma) {
    
    $breadcrumbs->parent('laudos.show', $laudo);
    $breadcrumbs->push("Editar $arma->tipo_arma" , route('espingardamistas.edit',[ $laudo, $arma]));
}); */