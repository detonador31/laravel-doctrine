<!-------------------------------   HTML do modal Form ---------------------------->
@modal_form_ini(['formType' => 'Role', 'modalForm' => $modalForm, 'formTitle' => $formTitle,
 'model' => $model, $model => $$model]) @endmodal_form_ini
        
    @input_select(['label' => 'Papel(*)', 'modelField' => 'roleModel.id', 
    'selectItems' => $selectRoles, 'render' => true])@endinput_select
    
@modal_form_fim(['saveLabel' => 'Adicionar Papel']) @endmodal_form_fim