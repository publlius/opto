<?php

class CadPaciente extends TRecord
{
    const TABLENAME  = 'cad_paciente';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('sobrenome');
        parent::addAttribute('data_nascimento');
        parent::addAttribute('numero_rg');
        parent::addAttribute('numero_cpf');
        parent::addAttribute('cidade');
        parent::addAttribute('endereco_residencial');
        parent::addAttribute('bairro_residencial');
        parent::addAttribute('referencia_residencial');
        parent::addAttribute('endereco_comercial');
        parent::addAttribute('fone_01');
        parent::addAttribute('observacoes');
        parent::addAttribute('criado_em');
        parent::addAttribute('atualizado_em');
        parent::addAttribute('criado_por_id');
        parent::addAttribute('atualizado_por_id');
            
    }

    /**
     * Method getLanAvaliacaos
     */
    public function getLanAvaliacaos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('cad_paciente_id', '=', $this->id));
        return LanAvaliacao::getObjects( $criteria );
    }

    public function set_lan_avaliacao_cad_paciente_to_string($lan_avaliacao_cad_paciente_to_string)
    {
        if(is_array($lan_avaliacao_cad_paciente_to_string))
        {
            $values = CadPaciente::where('id', 'in', $lan_avaliacao_cad_paciente_to_string)->getIndexedArray('id', 'id');
            $this->lan_avaliacao_cad_paciente_to_string = implode(', ', $values);
        }
        else
        {
            $this->lan_avaliacao_cad_paciente_to_string = $lan_avaliacao_cad_paciente_to_string;
        }

        $this->vdata['lan_avaliacao_cad_paciente_to_string'] = $this->lan_avaliacao_cad_paciente_to_string;
    }

    public function get_lan_avaliacao_cad_paciente_to_string()
    {
        if(!empty($this->lan_avaliacao_cad_paciente_to_string))
        {
            return $this->lan_avaliacao_cad_paciente_to_string;
        }
    
        $values = LanAvaliacao::where('cad_paciente_id', '=', $this->id)->getIndexedArray('cad_paciente_id','{cad_paciente->id}');
        return implode(', ', $values);
    }

    
}

