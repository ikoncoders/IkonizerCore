<?php

declare(strict_types=1);

namespace IkonizerCore\Administrator\Forms;

use Exception;
use IkonizerCore\Base\Traits\SessionSettingsTrait;
use IkonizerCore\Utility\Serializer;
use IkonizerCore\FormBuilder\ClientFormBuilder;
use IkonizerCore\FormBuilder\FormBuilderBlueprint;
use IkonizerCore\FormBuilder\ClientFormBuilderInterface;
use IkonizerCore\FormBuilder\FormBuilderBlueprintInterface;

class ExportForm extends ClientFormBuilder implements ClientFormBuilderInterface
{

    use SessionSettingsTrait;

    /** @var FormBuilderBlueprintInterface $blueprint */
    private FormBuilderBlueprintInterface $blueprint;
    private $exportSessionKey = 'session_export_settings';

    /**
     * Main class constructor
     *
     * @param FormBuilderBlueprint $blueprint
     * @return void
     */
    public function __construct(FormBuilderBlueprint $blueprint)
    {
        $this->blueprint = $blueprint;
        parent::__construct();
    }

    private function radioOptions(string $key = null)
    {
        return [
            $key => [
                'csv' => 'true',
                'xml' => 'false'
            ]
        ];
    }

    /**
     * @param string $action
     * @param object|null $dataRepository
     * @param object|null $callingController
     * @return string
     * @throws Exception
     */
    public function createForm(string $action, ?object $dataRepository = null, ?object $callingController = null): string
    {

        $sessionData = $this->getSessionSettings($callingController, $this->exportSessionKey);
        // sprintf('Defaults to <code>%s</code>. You can change this based on the columns your current model supports. This model supports <code>[%s]</code>.<br>Using any of those string along with either <code>%s</code> will alter the order of the exported data.', $sessionData['log_order'], implode('<br>', $callingController->repository->getColumns($callingController->rawSchema)), 'ASC or DESC')
        return $this->form(['action' => $action, 'class' => ['uk-form-stacked'], "id" => "tableForm"])
            ->addRepository($dataRepository)
            ->add(
                $this->blueprint->text(
                    'export_filename',
                    ['uk-form-large', 'uk-form-width-medium', 'uk-border-bottom', 'uk-form-blank'],
                    $sessionData['export_filename'], /* how much data to return */
                    false,
                    'Export filename'
                ),
                null,
                $this->blueprint->settings(false, null, true, null, true, null, 'Leaving this field blank will automatically revert the filename set internally. Which is <code>' . $callingController->thisRouteController() . '-data_ follow by the current date.</code>')
            )

            ->add(
                $this->blueprint->text(
                    'log_records',
                    ['uk-form-large', 'uk-form-width-small', 'uk-border-bottom', 'uk-form-blank'],
                    $sessionData['log_records'], /* how much data to return */
                    false,
                    'Log space records'
                ),
                null,
                $this->blueprint->settings(false, null, true, null, true, null, 'By default you can export <code>' . $sessionData['log_records'] . '</code> records. Use the box bellow to select the amount of records you want to export.')
            )
            ->add(
                $this->blueprint->radio('export_format', [], $sessionData['export_format']),
                $this->blueprint->choices(['exportr_format' => ['csv' => 'csv', 'xml' => 'xml']], $sessionData['export_format']),
                $this->blueprint->settings(
                    false, 
                    null, 
                    true, 
                    null, 
                    true, 
                    null, 
                    'csv or xml format file available for exporting. This however defaults to .csv format. Only one can be selected at any one time.'
                )
            )
            ->add(
                $this->blueprint->radio('export_conditions', [], $sessionData['export_conditions']),
                $this->blueprint->choices(['export_conditions' => ['7_days' => '7_days', '1_month' => '1_month', '6_month' => '6_month', '1_year' => '1_year', 'all' => 'all']], $sessionData['export_conditions']),
                $this->blueprint->settings(
                    false, 
                    null, 
                    true, 
                    null, 
                    true, 
                    null, 
                    'Set a timescale for when your exported data should export from. Or use the custom box below to specify a more specific date.'
                )
            )
            ->add(
                $this->blueprint->text(
                    'log_order',
                    ['uk-form-large', 'uk-form-width-large', 'uk-border-bottom', 'uk-form-blank'],
                    $sessionData['log_order'] ?? 'null', /* how much data to return */
                    false,
                    'Custom export conditions'
                ),
                null,
                $this->blueprint->settings(false, null, true, null, true, null, '')
            )

            ->add(
                $this->blueprint->submit(
                    'export-' . $callingController->thisRouteController() . '',
                    ['uk-button', 'uk-button-secondary'],
                    'Go'
                ),
                null,
                $this->blueprint->settings(false, null, false, null, true, null, 'If you made any changes please save before exporting.')
            )
            ->build(['before' => '<div class="uk-margin">', 'after' => '</div>'], false);
    }
}