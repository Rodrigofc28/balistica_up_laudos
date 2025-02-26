<?php

namespace App\Http\Controllers\Perito\Chassis;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Laudo;
use App\Models\VeiculoInspecao;
use App\Models\ChassiDate\Chassi;
class MotocicletasController extends Controller
{
   public function index(Laudo $laudo){

        return view('perito.chassi.index',compact('laudo'));
   }
   public function tela2(Laudo $laudo){
      
      return view('perito.chassi.veiculos.moto.motocicleta.index',compact('laudo'));
   }
   public function tela3(Request $request){
    
       $laudo=Laudo::find($request->laudo_id);
       //salva os dados
       Chassi::create($request->all());
       //update dos dados
       $chassi = Chassi::where('laudo_id', $request->laudo_id)->first();
       $chassi->update($request->all());
      return view('perito.chassi.veiculos.moto.motocicleta.telaum',compact('laudo','chassi'));

      // $chassi = Chassi::where('laudo_id', $request->laudo_id)->first();
       //$chassi->update($request->all());
      return view('perito.chassi.veiculos.moto.motocicleta.telaum',compact('laudo'));

   }
   public function tela4(Request $request){

      if ($request->hasFile('imagem1')) {
         $image1 = base64_encode(file_get_contents($request->file('imagem1')));
         
      }

      if ($request->hasFile('imagem2')) {
         $image2 = base64_encode(file_get_contents($request->file('imagem2')));
         
      }
      $laudo=Laudo::find($request->laudo_id);
      $chassi = Chassi::where('laudo_id', $request->laudo_id)->first();
      $chassi->update([
         'image1' => $image1,
         'image2' => $image2
      ]);
      return view('perito.chassi.veiculos.moto.motocicleta.teladois',compact('laudo'));
      }
   public function exame(Request $request) {
  
      $laudo=Laudo::find($request->laudo_id);

      
      $chassi = Chassi::where('laudo_id', $request->laudo_id)->first();
      $chassi->update($request->all());
      VeiculoInspecao::create($request->all());
      return view('perito.chassi.veiculos.moto.motocicleta.show',compact('chassi','laudo'));
  }
  //funções de deletar e editar
  public function delete($id)
    {
        // Encontra o registro pelo ID e deleta
        $registro = Chassi::find($id);
        if ($registro) {
            $registro->delete();
            return redirect()->back()->with('success', 'Registro deletado com sucesso!');
        }
        return redirect()->back()->with('error', 'Registro não encontrado!');
    }

    public function edite($id)
    {
        // Encontra o registro pelo ID e retorna para a view de edição
        $registro = Chassi::find($id);
        if ($registro) {
            return view('sua_view_de_edicao', compact('registro'));
        }
        return redirect()->back()->with('error', 'Registro não encontrado!');
    }
    // VeiculoController.php
public function destroy($id)
{
    // Buscar o veículo pelo id e deletar
    $veiculo = Veiculo::findOrFail($id);
    $veiculo->delete();

    // Redirecionar de volta com uma mensagem de sucesso
    return redirect()->route('veiculo.index')->with('success', 'Veículo deletado com sucesso!');
}
// Adicionando métodos de busca no Controller

public function buscarMarcas(Request $request)
{
    // Verifique se o usuário digitou algo
    if ($request->has('query')) {
        $query = $request->input('query');
        
        // Buscar marcas que contenham a string
        $marcas = Marca::where('nome', 'like', "%$query%")->get();

        return response()->json($marcas);
    }

    return response()->json([]);
}

public function buscarModelos(Request $request)
{
    // Verifique se o usuário digitou algo
    if ($request->has('query')) {
        $query = $request->input('query');

        // Buscar modelos que contenham a string
        $modelos = Modelo::where('nome', 'like', "%$query%")->get();

        return response()->json($modelos);
    }

    return response()->json([]);
}
public function salvar(Request $request)
{
    // Validação dos dados do formulário
    $request->validate([
        'cor_selecionada' => 'required|string|max:100',
        // Outras validações...
    ]);

    // Salvar no banco de dados
    $veiculo = new Veiculo();
    $veiculo->cor = $request->input('cor_selecionada'); // Usar o valor de cor_selecionada
    $veiculo->marca_fabricacao = $request->input('marca_fabricacao');
    $veiculo->modelo = $request->input('modelo');
    $veiculo->ano = $request->input('ano');
    $veiculo->placa = $request->input('placa');
    $veiculo->estado_conservacao = $request->input('estado_conservacao');
    // Outros campos...

    $veiculo->save();

    return redirect()->back()->with('success', 'Veículo salvo com sucesso!');
}

public function inspecaoVeiculo(Request $request) {
    // Validação dos dados
    $request->validate([
        'motor_tipo_adulteracao' => 'nullable|string|max:200',
        'transplante_chassi' => 'nullable|string',
        'reparo_chassi' => 'nullable|string',
        'transplante_motor' => 'nullable|string',
        'reparo_motor' => 'nullable|string',
        // Outras validações...
    ]);

    // Atualiza o chassi
    $laudo = Laudo::find($request->laudo_id);
    $chassi = Chassi::where('laudo_id', $request->laudo_id)->first();
    $chassi->update($request->all());

    // Cria a inspeção do veículo
    VeiculoInspecao::create([
        'laudo_id' => $request->laudo_id,
        'transplante_chassi' => $request->transplante_chassi,
        'reparo_chassi' => $request->reparo_chassi,
        'motor_tipo_adulteracao' => $request->motor_tipo_adulteracao, // Campo adicional
        'transplante_motor' => $request->transplante_motor,
        'reparo_motor' => $request->reparo_motor,
        // Outros campos...
    ]);

    return view('perito.chassi.veiculos.moto.motocicleta.show', compact('chassi', 'laudo'));
}


}