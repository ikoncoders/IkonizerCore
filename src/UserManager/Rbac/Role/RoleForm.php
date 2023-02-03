<?php
declare(strict_types=1);

namespace IkonizerCore\UserManager\Rbac\Role;

use Exception;
use IkonizerCore\FormBuilder\ClientFormBuilder;
use IkonizerCore\FormBuilder\ClientFormBuilderInterface;
use IkonizerCore\FormBuilder\FormBuilderBlueprint;
use IkonizerCore\FormBuilder\FormBuilderBlueprintInterface;

class RoleForm extends ClientFormBuilder implements ClientFormBuilderInterface
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

    /**
     * @param string $action
     * @param object|null $dataRepository
     * @param object|null $callingController
     * @return string
     * @throws Exception
     */
    public function createForm(string $action, ?object $dataRepository = null, ?object $callingController = null): string
    {
        return $this->form(['action' => $action, 'class' => ['uk-form-stacked'], "id" => "roleForm"])
            ->addRepository($dataRepository)
            ->add($this->blueprint->text('role_name', [], $this->hasValue('role_name')))
            ->add($this->blueprint->textarea('role_description', ['uk-textarea'], 'role_description'), $this->hasValue('role_description'))
            ->add(
                $this->blueprint->submit(
                    $this->hasValue('id') ? 'edit-role' : 'new-role',
                    ['uk-button', 'uk-button-primary', 'uk-form-width-medium'],
                    'Save',
                   // "UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Saving...', status: 'success', timeout: 3000})"
                ),
                null,
                $this->blueprint->settings(false, null, false, null, true)
            )
            ->build(['before' => '<div class="uk-margin">', 'after' => '</div>']);
    }
}
