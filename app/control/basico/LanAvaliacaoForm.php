<?php

class LanAvaliacaoForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'opto';
    private static $activeRecord = 'LanAvaliacao';
    private static $primaryKey = 'id';
    private static $formName = 'form_LanAvaliacao';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Cadastro de avaliação");


        $id = new TEntry('id');
        $data_avaliacao = new TDate('data_avaliacao');
        $cad_paciente_id = new TDBUniqueSearch('cad_paciente_id', 'opto', 'CadPaciente', 'id', 'nome','nome asc'  );
        $idade_atual = new TEntry('idade_atual');
        $anamnese = new TText('anamnese');
        $avsc_longe_1 = new TEntry('avsc_longe_1');
        $avsc_longe_2 = new TEntry('avsc_longe_2');
        $avsc_perto_1 = new TEntry('avsc_perto_1');
        $avsc_perto_2 = new TEntry('avsc_perto_2');
        $avsc_ph_1 = new TEntry('avsc_ph_1');
        $avsc_ph_2 = new TEntry('avsc_ph_2');
        $ref_pup_1 = new TCombo('ref_pup_1');
        $ref_pup_2 = new TCombo('ref_pup_2');
        $ref_pup_3 = new TCombo('ref_pup_3');
        $kappa_od_1 = new TCombo('kappa_od_1');
        $kappa_oe_1 = new TCombo('kappa_oe_1');
        $hischberg = new TCombo('hischberg');
        $ct_06m_01 = new TEntry('ct_06m_01');
        $ct_40m_01 = new TEntry('ct_40m_01');
        $ct_20m_02 = new TEntry('ct_20m_02');
        $fo_od = new TEntry('fo_od');
        $fo_od_fixacao = new TEntry('fo_od_fixacao');
        $fo_oe = new TEntry('fo_oe');
        $fo_oe_fixacao = new TEntry('fo_oe_fixacao');
        $auto_01 = new TEntry('auto_01');
        $auto_02 = new TEntry('auto_02');
        $auto_03 = new TEntry('auto_03');
        $auto_04 = new TEntry('auto_04');
        $auto_05 = new TEntry('auto_05');
        $auto_06 = new TEntry('auto_06');
        $auto_07 = new TEntry('auto_07');
        $auto_08 = new TEntry('auto_08');
        $ret_estat_01 = new TEntry('ret_estat_01');
        $ret_estat_02 = new TEntry('ret_estat_02');
        $ret_estat_03 = new TEntry('ret_estat_03');
        $ret_estat_04 = new TEntry('ret_estat_04');
        $ret_estat_05 = new TEntry('ret_estat_05');
        $ret_estat_06 = new TEntry('ret_estat_06');
        $ret_estat_07 = new TEntry('ret_estat_07');
        $ret_estat_08 = new TEntry('ret_estat_08');
        $subjetivo_01 = new TEntry('subjetivo_01');
        $subjetivo_02 = new TEntry('subjetivo_02');
        $subjetivo_03 = new TEntry('subjetivo_03');
        $subjetivo_04 = new TEntry('subjetivo_04');
        $subjetivo_05 = new TEntry('subjetivo_05');
        $subjetivo_06 = new TEntry('subjetivo_06');
        $subjetivo_07 = new TEntry('subjetivo_07');
        $subjetivo_08 = new TEntry('subjetivo_08');
        $afinam_01 = new TEntry('afinam_01');
        $afinam_02 = new TEntry('afinam_02');
        $afinam_03 = new TEntry('afinam_03');
        $afinam_04 = new TEntry('afinam_04');
        $afinam_05 = new TEntry('afinam_05');
        $afinam_06 = new TEntry('afinam_06');
        $afinam_07 = new TEntry('afinam_07');
        $afinam_08 = new TEntry('afinam_08');
        $rx_final_ad = new TEntry('rx_final_ad');
        $diag_refrativo_od = new TEntry('diag_refrativo_od');
        $diag_refrativo_oe = new TEntry('diag_refrativo_oe');
        $diag_motor_od = new TEntry('diag_motor_od');
        $diag_motor_oe = new TEntry('diag_motor_oe');
        $diag_patologico_od = new TEntry('diag_patologico_od');
        $diag_patologico_oe = new TEntry('diag_patologico_oe');
        $contuta_refrativa = new TEntry('contuta_refrativa');
        $contuta_motora = new TEntry('contuta_motora');
        $contuta_patologica = new TEntry('contuta_patologica');
        $observacoes = new TText('observacoes');

        $data_avaliacao->addValidation("Data avaliacao", new TRequiredValidator()); 
        $cad_paciente_id->addValidation("Paciente", new TRequiredValidator()); 
        $idade_atual->addValidation("Idade atual", new TRequiredValidator()); 
        $anamnese->addValidation("Anamnese", new TRequiredValidator()); 

        $id->setEditable(false);
        $data_avaliacao->setDatabaseMask('yyyy-mm-dd');
        $cad_paciente_id->setMinLength(3);

        $cad_paciente_id->setMask('{nome} ');
        $data_avaliacao->setMask('dd/mm/yyyy');

        $ref_pup_1->addItems(['PR'=>'PR','NR'=>'NR']);
        $ref_pup_2->addItems(['PR'=>'PR','NR'=>'NR']);
        $ref_pup_3->addItems(['PR'=>'PR','NR'=>'NR']);
        $kappa_od_1->addItems(['(+)'=>'(+)','(-)'=>'(-)','(0)'=>'(0)']);
        $kappa_oe_1->addItems(['(+)'=>'(+)','(-)'=>'(-)','(0)'=>'(0)']);
        $hischberg->addItems(['Centrado'=>'Centrado','Descentrado'=>'Descentrado']);

        $fo_oe->setMaxLength(255);
        $fo_od->setMaxLength(255);
        $auto_02->setMaxLength(255);
        $auto_03->setMaxLength(255);
        $auto_08->setMaxLength(255);
        $auto_07->setMaxLength(255);
        $auto_06->setMaxLength(255);
        $auto_05->setMaxLength(255);
        $auto_04->setMaxLength(255);
        $auto_01->setMaxLength(255);
        $avsc_ph_1->setMaxLength(255);
        $avsc_ph_2->setMaxLength(255);
        $ct_06m_01->setMaxLength(255);
        $ct_40m_01->setMaxLength(255);
        $ct_20m_02->setMaxLength(255);
        $idade_atual->setMaxLength(255);
        $avsc_longe_1->setMaxLength(255);
        $avsc_perto_2->setMaxLength(255);
        $avsc_perto_1->setMaxLength(255);
        $avsc_longe_2->setMaxLength(255);
        $ret_estat_01->setMaxLength(255);
        $ret_estat_02->setMaxLength(255);
        $ret_estat_03->setMaxLength(255);
        $ret_estat_04->setMaxLength(255);
        $ret_estat_05->setMaxLength(255);
        $ret_estat_06->setMaxLength(255);
        $ret_estat_07->setMaxLength(255);
        $ret_estat_08->setMaxLength(255);
        $fo_oe_fixacao->setMaxLength(255);
        $fo_od_fixacao->setMaxLength(255);

        $id->setSize(100);
        $fo_oe->setSize('100%');
        $fo_od->setSize('100%');
        $auto_07->setSize('100%');
        $auto_08->setSize('100%');
        $auto_06->setSize('100%');
        $auto_05->setSize('100%');
        $auto_04->setSize('100%');
        $auto_03->setSize('100%');
        $auto_02->setSize('100%');
        $auto_01->setSize('100%');
        $afinam_02->setSize('100%');
        $afinam_01->setSize('100%');
        $afinam_08->setSize('100%');
        $ct_20m_02->setSize('100%');
        $ct_40m_01->setSize('100%');
        $afinam_03->setSize('100%');
        $hischberg->setSize('100%');
        $ref_pup_3->setSize('100%');
        $ref_pup_2->setSize('100%');
        $ref_pup_1->setSize('100%');
        $avsc_ph_2->setSize('100%');
        $avsc_ph_1->setSize('100%');
        $afinam_04->setSize('100%');
        $afinam_05->setSize('100%');
        $afinam_06->setSize('100%');
        $afinam_07->setSize('100%');
        $ct_06m_01->setSize('100%');
        $kappa_oe_1->setSize('100%');
        $kappa_od_1->setSize('100%');
        $data_avaliacao->setSize(110);
        $idade_atual->setSize('100%');
        $rx_final_ad->setSize('100%');
        $subjetivo_02->setSize('100%');
        $subjetivo_08->setSize('100%');
        $subjetivo_07->setSize('100%');
        $subjetivo_06->setSize('100%');
        $subjetivo_05->setSize('100%');
        $subjetivo_04->setSize('100%');
        $subjetivo_03->setSize('100%');
        $ret_estat_02->setSize('100%');
        $subjetivo_01->setSize('100%');
        $ret_estat_01->setSize('100%');
        $ret_estat_08->setSize('100%');
        $avsc_longe_2->setSize('100%');
        $avsc_perto_1->setSize('100%');
        $avsc_perto_2->setSize('100%');
        $avsc_longe_1->setSize('100%');
        $ret_estat_03->setSize('100%');
        $ret_estat_04->setSize('100%');
        $ret_estat_05->setSize('100%');
        $ret_estat_06->setSize('100%');
        $ret_estat_07->setSize('100%');
        $diag_motor_oe->setSize('100%');
        $fo_od_fixacao->setSize('100%');
        $anamnese->setSize('100%', 200);
        $fo_oe_fixacao->setSize('100%');
        $diag_motor_od->setSize('100%');
        $contuta_motora->setSize('100%');
        $cad_paciente_id->setSize('100%');
        $observacoes->setSize('100%', 100);
        $contuta_refrativa->setSize('100%');
        $diag_refrativo_oe->setSize('100%');
        $diag_refrativo_od->setSize('100%');
        $diag_patologico_od->setSize('100%');
        $diag_patologico_oe->setSize('100%');
        $contuta_patologica->setSize('100%');

        $this->form->appendPage("Informações Gerais");

        $this->form->addFields([new THidden('current_tab')]);
        $this->form->setTabFunction("$('[name=current_tab]').val($(this).attr('data-current_page'));");

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel("Data avaliação:", '#ff0000', '14px', null)],[$data_avaliacao]);
        $row3 = $this->form->addFields([new TLabel("Paciente:", '#ff0000', '14px', null)],[$cad_paciente_id]);
        $row4 = $this->form->addFields([new TLabel("Idade atual:", '#ff0000', '14px', null)],[$idade_atual]);
        $row5 = $this->form->addContent([new TFormSeparator("Separador", '#333333', '18', '#eeeeee')]);

        $this->form->appendPage("Anamnese");
        $row6 = $this->form->addFields([new TLabel("Anamnese:", '#ff0000', '14px', null)],[$anamnese]);

        $this->form->appendPage("Acuidade / CT");
        $row7 = $this->form->addFields([new TLabel("Longe", null, '14px', null),$avsc_longe_1,$avsc_longe_2],[new TLabel("Perto", null, '14px', null),$avsc_perto_1,$avsc_perto_2],[new TLabel("PH", null, '14px', null),$avsc_ph_1,$avsc_ph_2]);
        $row7->layout = [' col-sm-4',' col-sm-4',' col-sm-4'];

        $row8 = $this->form->addFields([new TLabel("Reflexo Pupilar", null, '14px', null)],[$ref_pup_1],[$ref_pup_2],[$ref_pup_3]);
        $row8->layout = [' col-sm-3',' col-sm-3',' col-sm-3',' col-sm-3'];

        $row9 = $this->form->addFields([new TLabel("Kappa OD", null, '14px', null)],[$kappa_od_1],[new TLabel("Kappa OE", null, '14px', null)],[$kappa_oe_1]);
        $row9->layout = ['col-sm-3','col-sm-3',' col-sm-3',' col-sm-3'];

        $row10 = $this->form->addFields([new TLabel("Hischberg:", null, '14px', null)],[$hischberg],[]);
        $row10->layout = ['col-sm-3','col-sm-3','col-sm-6'];

        $row11 = $this->form->addContent([new TFormSeparator("CT", '#333333', '18', '#eeeeee')]);
        $row12 = $this->form->addFields([new TLabel("6 M", null, '14px', null),$ct_06m_01],[new TLabel("40 M", null, '14px', null),$ct_40m_01],[new TLabel("20 M", null, '14px', null),$ct_20m_02]);
        $row12->layout = [' col-sm-4',' col-sm-4',' col-sm-4'];

        $this->form->appendPage("Fundo de Olho");
        $row13 = $this->form->addFields([new TLabel("OD", null, '14px', null)],[$fo_od],[new TLabel("Fixação", null, '14px', null)],[$fo_od_fixacao]);
        $row14 = $this->form->addFields([new TLabel("OD", null, '14px', null)],[$fo_oe],[new TLabel("Fixação", null, '14px', null)],[$fo_oe_fixacao]);
        $row15 = $this->form->addContent([new TFormSeparator("Auto Refrator", '#333333', '18', '#eeeeee')]);
        $row16 = $this->form->addFields([new TLabel("OD", null, '14px', null)],[new TLabel("Esférico", null, '14px', null, '100%'),$auto_01],[new TLabel("Cilíndrico", null, '14px', null),$auto_02],[new TLabel("Eixo", null, '14px', null),$auto_03],[new TLabel("AV", null, '14px', null),$auto_04]);
        $row16->layout = [' col-sm-2',' col-sm-2',' col-sm-2','col-sm-2','col-sm-2'];

        $row17 = $this->form->addFields([new TLabel("OE", null, '14px', null)],[$auto_05],[$auto_06],[$auto_07],[$auto_08]);
        $row17->layout = [' col-sm-2',' col-sm-2',' col-sm-2','col-sm-2','col-sm-2'];

        $row18 = $this->form->addContent([new TFormSeparator("Retinoscopia Estática", '#333333', '18', '#eeeeee')]);
        $row19 = $this->form->addFields([new TLabel("OD", null, '14px', null)],[new TLabel("Esférico", null, '14px', null),$ret_estat_01],[new TLabel("Cilíndrico", null, '14px', null),$ret_estat_02],[new TLabel("Eixo", null, '14px', null),$ret_estat_03],[new TLabel("AV", null, '14px', null),$ret_estat_04]);
        $row19->layout = [' col-sm-2',' col-sm-2',' col-sm-2','col-sm-2','col-sm-2'];

        $row20 = $this->form->addFields([new TLabel("OE", null, '14px', null)],[$ret_estat_05],[$ret_estat_06],[$ret_estat_07],[$ret_estat_08]);
        $row20->layout = [' col-sm-2',' col-sm-2',' col-sm-2','col-sm-2','col-sm-2'];

        $row21 = $this->form->addContent([new TFormSeparator("Subjetivo", '#333333', '18', '#eeeeee')]);
        $row22 = $this->form->addFields([new TLabel("OD", null, '14px', null)],[new TLabel("Esférico", null, '14px', null),$subjetivo_01],[new TLabel("Cilíndrico", null, '14px', null),$subjetivo_02],[new TLabel("Eixo", null, '14px', null),$subjetivo_03],[new TLabel("AV", null, '14px', null),$subjetivo_04]);
        $row22->layout = [' col-sm-2',' col-sm-2',' col-sm-2','col-sm-2','col-sm-2'];

        $row23 = $this->form->addFields([new TLabel("OE", null, '14px', null)],[$subjetivo_05],[$subjetivo_06],[$subjetivo_07],[$subjetivo_08]);
        $row23->layout = [' col-sm-2',' col-sm-2',' col-sm-2','col-sm-2','col-sm-2'];

        $row24 = $this->form->addContent([new TFormSeparator("RX Final", '#333333', '18', '#eeeeee')]);
        $row25 = $this->form->addFields([new TLabel("OD", null, '14px', null)],[new TLabel("Esférico", null, '14px', null),$afinam_01],[new TLabel("Cilíndrico", null, '14px', null),$afinam_02],[new TLabel("Eixo", null, '14px', null),$afinam_03],[new TLabel("AV", null, '14px', null),$afinam_04]);
        $row25->layout = [' col-sm-2',' col-sm-2',' col-sm-2','col-sm-2','col-sm-2'];

        $row26 = $this->form->addFields([new TLabel("OE", null, '14px', null)],[$afinam_05],[$afinam_06],[$afinam_07],[$afinam_08]);
        $row26->layout = [' col-sm-2',' col-sm-2',' col-sm-2','col-sm-2','col-sm-2'];

        $row27 = $this->form->addFields([new TLabel("AD", null, '14px', null)],[$rx_final_ad],[]);
        $row27->layout = [' col-sm-2',' col-sm-2','col-sm-6'];

        $this->form->appendPage("Diagnóstico/Conduta");
        $row28 = $this->form->addContent([new TFormSeparator("Refrativo", '#333333', '18', '#eeeeee')]);
        $row29 = $this->form->addFields([new TLabel("OD", null, '14px', null)],[$diag_refrativo_od]);
        $row30 = $this->form->addFields([new TLabel("OE", null, '14px', null)],[$diag_refrativo_oe]);
        $row31 = $this->form->addContent([new TFormSeparator("Motor", '#333333', '18', '#eeeeee')]);
        $row32 = $this->form->addFields([new TLabel("OD", null, '14px', null)],[$diag_motor_od]);
        $row33 = $this->form->addFields([new TLabel("OE", null, '14px', null)],[$diag_motor_oe]);
        $row34 = $this->form->addContent([new TFormSeparator("Patológico", '#333333', '18', '#eeeeee')]);
        $row35 = $this->form->addFields([new TLabel("OD", null, '14px', null)],[$diag_patologico_od]);
        $row36 = $this->form->addFields([new TLabel("OE", null, '14px', null)],[$diag_patologico_oe]);
        $row37 = $this->form->addContent([new TFormSeparator("Conduta", '#333333', '18', '#eeeeee')]);
        $row38 = $this->form->addFields([new TLabel("Refrativa", null, '14px', null)],[$contuta_refrativa]);
        $row39 = $this->form->addFields([new TLabel("Motora", null, '14px', null)],[$contuta_motora]);
        $row40 = $this->form->addFields([new TLabel("Patológica", null, '14px', null)],[$contuta_patologica]);
        $row41 = $this->form->addContent([new TFormSeparator("Observações", '#333333', '18', '#eeeeee')]);
        $row42 = $this->form->addFields([$observacoes]);
        $row42->layout = [' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['LanAvaliacaoHeaderList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Básico","Cadastro de avaliação"]));
        }
        $container->add($this->form);

        parent::add($container);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new LanAvaliacao(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('LanAvaliacaoHeaderList', 'onShow', $loadPageParam); 

        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> 

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new LanAvaliacao($key); // instantiates the Active Record 

                $this->form->setData($object); // fill the form 

                TTransaction::close(); // close the transaction 
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

    }

    public function onShow($param = null)
    {

    } 

}

