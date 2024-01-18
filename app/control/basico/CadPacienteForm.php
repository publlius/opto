<?php

class CadPacienteForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'opto';
    private static $activeRecord = 'CadPaciente';
    private static $primaryKey = 'id';
    private static $formName = 'form_CadPaciente';

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
        $this->form->setFormTitle("Cadastro de paciente");


        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $data_nascimento = new TDate('data_nascimento');
        $numero_rg = new TEntry('numero_rg');
        $numero_cpf = new TEntry('numero_cpf');
        $cidade = new TEntry('cidade');
        $endereco_residencial = new TEntry('endereco_residencial');
        $bairro_residencial = new TEntry('bairro_residencial');
        $referencia_residencial = new TEntry('referencia_residencial');
        $endereco_comercial = new TEntry('endereco_comercial');
        $fone_01 = new TEntry('fone_01');
        $observacoes = new TEntry('observacoes');

        $nome->addValidation("Nome", new TRequiredValidator()); 
        $numero_rg->addValidation("Numero rg", new TRequiredValidator()); 
        $numero_cpf->addValidation("Numero cpf", new TRequiredValidator()); 

        $id->setEditable(false);
        $data_nascimento->setMask('dd/mm/yyyy');
        $data_nascimento->setDatabaseMask('yyyy-mm-dd');

        $nome->setMaxLength(255);
        $cidade->setMaxLength(255);
        $fone_01->setMaxLength(255);
        $numero_rg->setMaxLength(255);
        $numero_cpf->setMaxLength(255);
        $bairro_residencial->setMaxLength(255);
        $endereco_comercial->setMaxLength(255);
        $endereco_residencial->setMaxLength(255);
        $referencia_residencial->setMaxLength(255);

        $id->setSize(100);
        $nome->setSize('100%');
        $cidade->setSize('100%');
        $fone_01->setSize('100%');
        $numero_rg->setSize('100%');
        $numero_cpf->setSize('100%');
        $observacoes->setSize('100%');
        $data_nascimento->setSize(110);
        $bairro_residencial->setSize('100%');
        $endereco_comercial->setSize('100%');
        $endereco_residencial->setSize('100%');
        $referencia_residencial->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel("Nome:", '#ff0000', '14px', null)],[$nome],[new TLabel("Data nascimento:", null, '14px', null)],[$data_nascimento]);
        $row3 = $this->form->addFields([new TLabel("Nr RG:", '#ff0000', '14px', null)],[$numero_rg],[new TLabel("Nr CPF", '#ff0000', '14px', null)],[$numero_cpf]);
        $row4 = $this->form->addFields([new TLabel("Cidade:", null, '14px', null)],[$cidade]);
        $row5 = $this->form->addFields([new TLabel("Endereço residencial:", null, '14px', null)],[$endereco_residencial]);
        $row6 = $this->form->addFields([new TLabel("Bairro residencial:", null, '14px', null)],[$bairro_residencial],[new TLabel("Ref. residencial:", null, '14px', null)],[$referencia_residencial]);
        $row7 = $this->form->addFields([new TLabel("Endereço comercial:", null, '14px', null)],[$endereco_comercial]);
        $row8 = $this->form->addFields([new TLabel("Fone:", null, '14px', null)],[$fone_01]);
        $row9 = $this->form->addFields([new TLabel("Observações:", null, '14px', null)],[$observacoes]);

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['CadPacienteHeaderList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Básico","Cadastro de paciente"]));
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

            $object = new CadPaciente(); // create an empty object 

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
            TApplication::loadPage('CadPacienteHeaderList', 'onShow', $loadPageParam); 

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

                $object = new CadPaciente($key); // instantiates the Active Record 

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

