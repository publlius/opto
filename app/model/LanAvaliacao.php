<?php

class LanAvaliacao extends TRecord
{
    const TABLENAME  = 'lan_avaliacao';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $cad_paciente;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('data_avaliacao');
        parent::addAttribute('cad_paciente_id');
        parent::addAttribute('idade_atual');
        parent::addAttribute('anamnese');
        parent::addAttribute('avsc_longe_1');
        parent::addAttribute('avsc_perto_1');
        parent::addAttribute('avsc_ph_1');
        parent::addAttribute('avsc_longe_2');
        parent::addAttribute('avsc_perto_2');
        parent::addAttribute('avsc_ph_2');
        parent::addAttribute('avsc_longe_3');
        parent::addAttribute('avsc_perto_3');
        parent::addAttribute('avsc_ph_3');
        parent::addAttribute('ref_pup_1');
        parent::addAttribute('ref_pup_2');
        parent::addAttribute('ref_pup_3');
        parent::addAttribute('kappa_od_1');
        parent::addAttribute('kappa_od_2');
        parent::addAttribute('kappa_oe_1');
        parent::addAttribute('kappa_oe_2');
        parent::addAttribute('hischberg');
        parent::addAttribute('ct_06m_01');
        parent::addAttribute('ct_06m_02');
        parent::addAttribute('ct_40m_01');
        parent::addAttribute('ct_40m_02');
        parent::addAttribute('ct_20m_01');
        parent::addAttribute('ct_20m_02');
        parent::addAttribute('ct_outro_01');
        parent::addAttribute('ct_outro_02');
        parent::addAttribute('fo_od');
        parent::addAttribute('fo_od_fixacao');
        parent::addAttribute('fo_oe');
        parent::addAttribute('fo_oe_fixacao');
        parent::addAttribute('ret_estat_01');
        parent::addAttribute('ret_estat_02');
        parent::addAttribute('ret_estat_03');
        parent::addAttribute('ret_estat_04');
        parent::addAttribute('ret_estat_05');
        parent::addAttribute('ret_estat_06');
        parent::addAttribute('ret_estat_07');
        parent::addAttribute('ret_estat_08');
        parent::addAttribute('auto_01');
        parent::addAttribute('auto_02');
        parent::addAttribute('auto_03');
        parent::addAttribute('auto_04');
        parent::addAttribute('auto_05');
        parent::addAttribute('auto_06');
        parent::addAttribute('auto_07');
        parent::addAttribute('auto_08');
        parent::addAttribute('subjetivo_01');
        parent::addAttribute('subjetivo_02');
        parent::addAttribute('subjetivo_03');
        parent::addAttribute('subjetivo_04');
        parent::addAttribute('subjetivo_05');
        parent::addAttribute('subjetivo_06');
        parent::addAttribute('subjetivo_07');
        parent::addAttribute('subjetivo_08');
        parent::addAttribute('afinam_01');
        parent::addAttribute('afinam_02');
        parent::addAttribute('afinam_03');
        parent::addAttribute('afinam_04');
        parent::addAttribute('afinam_05');
        parent::addAttribute('afinam_06');
        parent::addAttribute('afinam_07');
        parent::addAttribute('afinam_08');
        parent::addAttribute('rx_final_ad');
        parent::addAttribute('diag_refrativo_od');
        parent::addAttribute('diag_refrativo_oe');
        parent::addAttribute('diag_motor_od');
        parent::addAttribute('diag_motor_oe');
        parent::addAttribute('diag_patologico_od');
        parent::addAttribute('diag_patologico_oe');
        parent::addAttribute('contuta_refrativa');
        parent::addAttribute('contuta_motora');
        parent::addAttribute('contuta_patologica');
        parent::addAttribute('observacoes');
        parent::addAttribute('criado_em');
        parent::addAttribute('criado_por_id');
        parent::addAttribute('atualizado_em');
        parent::addAttribute('atualizado_por_id');
            
    }

    /**
     * Method set_cad_paciente
     * Sample of usage: $var->cad_paciente = $object;
     * @param $object Instance of CadPaciente
     */
    public function set_cad_paciente(CadPaciente $object)
    {
        $this->cad_paciente = $object;
        $this->cad_paciente_id = $object->id;
    }

    /**
     * Method get_cad_paciente
     * Sample of usage: $var->cad_paciente->attribute;
     * @returns CadPaciente instance
     */
    public function get_cad_paciente()
    {
    
        // loads the associated object
        if (empty($this->cad_paciente))
            $this->cad_paciente = new CadPaciente($this->cad_paciente_id);
    
        // returns the associated object
        return $this->cad_paciente;
    }

    
}

