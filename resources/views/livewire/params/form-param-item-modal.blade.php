    <!-------------------------------   HTML do modal para testar o Alpine ---------------------------->

    <div x-data="{ isOpenPItem: {{ $modalForm == 'ParamItem' ? 'true' : 'false' }}  }">

      
      <!-- overlay transition-opacity transition-transform  -->
      <div 
      x-show="isOpenPItem" x-cloak
      x-transition:enter="transition duration-300 transform"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition duration-300 transform"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      id="modal_overlay" class="fixed inset-0 y-full w-full  overflow-scroll bg-black bg-opacity-30 h-screen flex justify-center items-start md:items-center pt-10 md:pt-0">
      
        <!-- modal -translate-y-full scale-150  -->
        <div id="modal" 
    
        class="transform relative w-10/10  md:w-1/3 bg-white rounded shadow-lg">
        
            <!-- button close 
              onclick="openModal(false)"-->
            <button 
              @click="isOpenPItem = false"
              wire:click="setFormClose()"
              class="modal--close--button">
              &cross;
            </button>
        
            <!-- header -->
            <div class="modal--header">
            <h2 class="modal--h2">{{$formTitle}}</h2>
            </div>
        
            <!-- body -->
            <div class="modal--body">

              <form class="modal--form-class" wire:submit.prevent="submit({{$paramItemModel}}, 'ParamItem')">
                  <div class="modal--form-input-div-1">
                    <div class="modal--form-input-div-2">
                      <label class="modal--form-label" for="grid-password">
                        Conteúdo
                      </label>
                      <input wire:model="paramItemModel.conteudo" class="appearance-none block w-full bg-gray-200 text-gray-700 border
                       border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="paramItemModel_conteudo" type="text" placeholder="Digite para exibição">
                        @error('paramItemModel.conteudo') <span class="error">{{ $message }}</span> @enderror
                      <p class="modal--form-p-error"></p>
                    </div>
                  </div>

                  <div class="modal--form-input-div-1">
                    <div class="modal--form-input-div-2">
                      <label class="modal--form-label" for="grid-password">
                        Descricao
                      </label>
                      <input wire:model="paramItemModel.descricao" class="modal--form-input" id="paramItem_descricao" type="text" placeholder="Aplicado para os usuários">
                      @error('paramItemModel.descricao') <span class="error">{{ $message }}</span> @enderror
                      <p class="modal--form-p-error"></p>
                    </div>
                  </div>                      
                </div>
        
            <!-- footer -->
            <div class="modal--form-footer">
            <button class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded 
            text-white focus:outline-none" type="submit">Save</button>

          </form>
              <!-- onclick="openModal(false)" -->
              <button 
                  @click="isOpenPItem = false"
                  wire:click="setFormClose()"
                  class="delete--button"
              >Close</button>
            </div>
        </div>
      </div>
    </div>