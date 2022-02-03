<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AttendantRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AttendantCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AttendantCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Attendant::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/attendant');
        CRUD::setEntityNameStrings('attendant', 'attendants');
        $this->crud->enableExportButtons();
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::column('id');
        CRUD::column('full_name');
        // $this->crud->addColumn(['name' => 'attend', 'label' => 'Attend', 'type' => 'boolean', 'options' => [0 => 'No Attend', 1 => 'Attend']]);
        CRUD::column('type');
        // CRUD::column('certificate_url');


        $this->crud->addColumn([
            'name'  => 'certificate_url',
            'label' => 'Certificate',
            'type'  => 'text',
            'limit' => 20000
        ]);
        // CRUD::column('created_at');

        $this->crud->denyAccess('update');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(AttendantRequest::class);

        CRUD::field('id');
        CRUD::field('full_name');
        CRUD::field('attend');
        CRUD::column('type');
        CRUD::field('certificate');
        CRUD::field('created_at');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        
        CRUD::column('full_name');
        $this->crud->addColumn(['name' => 'attend', 'label' => 'Attend', 'type' => 'boolean', 'options' => [0 => 'No Attend', 1 => 'Attend']]);
        CRUD::column('type');
        CRUD::column('certificate_url');
        CRUD::column('created_at');
    }
}
