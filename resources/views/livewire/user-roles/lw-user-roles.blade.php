<div>
  <div class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Papeis de Usuários') }}
      </h2>

    </div>
  </div>

<div class="modal--body-div">
  <div class="py-3 ">
    <button
      wire:click="new()"
      class="relative text-white px-3 w-auto h-10 bg-blue-600 rounded-full hover:bg-blue-700
      active:shadow-lg mouse shadow transition ease-in duration-200 focus:outline-none">
      <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="w-6 h-6 inline-block">
        <path fill="#FFFFFF" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                C15.952,9,16,9.447,16,10z" />
      </svg>
      <span>Novo</span>
    </button>
  </div>   

    <div class="flex flex-col my-3">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="modal--table-div">

            <table class="modal--table">
              <thead class="modal--table-thead">
                <tr>
                  <th scope="col" class="modal--table-th">
                    Nome de Exibição
                  </th>
                  <th scope="col" class="modal--table-th">
                    Papel
                  </th>
                  <th scope="col" class="modal--table-th">
                    Descrição
                  </th>
                  <th scope="col" class="modal--table-th">
                    <span class="sr-only">Edit</span>
                  </th>
                  <th scope="col" class="modal--table-th">
                    <span class="sr-only">Excluir</span>
                  </th>              
                </tr>
              </thead>
              <tbody class="modal--table-tbody">
    
                @foreach($roles as $role)        
                <tr class="modal--table-tr">
    
                    <td class="modal--table-td">
                        <span>{{ $role->display_name }}</span>
                    </td>
    
                    <td class="modal--table-td">
                        <span>{{ $role->name }}</span>
                    </td>     

                    <td class="modal--table-td">
                      <span>{{ $role->description }}</span>
                  </td>                             
                    
                    <td class="modal--table-td">
                      <button wire:click="edit({{$role->id}}, 'Role')"><i class="fa fa-edit fa-xl"></i></button>
                    </td>  
                    <td class="modal--table-td">
                      <button wire:click="delete({{$role->id}}, 'Role')"><i class="fa fa-trash fa-xl"></i></button>
                    </td>                                
                </tr>        
                @endforeach    
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> 
    
    @include('livewire.user-roles.form-modal')
    @include('layouts.delete-modal')

  </div>
</div>    

        
        
