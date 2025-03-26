<?php

namespace App\Http\Controllers\Perito\Chassis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Laudo;
use App\Models\VeiculoInspecao;
use App\Models\ChassiDate\Chassi;
use App\Models\Veiculo;
use App\Models\Marca;

class MotocicletasController extends Controller
{
    /* O que essa função faz? */
    /*public function index(Laudo $laudo)
    {
        return view('perito.chassi.index', compact('laudo'));
    }*/

    public function tela1(Laudo $laudo)
    {
        return view('perito.chassi.veiculos.moto.motocicleta.index', compact('laudo'));
    }    
    
//teste veiculo tela 1 motocicleta para tela 2, bug relogar
  /*  public function veiculoTela2(Request $request)
{
    $laudo = Laudo::find($request->laudo_id);
    $veiculo = Veiculo::where('laudo_id', $request->laudo_id)->first();

    if ($veiculo) {
        $veiculo->update($request->all());
    }

    $dadosRequest = $request->all();
    $dadosRequestJson = json_encode($dadosRequest);
    $listaJson = array_map('json_encode', $_SESSION['VeiculoInseridosTela2']);

    if (!in_array($dadosRequestJson, $listaJson)) {
        Veiculo::create($request->all()); // Insere na tabela 'veiculo'
        $_SESSION['VeiculoInseridosTela2'][] = $dadosRequest; // Adiciona à sessão
    }

    return view('perito.chassi.veiculos.moto.motocicletatelaum', compact('veiculo', 'laudo'));
}

*/

    public function tela2(Request $request, $laudo)
    {
        $laudo = Laudo::find($request->laudo_id);

        // Salva os dados do chassi
        Chassi::create($request->all());

        // Atualiza os dados
        $chassi = Chassi::where('laudo_id', $request->laudo_id)->first();
        if ($chassi) {
            $chassi->update($request->all());
        }

        return view('perito.chassi.veiculos.moto.motocicleta.telaum', compact('laudo', 'chassi'));
    }

    public function tela4(Request $request)
    {
        $laudo = Laudo::find($request->laudo_id);
        $chassi = Chassi::where('laudo_id', $request->laudo_id)->first();

        if ($chassi) {
            $data = [];

            if ($request->hasFile('imagem1')) {
                $data['image1'] = base64_encode(file_get_contents($request->file('imagem1')));
            }

            if ($request->hasFile('imagem2')) {
                $data['image2'] = base64_encode(file_get_contents($request->file('imagem2')));
            }

            $chassi->update($data);
        }

        return view('perito.chassi.veiculos.moto.motocicleta.teladois', compact('laudo'));
    }

    //Bug do relogar na tela 4 resolvido V
//-------------------------------------------------------------------------------
    public function exame(Request $request)
    {
        $laudo = Laudo::find($request->laudo_id);
        $chassi = Chassi::where('laudo_id', $request->laudo_id)->first();

        if ($chassi) {
            $chassi->update($request->all());
        }
      
        $dadosRequest = $request->all(); // Obtém os dados do request

        $dadosRequestJson = json_encode($dadosRequest);
        $listaJson = array_map('json_encode', $_SESSION['VeiculoInspecaoInseridos']);
      

        if (!in_array($dadosRequestJson, $listaJson)) {
           VeiculoInspecao::create($request->all());

            $_SESSION['VeiculoInspecaoInseridos'][] = $dadosRequest;
        } 
        return view('perito.chassi.veiculos.moto.motocicleta.show', compact('chassi', 'laudo'));
    }
//--------------------------------------------------------------------------------


    // Função para deletar um chassi
    public function delete($id)
    {
        $registro = Chassi::find($id);

        if ($registro) {
            $registro->delete();
            return redirect()->back()->with('success', 'Registro deletado com sucesso!');
        }

        return redirect()->back()->with('error', 'Registro não encontrado!');
    }

    // Função para editar um chassi
    public function edite($id)
    {
        $registro = Chassi::find($id);

        if ($registro) {
            return view('sua_view_de_edicao', compact('registro'));
        }

        return redirect()->back()->with('error', 'Registro não encontrado!');
    }

    // Função para deletar um veículo
    public function destroy($id)
    {
        $veiculo = Veiculo::findOrFail($id);
        $veiculo->delete();

        return redirect()->route('veiculo.index')->with('success', 'Veículo deletado com sucesso!');
    }

    // Métodos de busca

    public function buscarMarcas(Request $request)
    {
        $termo = $request->input('termo');
        $marcas = Veiculo::where('marca_fabricacao', 'LIKE', "%$termo%")
                         ->distinct()
                         ->pluck('marca_fabricacao');

        return response()->json($marcas);
    }

    public function buscarModelos(Request $request)
    {
        $termo = $request->input('termo');
        $modelos = Veiculo::where('modelo', 'LIKE', "%$termo%")
                          ->distinct()
                          ->pluck('modelo');

        return response()->json($modelos);
    }

    // Adicionar novo veículo
    public function adicionar(Request $request)
    {
        $request->validate([
            'marca_fabricacao' => 'required',
            'modelo' => 'required',
            'ano' => 'required|integer',
            'ano_fab' => 'required|integer',
            'placa' => 'required',
            'estado_conservacao' => 'required',
            'cor' => 'nullable',
        ]);

        $veiculo = Veiculo::create($request->all());

        return response()->json($veiculo);
    }
}


