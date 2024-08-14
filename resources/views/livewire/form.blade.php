<div class="flex justify-center items-center min-h-screen bg-gray-100">
   <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-md">
      <form wire:submit:prevent="submit">
         {{ $this->form }}
      </form>
   </div>
</div>