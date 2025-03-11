<?php

/* public routes*/
Route::get('/', 'HomeController@index')->name('home');

/* Auth routes */
Auth::routes();

Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');

Route::get('unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');

/* Admin routes */
Route::prefix('admin')->middleware('cargo:Administrador')->group(function () {
    Route::resource('solicitantes', 'Admin\OrgaosSolicitantesController')->except(['show']);
    Route::resource('users', 'Admin\UsersController')->except(['show']);
    Route::delete('users/destroy/{user}', 'Admin\UsersController@destroy')->name('usuarios.destroy');
        
    Route::resource('marcas', 'Admin\MarcasController')->except(['show']);
    Route::resource('calibres', 'Admin\CalibresController')->except(['show']);
    Route::resource('secoes', 'Admin\SecoesController')
        ->parameters(['secoes' => 'secao'])->except(['show']);
    Route::resource('origens', 'Admin\OrigensController')
        ->parameters(['origens' => 'origem'])->except(['show']);
    Route::resource('cadastro_armas', 'Admin\CadastroarmasController');
        
    Route::resource('diretores', 'Admin\DiretoresController')
        ->parameters(['diretores' => 'diretor'])->except(['show']);
    Route::get('relatorios/index', 'Admin\RelatoriosController@index')
        ->name('admin.relatorios.index');
    Route::get('relatorios/todos_laudos', 'Admin\RelatoriosController@relatorio_completo')
        ->name('admin.relatorios.relatorio_completo');
    Route::post('relatorios/create_custom_report', 'Admin\RelatoriosController@create_custom_report')
        ->name('admin.relatorios.personalizados');
});


Route::post('users/update/{user}', 'Admin\UsersController@update')->name('users.update');
Route::post('users/store/{user}', 'Admin\UsersController@store')->name('users.store');
Route::get('users/perfil', 'Admin\UsersController@userPerfil')->name('users.perfil');
Route::get('admin/laudos/search/{rep}', 'Admin\LaudosController@search')->name('admin.laudos.search');
/* Busca de Usuarios*/
//-------------------------------------------------------------------------------------------------------------
Route::get('admin/users/search', 'Admin\UsersController@search')->name('users.search');
Route::get('admin/users/search/nao_cadastrados', 'Admin\UsersController@naoCadastrados')->name('naoCadastrados');

//--------------------------------------------------------------------------------------------------------------
Route::get('admin/laudos', 'Admin\LaudosController@index')->name('admin.laudos.index');
/* Peritos routes */
Route::resource('laudos', 'Perito\LaudosController')->except(['edit']);
Route::get('/create/', 'Perito\LaudosController@create')->name('laudos.rep');

Route::get('/show_materias/{laudo_id}', 'Perito\LaudosController@show_materias')->name('show_materias');
Route::get('/meus_laudos/', 'Perito\LaudosController@meusLaudos')->name('meus_laudos');
Route::get('/atualiza/{exame}', 'Perito\LaudosController@atualiza')->name('laudos.atualiza');
Route::get('laudos/search/{rep}', 'Perito\LaudosController@search');

Route::get('laudos/solicitantes/cidade/{cidade_id}',
    'Perito\OrgaosSolicitantesController@filtrar_por_cidade')->name('solicitantes.filtrar');



Route::post('laudos/armas/{arma}/images', 'Perito\ArmasController@store_image')->name('armas.images');
Route::delete('laudos/armas/{arma}/images', 'Perito\ArmasController@delete_image')->name('armas.images.delete');
/* Passando dois parametros a rota laudo e arma, para ser editado */
Route::prefix('laudos/{laudo}/{arma}')->group(function () {
    Route::get('espingardas.edit_gdl', 'Perito\Armas\EspingardasController@edit_gdl')->name('edit_gdl_espingarda');
    Route::get('revolveres.edit_gdl', 'Perito\Armas\RevolveresController@edit_gdl')->name('edit_gdl_revolver');
    Route::get('pistolas.edit_gdl', 'Perito\Armas\PistolasController@edit_gdl')->name('edit_gdl_pistola');
    Route::get('fuzils.edit_gdl', 'Perito\Armas\FuzilsController@edit_gdl')->name('edit_gdl_fuzil');
    Route::get('garruchas.edit_gdl', 'Perito\Armas\GarruchasController@edit_gdl')->name('edit_gdl_garrucha');
    Route::get('metralhadoras.edit_gdl', 'Perito\Armas\MetralhadorasController@edit_gdl')->name('edit_gdl_metralhadora');
    Route::get('submetralhadoras.edit_gdl', 'Perito\Armas\SubmetralhadorasController@edit_gdl')->name('edit_gdl_submetralhadora');
    Route::get('pistoletes.edit_gdl', 'Perito\Armas\PistoletesController@edit_gdl')->name('edit_gdl_pistolete');
    Route::get('carabinas.edit_gdl', 'Perito\Armas\CarabinasController@edit_gdl')->name('edit_gdl_carabina');
});

Route::prefix('laudos/{laudo}')->group(function () {
    Route::get('materiais', 'Perito\LaudosController@materiais')->name('laudos.materiais');
    Route::get('gerar_docx', 'Perito\LaudosController@generate_docx')->name('laudos.docx');
    Route::resource('revolveres', 'Perito\Armas\RevolveresController')
        ->parameters(['revolveres' => 'revolver']);
    Route::resource('espingardas', 'Perito\Armas\EspingardasController');

    Route::get('espingardas.update_gdl', 'Perito\Armas\EspingardasController@update_gdl')->name('update_gdl');
    

    Route::resource('carabinas', 'Perito\Armas\CarabinasController');

    Route::resource('metralhadoras', 'Perito\Armas\MetralhadorasController');
    Route::resource('submetralhadoras', 'Perito\Armas\SubmetralhadorasController');
    Route::resource('fuzils', 'Perito\Armas\FuzilsController');
    Route::resource('pistoletes', 'Perito\Armas\PistoletesController');
    Route::resource('espingardamistas', 'Perito\Armas\EspingardamistasController');

    Route::resource('espingardas_artesanais', 'Perito\Armas\EspingardasArtesanaisController')
        ->parameters(['espingardas_artesanais' => 'espingarda']);
    Route::resource('garruchas', 'Perito\Armas\GarruchasController');
    Route::resource('pistolas', 'Perito\Armas\PistolasController');
    Route::resource('pressaocarabinas', 'Perito\Armas\PressaoCarabinaController');
    Route::resource('pressaopistolas', 'Perito\Armas\PressaoPistolaController');
    

    Route::delete('armas/{arma}', 'Perito\ArmasController@destroy')->name('armas.destroy');

    Route::resource('municoes', 'Perito\Municoes\MunicoesController')
        ->parameters(['municoes' => 'municao'])->except(['create', 'index', 'show']);

    Route::resource('municoes/armas_curtas', 'Perito\Municoes\CartuchosController')
        ->parameters(['armas_curtas' => 'municao'])->only(['create', 'edit', 'show']);

    Route::resource('municoes/armas_longas', 'Perito\Municoes\EstojosController')
        ->parameters(['armas_longas' => 'municao'])->only(['create', 'edit', 'show']);

    Route::resource('componentes', 'Perito\Componentes\ComponentesController')
        ->except(['create', 'index']);

    Route::resource('componentes/balins_chumbo', 'Perito\Componentes\BalinsChumboController')
        ->parameters(['balins_chumbo' => 'componente'])->only(['create', 'edit']);

    

    
        

    Route::resource('componentes/simulacros', 'Perito\Componentes\SimulacroController')
        ->parameters(['simulacros' => 'componente'])->only(['create', 'edit']);


    Route::resource('componentes/polvora', 'Perito\Componentes\PolvoraController')
        ->parameters(['polvora' => 'componente'])->only(['create', 'edit']);
});

Route::get('solicitantes', 'Perito\OrgaosSolicitantesController@store')->name('perito.solicitante.store');
Route::get('marcas', 'Perito\MarcasController@store')->name('perito.marcas.store');
Route::get('calibres', 'Perito\CalibresController@store')->name('perito.calibres.store');
Route::get('origens', 'Perito\OrigensController@store')->name('perito.origens.store');
Route::resource('cadastros','CadastrarusuarioController');
Route::post('cadastros.store', 'CadastrarusuarioController@store');
Route::post('/cadastros/{usuario}', 'CadastrarusuarioController@destroy')->name('cadastros.destroy');

Route::post('/cadastro_armas/{arma}', 'Admin\CadastroarmasController@store');
Route::delete('/cadastro_armas.delete/{arma}', 'Admin\CadastroarmasController@delete')->name('cadastroArmaDelete');

Route::post('imagens.store','Perito\CadastrarImagensController@store')->name('imagens');
Route::get('imagens.destroy/{image}','Perito\CadastrarImagensController@destroy')->name('imagemCartuchoExcluir');

Route::post('imagensProjetil.store','Perito\CadastrarImagensProjetilController@store')->name('imagensProjetil');
Route::get('imagensProjetil.destroy/{image}','Perito\CadastrarImagensProjetilController@destroy')->name('imagemProjetilExcluir');

Route::post('imagensEmbalagem.store','Perito\CadastrarImagensEmbalagemController@store')->name('embalagem');


Route::post('imagensEmbalagemEditar.update','Perito\CadastrarImagensEmbalagemController@update')->name('editar_embalagem');

Route::get('imagensEmbalagem.destroy/{image}','Perito\CadastrarImagensEmbalagemController@destroy')->name('imagemExcluir');

Route::get('reportar.index','ReportaController@index')->name('reportar.index');
Route::post('/reportar.store','ReportaController@store');

Route::post('buscaGdl.create','buscaGdlController@create')->name('buscaGdl.create');

//rotas para verificar as notificações de modelo de armas
Route::get('/check-notifications', function() {
  
    $notificacoes = Auth::user()->unreadNotifications->where('data.mensagem', 'modelo armas');

    return response()->json([
        'hasNotifications' => $notificacoes->isNotEmpty()
    ]);
});

// rota para notificação de usuarios 
Route::get('/check-notifications-usuarios', function() {
  
    $notificacoes = Auth::user()->unreadNotifications->where('data.mensagem', 'usuarios a ser cadastrado');

    return response()->json([
        'notificationUser' => $notificacoes->isNotEmpty()
    ]);
});
// rota para notificação de usuarios 
Route::get('/notifications', function() {
  
    $notificacoes = Auth::user()->unreadNotifications;

    return response()->json([
        'notification' => $notificacoes->isNotEmpty()
    ]);
});
//Rotas de chassi
//Exibe a Tela para escolha dos veiculos
Route::post('chassi','Perito\Chassis\ChassisController@store')->name('chassi.index');
Route::get('motocicleta.index','Perito\Chassis\MotocicletasController@index')->name('motocicleta.index');

//Rotas Motocicleta Tela 1 da Motocicleta--------------------------------------------------------------------------
Route::get('motocicleta.tela2/{laudo}', 'Perito\Chassis\MotocicletasController@tela2')->name('motocicletas.tela2');
//exibe a tela 2 de fotos
Route::post('motocicleta.tela3', 'Perito\Chassis\MotocicletasController@tela3')->name('motocicletas.tela3');
//exibe a tela 3 de chassi/motor
Route::post ('motocicleta.tela4' , 'Perito\Chassis\MotocicletasController@tela4')->name ('motocicleta.tela4');
//exibe tela final Motocicleta 
Route::post('motocicleta.exame', 'Perito\Chassis\MotocicletasController@exame')->name('motocicleta.exame');
//-----------------------------------------------------------------------------------------------------------------


//Rotas para Carro Tela 1 -----------------------------------------------------------------------------------------
Route::get('carro.index ','Perito\Chassis\CarroController@index')->name('carro.index');
//Rota para tela de fotos
Route::post('carro.tela1', 'Perito\Chassis\CarroController@tela1') -> name ('carro.tela1');
Route::get('carro/tela1', 'Perito\Chassis\CarroController@tela1')->name('carro.tela1');

//Rota para a tela Chassi/Motor
Route::post('carro.tela2', 'Perito\Chassi\CarroController@tela2') -> name ('carro.tela2');
//Rota para a tela final de Carro
Route::post('carro.tela3', 'Perito\Chassis\CarroController@tela3') -> name ('carro.tela3');
//-----------------------------------------------------------------------------------------------------------------


//Rotas para Caminhão (Está funcionando) Tela 1--------------------------------------------------------------------
Route::get('caminhao.index','Perito\Chassis\CaminhaoController@index')->name('caminhao.index');
//Rota para tela de fotos
Route::post('caminhao.tela1', 'Perito\Chassis\CaminhaoController@tela1') -> name ('caminhao.tela1');
//Rota para a tela Chassi/Motor
Route::post('caminhao.tela2', 'Perito\Chassis\CaminhaoController@tela2') -> name ('caminhao.tela2');
//Rota para final de Caminhão
Route::post('caminhao.tela3', 'Perito\Chassis\CaminhaoController@tela3') -> name ('caminhao.tela3');
//-----------------------------------------------------------------------------------------------------------------


//Rotas de Semi-reboque (Está funcionando) Tela 1------------------------------------------------------------------
Route::get('semireboque.index','Perito\Chassis\SemiReboqueController@index') -> name ('semireboque.index');
//Rota para a tela de fotos
Route::post('semireboque.tela1', 'Perito\Chassis\SemiReboqueController@tela1') -> name ('semireboque.tela1');
//Rota para a tela Chassi/Motor
Route::post('semireboque.tela2', 'Perito\Chassis\SemiReboqueController@tela2') -> name ('semireboque.tela2');
//Rota para a tela final de Semi-Reboque
Route::post('semireboque.tela3', 'Perito\Chassis\SemiReboqueController@tela3') -> name ('semireboque.tela3');
//-----------------------------------------------------------------------------------------------------------------


//Rotas de Onibus (Está funcionando) Tela 1------------------------------------------------------------------------
Route::get('onibus.index','Perito\Chassis\OnibusController@index') -> name('onibus.index');
//Rota para a tela de fotos
Route::post('onibus.tela1', 'Perito\Chassis\OnibusController@tela1') -> name ('onibus.tela1');
//Rota para a tela Chassi/Motor 
Route::post('onibus.tela2', 'Perito\Chassis\OnibusController@tela4') -> name ('onibus.tela2');
//Rota para a tela final de Onibus
Route::post('onibus.tela3', 'Perito\Chassis\OnibusController@tela3') -> name ('onibus.tela3');
//-----------------------------------------------------------------------------------------------------------------


//Rotas de Outros (Está funcionando) Tela 1------------------------------------------------------------------------
Route::get('outros.index', 'Perito\Chassi\OutrosController@index') -> name ('outros.index');
//Rota para a tela de fotos
Route::post('outros.tela1', 'Perito\Chassis\OutrosController@tela1') -> name ('outros.tela1');
//Rota para a tela Chassi/Motor
Route::post('outros.tela2', 'Perito\Chassis\OutrosController@tela2') -> name ('outros.tela2');
//Rota para a tela final de Outros
Route::post('outros.tela3', 'Perito\Chassis\OutrosController@tela3') -> name ('outros.tela3');
//-----------------------------------------------------------------------------------------------------------------


//Salvar a cor escolhida no banco
Route::post('/veiculo/salvar', [MotocicletasController::class, 'storeVeiculo'])->name('veiculo.salvar');







Route::post('/inspecaoVeiculo', [MotocicletasController::class, 'inspecaoVeiculo'])->name('inspecao.veiculo');




Route::get('laudosChassi.docx/{laudo}', 'Perito\Chassis\ChassisController@generate_docx')->name('laudosChassi.docx');

//Rotas de editar e deletar

Route::get('/editar/{id}', [MotocicletasController::class, 'edite'])->name('editar');

Route::delete('/deletar/{id}', [MotocicletasController::class, 'delete'])->name('deletar');



// Rota de teste para deletar

Route::delete('/veiculo/{id}', [VeiculoController::class, 'destroy'])->name('veiculo.deletar');





