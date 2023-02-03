<?php

declare(strict_types=1);

namespace IkonizerCore\Administrator\Dashboard;

use Exception;
use IkonizerCore\Utility\Yaml;
use IkonizerCore\Utility\Serializer;
use IkonizerCore\FormBuilder\ClientFormBuilder;
use IkonizerCore\FormBuilder\FormBuilderBlueprint;
use IkonizerCore\FormBuilder\ClientFormBuilderInterface;
use IkonizerCore\FormBuilder\FormBuilderBlueprintInterface;

class DashboardSettingsForm extends ClientFormBuilder implements ClientFormBuilderInterface
{

    /** @var FormBuilderBlueprintInterface $blueprint */
    private FormBuilderBlueprintInterface $blueprint;

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

    private function trashSupport()
    {
        return [
            'trash' => [
                'true' => 'true',
                'false' => 'false'
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

        $data = $callingController->controllerSessionData($callingController);
        $sessionData = Serializer::unCompress($data);

        return $this->form(['action' => $action, 'class' => ['uk-form-stacked'], "id" => "tableForm"])
            ->addRepository($dataRepository)
            ->add(
                $this->blueprint->text(
                    'records_per_page',
                    ['uk-form-large', 'uk-form-width-small', 'uk-border-bottom', 'uk-form-blank'],
                    $sessionData['records_per_page'],
                    false,
                    'Records Per Page'
                ),
                null,
                $this->blueprint->settings(false, null, false, null, true, null, 'Your data table pagination can be set here or on the actual index route from the dropdown option beside the lower paging links. <code>Your ' . $callingController->repository->getSchema() . ' table is currently displaying ' . $sessionData['records_per_page'] . ' records per page.</code>')
            )
            ->add($this->blueprint->select(
                'additional_conditions[]',
                ['uk-select', 'uk-form-width-large uk-height-small', 'uk-panel'],
                'additional_conditions',
                20,
                true,
                ),
                $this->blueprint->choices(
                    Yaml::file('controller')[$callingController->thisRouteController()]['status_choices'],
                    $sessionData['additional_conditions'],
                    $this
                ),
                $this->blueprint->settings(
                    false, 
                    null, 
                    true, 
                    'Widgets', 
                    true, 
                    null, 
                    ''
                )
            )

            ->add(
                $this->blueprint->submit(
                    'settings-' . $callingController->thisRouteController() . '',
                    ['uk-button', 'uk-button-primary'],
                    'Update'
                ),
                null,
                $this->blueprint->settings(false, null, false, null, true)
            )

            ->build(['before' => '<div class="uk-margin">', 'after' => '</div>'], false);
    }
}
