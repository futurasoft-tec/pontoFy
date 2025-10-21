 <!--Validacao dos dados-->
 @if ($errors->any())
     <div class="alert alert-danger d-flex align-items-center gap-3 p-3 mb-2 rounded-2" role="alert"
         aria-live="assertive">
         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="feather feather-alert-triangle flex-shrink-0" aria-hidden="true">
             <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
             </path>
             <line x1="12" y1="9" x2="12" y2="13"></line>
             <line x1="12" y1="17" x2="12.01" y2="17"></line>
         </svg>

         <div class="d-flex flex-column gap-2">
             @foreach ($errors->all() as $error)
                 <div class="d-flex align-items-center gap-2 text-danger-emphasis">
                     <span class="badge bg-danger bg-opacity-25 px-2 py-1">!</span>
                     <span class="text-break">{{ $error }}</span>
                 </div>
             @endforeach
         </div>
     </div>
 @endif


 <style>
     .alert-danger {
         background: linear-gradient(15deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.15) 100%);
         border-left: 4px solid #dc3545;
         box-shadow: 0 2px 8px rgba(220, 53, 69, 0.1);
     }
 </style>
 <!--fim Exibir erros personalizado--->
