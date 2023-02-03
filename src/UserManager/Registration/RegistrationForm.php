<?php

declare(strict_types=1);

namespace IkonizerCore\UserManager\Registration;

use IkonizerCore\FormBuilder\ClientFormBuilder;
use IkonizerCore\FormBuilder\ClientFormBuilderInterface;
use IkonizerCore\FormBuilder\FormBuilderBlueprint;
use IkonizerCore\FormBuilder\FormBuilderBlueprintInterface;
use Exception;

class RegistrationForm extends ClientFormBuilder implements ClientFormBuilderInterface
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
     * Construct the security login form. The attribute name='{string}' must match
     * the string name pass to the $this->form->isSubmittable() method within the
     * any method checking if the form canHandleRequest and isSubmittable
     *
     * @param string $action
     * @param object|null $dataRepository
     * @param object|null $callingController
     * @return string
     * @throws Exception
     */
    public function createForm(string $action, ?object $dataRepository = null, ?object $callingController = null): string
    {
        return $this->form(['action' => $action, 'class' => 'uk-form-horizontal'])
            ->addRepository($dataRepository)
            ->add($this->blueprint->text('firstname'))
            ->add($this->blueprint->text('lastname'))
            ->add($this->blueprint->email('email', ['uk-width-1-2'], null, true))
            ->add($this->blueprint->password(
                'client_password_hash',
                [],
                null,
                'new-password',
                true),
                NULL,
                $this->blueprint->settings(false, null, true, 'Password')
            )
            ->add(
                $this->blueprint->submit(
                    'register-registration',
                    ['uk-button', 'uk-button-secondary'],
                    'Register new account'
                ),
                null,
                $this->blueprint->settings(false, null, false, null, true, 'Remember Me')
            )
            ->build(['before' => '<div class="uk-margin">', 'after' => '</div>']);
    }
}
