<div class="col-lg-3">
    <div class="form-group">
        <label><strong>Constituição e Formato<code>*</code></strong></label>
        <select required id="constituicao_formato"class="js-single form-control{{ $errors->has('constituicao_formato') ? ' is-invalid' : '' }}" name="constituicao_formato">
            <option></option>
            @foreach ([
                        'CHOG' =>'Chumbo Ogival', 
                        'CHPP' =>'Chumbo Ponta Plana', 
                        'CHCV' =>'Chumbo Canto Vivo', 
                        'CSCV' =>'Chumbo Semi Canto Vivo' ,
                        'CXPO' =>'Cobre Expansivo Ponta Oca', 
                        'EPP'=>'Encamisado Ponta Plana',
                        'EXPP' =>'Encamisado Expansivo Ponta Plana' ,
                        'ETOG' =>'Encamisado Total Ogival' ,
                        'ETPP' =>'Encamisado Total Ponta Plana' ,
                        'ETPO' =>'Encamisado Total Ponta-Oca' ,
                        'ETHS' =>'Encamisado Total Hydra-Shok' ,
                        'ETPT' =>'Encamisado Total Pontiagudo' ,
                        'EXPO' =>'Encamisado Expansivo Ponta Oca' ,
                        'EXPT' =>'Encamisado Expansivo Pontiagudo' ,
                        'ETPT' =>'Encamisado Total Pontiagudo Boat Tail' ,
                        'HPBT' =>'Hollow Point Boat Tail' ,
                        'SEPO' =>'Semi-encamisado Expansivo Ponta Oca',
                        'SEPP' =>'Semi-encamisado Ponta Plana',
                        'SAT' => ' Ponta de Aço',
                        'POLÍMERO'=>'',
                        'FRANGÍVEL'=>'' ,
                        'BALINS CHSG' =>'(Ø8,4mm)',
                        'BALINS CHSG4'=>' (Ø8,8mm)',
                        'BALINS CHTTT' => '(Ø5,5mm)',
                        'BALINS CHT' => '(Ø5mm)',
                        'BALINS CH1' => '(Ø4mm)',
                        'BALINS CH3' => '(Ø3,5mm)',
                        'BALINS CH5' => '(Ø3mm)',
                        'BALINS CH6' => '(Ø2,75mm)',
                        'BALINS CH7' => '(Ø2,5mm)',
                        'BALINS CH8' => '(Ø2,25mm)',
                        'BALINS CH9' => '(Ø2mm)',
                        'BALINS CH11' => '(Ø1,5mm)',
                        'BALINS CH12' => '(Ø1,25mm)',
                        'BALINS'=> 'MULTIPLOS',
                        'BALOTE DE CHUMBO'=>'',
                        'BALOTE SG1'=>'',
                        'BALOTE FOSTER'=>'' ,
                        'CHUMBO AMOLGADO'=>'',
                        'FRAGMENTADO'=>'',
                        'INDERTERMINADO'=>'',
                        'POLYMATCH'=>''
                
                ] as $constituicao_formato=>$extensao)
                <option value="{{ $constituicao_formato}}" {{ ($constituicao_formato == $constituicao_formato2) ? 'selected=selected' : '' }}>
                    {{mb_strtoupper($constituicao_formato)}} {{ mb_strtoupper($extensao)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'constituicao_formato'])
    </div>
</div>


