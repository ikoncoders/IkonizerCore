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

class DiscoveryPermissionsForm extends ClientFormBuilder implements ClientFormBuilderInterface
{

    use SessionSettingsTrait;

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

        return $this->form(['action' => $action, 'class' => ['uk-form-stacked'], "id" => "discoveryPermissions"])
            ->addRepository($dataRepository)
            ->add(
                $this->blueprint->textarea(
                    'permission_description',
                    ['uk-form-large', 'uk-text-meta', 'uk-border-bottom', 'uk-form-blank'],
                    'permission_description',
                    'Global Permission description will apply to all permissions',
                    5,
                    50
                ),
                null,
                $this->blueprint->settings(false, null, true, null, true, null, 'By default you can export <code></code> records. Use the box bellow to select the amount of records you want to export.')
            )

            ->add(
                $this->blueprint->submit(
                    'permissins-' . $callingController->thisRouteController() . '',
                    ['uk-button', 'uk-button-secondary'],
                    'Install Permissions'
                ),
                null,
                $this->blueprint->settings(false, null, false, null, true, null, 'If you made any changes please save before exporting.')
            )
            ->build(['before' => '<div class="uk-margin">', 'after' => '</div>'], false);
    }
}