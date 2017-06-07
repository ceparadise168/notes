http://symfony.com/doc/current/reference/forms/types/form.html#empty-data

當 required 設定為 true 的時候 會去呼叫 HTML5 的檢查API

empty_data¶

type: mixed

The actual default value of this option depends on other field options:

If data_class is set and required is true, then new $data_class();
If data_class is set and required is false, then null;
If data_class is not set and compound is true, then array() (empty array);
If data_class is not set and compound is false, then '' (empty string).
This option determines what value the field will return when the submitted value is empty (or missing). It does not set an initial value if none is provided when the form is rendered in a view.

This means it helps you handling form submission with blank fields. For example, if you want the name field to be explicitly set to John Doe when no value is selected, you can do it like this:

$builder->add('name', null, array(
    'required'   => false,
    'empty_data' => 'John Doe',
));

This will still render an empty text box, but upon submission the John Doe value will be set. Use the data or placeholder options to show this initial value in the rendered form.

If a form is compound, you can set empty_data as an array, object or closure. See the How to Configure empty Data for a Form Class article for more details about these options.


mv src/AppBundle/Controller/DefaultController.php  src/AppBundle/Controller/msgBoardController.php