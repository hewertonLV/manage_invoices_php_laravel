<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Select extends Component
{
    /**
     * @var string
     */
    public $id;
    public $name;
    public $dataset;
    public $label;
    public $required;
    public $info;
    public $isMultiSelect;
    public $selected;
    public $disabled;
    public $class;


    /**
     * Create a new component instance.
     *
     * @param $id
     * @param $dataset
     * @param bool $isMultiSelect
     * @param string $name
     * @param string $label
     * @param bool $required
     * @param $selected
     * @param bool $disabled
     * @param string $class
     */
    public function __construct($id, $dataset, $isMultiSelect = false, $name = '', $label = '', $required = false, $selected = null, $disabled = false, $class = '')
    {
        $this->id = $id;
        $this->dataset = $dataset;
        $this->name = $name == '' ? $id : $name;
        $this->label = $label;
        $this->required = $required === 'true';
        $this->isMultiSelect = $isMultiSelect === 'true';
        $this->selected = $selected ? $selected : '';
        $this->disabled = $disabled;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('hyper.components.select');
    }
}
