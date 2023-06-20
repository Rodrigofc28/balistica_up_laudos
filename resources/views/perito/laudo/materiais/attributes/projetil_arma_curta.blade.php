<div class="col-lg-3" id="projetil_cartucho">
    <div class="form-group">
        <label><strong>Projétil <code>*</code></strong></label>
        <select class="js-single-select form-control{{ $errors->has('projetil') ? ' is-invalid' : '' }}"
                name="projetil" id="projetil">
            <option value=""></option>
            @foreach ([
                'CHOG'=>'Chumbo Ogival',
                'CHPP'=>' Chumbo Ponta Plana',
             'CHCV'=>' Chumbo Canto Vivo' ,
             'CSCV'=>' Chumbo Semi Canto Vivo ',
            'CXPO'=>' Cobre Expansivo Ponta Oca',
            'EPP'=>'Encamisado Ponta Plana',
            'EXPP'=>'Encamisado Expansivo Ponta Plana',
            'ETOG'=>'Encamisado Total Ogival',
            'ETPP'=>'Encamisado Total Ponta Plana',
            'ETPP'=>' Encamisado Total Ponta-Oca',
            'ETHS'=>' Encamisado Total Hydra-Shok',
            'ETPT'=>' Encamisado Total Pontiagudo',
            'EXPO'=>' Encamisado Expansivo Ponta Oca',
            'EXPT'=>' Encamisado Expansivo Pontiagudo',
            'ETPT'=> ' Encamisado Total Pontiagudo Boat Tail',
            'HPBT'=>' Hollow Point Boat Tail',
            'SEPO'=>' Semi-encamisado Expansivo Ponta Oca',
            'SEPP'=>' Semi-encamisado Ponta Plana',
            'SAT'=>' Ponta de Aço',
            'POLÍMERO'=>'',
            'FRANGÍVEL'=>'',
            'BALINS CHSG'=> '(Ø8,4mm)',
            'BALINS CHSG4'=> '(Ø8,8mm)',
            'BALINS CHTTT'=> '(Ø5,5mm)',
            'BALINS CHT'=> '(Ø5mm)',
            'BALINS CH1'=> '(Ø4mm)',
            'BALINS CH3'=> '(Ø3,5mm)',
            'BALINS CH5'=> '(Ø3mm)',
            'BALINS CH6'=> '(Ø2,75mm)',
            'BALINS CH7'=> '(Ø2,5mm)',
            'BALINS CH8'=> '(Ø2,25mm)',
            'BALINS CH9'=> '(Ø2mm)',
            'BALINS CH11'=> '(Ø1,5mm)',
            'BALINS CH12'=> '(Ø1,25mm)',
            'BALINS Multiplos'=>'',
            'BALOTE DE CHUMBO'=>'',
            'BALOTE SG1'=>'',
            'BALOTE FOSTER'=>'',
            'POLYMATCH'=>''
            ] as $projetil=>$especificacao)
                <option value="{{ mb_strtoupper($projetil)}}" {{ (mb_strtolower($projetil) == mb_strtolower($projetil2)) ? 'selected=selected' : '' }}>
                {{mb_strtoupper($projetil)}}-{{mb_strtoupper($especificacao)}}
                </option>
            @endforeach
        </select>
        @include('shared.error_feedback', ['name' => 'projetil'])
    </div>
</div>