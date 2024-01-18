<?php

class LanAvaliacaoReport extends TPage
{
    private $form; // form
    private $loaded;
    private static $database = 'opto';
    private static $activeRecord = 'LanAvaliacao';
    private static $primaryKey = 'id';
    private static $formName = 'formReport_LanAvaliacao';

    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);

        // define the form title
        $this->form->setFormTitle("Avaliações");

        $id = new TEntry('id');
        $data_avaliacao = new TDate('data_avaliacao');
        $data_avaliacao_final = new TDate('data_avaliacao_final');
        $cad_paciente_id = new TDBCombo('cad_paciente_id', 'opto', 'CadPaciente', 'id', '{nome}','nome asc'  );

        $cad_paciente_id->enableSearch();

        $data_avaliacao->setDatabaseMask('yyyy-mm-dd');
        $data_avaliacao_final->setDatabaseMask('yyyy-mm-dd');

        $data_avaliacao->setMask('dd/mm/yyyy');
        $data_avaliacao_final->setMask('dd/mm/yyyy');

        $id->setSize(100);
        $data_avaliacao->setSize(110);
        $cad_paciente_id->setSize('100%');
        $data_avaliacao_final->setSize(110);

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel("Período:", null, '14px', null)],[$data_avaliacao,new TLabel("até", null, '14px', null),$data_avaliacao_final]);
        $row3 = $this->form->addFields([new TLabel("Paciente:", null, '14px', null)],[$cad_paciente_id]);

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $btn_ongeneratehtml = $this->form->addAction("Gerar HTML", new TAction([$this, 'onGenerateHtml']), 'far:file-code #ffffff');
        $this->btn_ongeneratehtml = $btn_ongeneratehtml;
        $btn_ongeneratehtml->addStyleClass('btn-primary'); 

        $btn_ongeneratepdf = $this->form->addAction("Gerar PDF", new TAction([$this, 'onGeneratePdf']), 'far:file-pdf #d44734');
        $this->btn_ongeneratepdf = $btn_ongeneratepdf;

        $btn_ongeneratexls = $this->form->addAction("Gerar XLS", new TAction([$this, 'onGenerateXls']), 'far:file-excel #00a65a');
        $this->btn_ongeneratexls = $btn_ongeneratexls;

        $btn_ongeneratertf = $this->form->addAction("Gerar RTF", new TAction([$this, 'onGenerateRtf']), 'far:file-alt #324bcc');
        $this->btn_ongeneratertf = $btn_ongeneratertf;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(TBreadCrumb::create(["Relatórios","Avaliações"]));
        $container->add($this->form);

        parent::add($container);

    }

    public function onGenerateHtml($param = null) 
    {
        $this->onGenerate('html');
    }

    public function onGeneratePdf($param = null) 
    {
        $this->onGenerate('pdf');
    }

    public function onGenerateXls($param = null) 
    {
        $this->onGenerate('xls');
    }

    public function onGenerateRtf($param = null) 
    {
        $this->onGenerate('rtf');
    }

    /**
     * Register the filter in the session
     */
    public function getFilters()
    {
        // get the search form data
        $data = $this->form->getData();

        $filters = [];

        TSession::setValue(__CLASS__.'_filter_data', NULL);
        TSession::setValue(__CLASS__.'_filters', NULL);

        if (isset($data->id) AND ( (is_scalar($data->id) AND $data->id !== '') OR (is_array($data->id) AND (!empty($data->id)) )) )
        {

            $filters[] = new TFilter('id', '=', $data->id);// create the filter 
        }
        if (isset($data->data_avaliacao) AND ( (is_scalar($data->data_avaliacao) AND $data->data_avaliacao !== '') OR (is_array($data->data_avaliacao) AND (!empty($data->data_avaliacao)) )) )
        {

            $filters[] = new TFilter('data_avaliacao', '>=', $data->data_avaliacao);// create the filter 
        }
        if (isset($data->data_avaliacao_final) AND ( (is_scalar($data->data_avaliacao_final) AND $data->data_avaliacao_final !== '') OR (is_array($data->data_avaliacao_final) AND (!empty($data->data_avaliacao_final)) )) )
        {

            $filters[] = new TFilter('data_avaliacao', '<=', $data->data_avaliacao_final);// create the filter 
        }
        if (isset($data->cad_paciente_id) AND ( (is_scalar($data->cad_paciente_id) AND $data->cad_paciente_id !== '') OR (is_array($data->cad_paciente_id) AND (!empty($data->cad_paciente_id)) )) )
        {

            $filters[] = new TFilter('cad_paciente_id', '=', $data->cad_paciente_id);// create the filter 
        }

        // fill the form with data again
        $this->form->setData($data);

        // keep the search data in the session
        TSession::setValue(__CLASS__.'_filter_data', $data);

        return $filters;
    }

    public function onGenerate($format)
    {
        try
        {
            $filters = $this->getFilters();
            // open a transaction with database 'opto'
            TTransaction::open(self::$database);
            $param = [];
            // creates a repository for LanAvaliacao
            $repository = new TRepository(self::$activeRecord);
            // creates a criteria
            $criteria = new TCriteria;

            $criteria->setProperties($param);

            if ($filters)
            {
                foreach ($filters as $filter) 
                {
                    $criteria->add($filter);       
                }
            }

            // load the objects according to criteria
            $objects = $repository->load($criteria, FALSE);

            if ($objects)
            {
                $widths = array(90,350,100,620);

                switch ($format)
                {
                    case 'html':
                        $tr = new TTableWriterHTML($widths);
                        break;
                    case 'xls':
                        $tr = new TTableWriterXLS($widths);
                        break;
                    case 'pdf':
                        $tr = new TTableWriterPDF($widths, 'L', 'A4');
                        break;
                    case 'rtf':
                        if (!class_exists('PHPRtfLite_Autoloader'))
                        {
                            PHPRtfLite::registerAutoloader();
                        }
                        $tr = new TTableWriterRTF($widths, 'L', 'A4');
                        break;
                }

                if (!empty($tr))
                {
                    // create the document styles
                    $tr->addStyle('title', 'Helvetica', '10', 'B',   '#000000', '#dbdbdb');
                    $tr->addStyle('datap', 'Arial', '10', '',    '#333333', '#f0f0f0');
                    $tr->addStyle('datai', 'Arial', '10', '',    '#333333', '#ffffff');
                    $tr->addStyle('header', 'Helvetica', '16', 'B',   '#5a5a5a', '#6B6B6B');
                    $tr->addStyle('footer', 'Helvetica', '10', 'B',  '#5a5a5a', '#A3A3A3');
                    $tr->addStyle('break', 'Helvetica', '10', 'B',  '#ffffff', '#9a9a9a');
                    $tr->addStyle('total', 'Helvetica', '10', 'I',  '#000000', '#c7c7c7');
                    $tr->addStyle('breakTotal', 'Helvetica', '10', 'I',  '#000000', '#c6c8d0');

                    // add titles row
                    $tr->addRow();
                    $tr->addCell("Data", 'left', 'title');
                    $tr->addCell("Paciente", 'left', 'title');
                    $tr->addCell("Idade atual", 'left', 'title');
                    $tr->addCell("Anamnese", 'left', 'title');

                    $grandTotal = [];
                    $breakTotal = [];
                    $breakValue = null;
                    $firstRow = true;

                    // controls the background filling
                    $colour = false;                
                    foreach ($objects as $object)
                    {
                        $style = $colour ? 'datap' : 'datai';

                        $grandTotal['anamnese'][] = $object->anamnese;
                        $breakTotal['anamnese'][] = $object->anamnese;

                        $firstRow = false;

                        $object->data_avaliacao = call_user_func(function($value, $object, $row) 
                        {
                            if(!empty(trim($value)))
                            {
                                try
                                {
                                    $date = new DateTime($value);
                                    return $date->format('d/m/Y');
                                }
                                catch (Exception $e)
                                {
                                    return $value;
                                }
                            }
                        }, $object->data_avaliacao, $object, null);

                        $object->cad_paciente->nome = call_user_func(function($value, $object, $row) 
                        {
                            if($value)
                            {
                                return mb_strtoupper($value);
                            }
                        }, $object->cad_paciente->nome, $object, null);

                        $object->anamnese = call_user_func(function($value, $object, $row) 
                        {
                            if($value)
                            {
                                return mb_strtoupper($value);
                            }
                        }, $object->anamnese, $object, null);

                        $tr->addRow();

                        $tr->addCell($object->data_avaliacao, 'left', $style);
                        $tr->addCell($object->cad_paciente->nome, 'left', $style);
                        $tr->addCell($object->idade_atual, 'left', $style);
                        $tr->addCell($object->anamnese, 'left', $style);

                        $colour = !$colour;
                    }

                    $tr->addRow();

                    $grandTotal_anamnese = count($grandTotal['anamnese']);

                    $grandTotal_anamnese = call_user_func(function($value)
                    {
                        if($value)
                        {
                            return mb_strtoupper($value);
                        }
                    }, $grandTotal_anamnese); 

                    $tr->addCell('', 'center', 'total');
                    $tr->addCell('', 'center', 'total');
                    $tr->addCell('', 'center', 'total');
                    $tr->addCell($grandTotal_anamnese, 'left', 'total');

                    $file = 'report_'.uniqid().".{$format}";
                    // stores the file
                    if (!file_exists("app/output/{$file}") || is_writable("app/output/{$file}"))
                    {
                        $tr->save("app/output/{$file}");
                    }
                    else
                    {
                        throw new Exception(_t('Permission denied') . ': ' . "app/output/{$file}");
                    }

                    parent::openFile("app/output/{$file}");

                    // shows the success message
                    new TMessage('info', _t('Report generated. Please, enable popups'));
                }
            }
            else
            {
                new TMessage('error', _t('No records found'));
            }

            // close the transaction
            TTransaction::close();
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }

    public function onShow($param = null)
    {

    }


}

